<?php
/**
 * WP Theme constants and setup functions
 *
 * @package TheEquityFund
 */

use TheEquityFund\Managers;
use TheEquityFund\Blocks\BlockManager;
use Timber\Timber;
use Dotenv\Dotenv;

// Disable deprecation warnings for PHP 8.
// phpcs:disable
error_reporting( E_ALL & ~E_DEPRECATED );

/** Autoloader */
require_once 'vendor/autoload.php';

define( 'THE_EQUITY_FUND_THEME_URL', get_stylesheet_directory_uri() );
define( 'THE_EQUITY_FUND_THEME_PATH', dirname( __FILE__ ) . '/' );
define( 'THE_EQUITY_FUND_DOMAIN', get_site_url() );
define( 'THE_EQUITY_FUND_SITE_NAME', get_bloginfo( 'name' ) );
define( 'THE_EQUITY_FUND_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Use Dotenv to set required environment variables and load .env file when present.
 */
$dotenv = Dotenv::createImmutable( WP_CONTENT_DIR )->safeLoad();

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define( 'WP_ENV', getenv( 'WP_ENV' ) ? getenv( 'WP_ENV' ) : 'production' );

$timber          = Timber::init();
Timber::$dirname = array( 'templates', 'blocks' );

$managers = array(
	new Managers\TaxonomiesManager(),
	new Managers\WordPressManager(),
	new Managers\CustomPostsManager(),
	new Managers\ContextManager(),
	new Managers\BlockManager(),
);

if ( function_exists( 'acf_add_local_field_group' ) ) {
	$managers[] = new Managers\ACFManager();
}

$theme_manager = new Managers\ThemeManager( $managers );
add_action( 'after_setup_theme', array( $theme_manager, 'setup_theme' ) );

/**
 * Log given values to logs/error.log
 *
 * @param array ...$values values to log.
 */
function print_log( ...$values ) {
	foreach ( $values as $v ) {
		error_log( print_r( $v, true ) );
	}
}
