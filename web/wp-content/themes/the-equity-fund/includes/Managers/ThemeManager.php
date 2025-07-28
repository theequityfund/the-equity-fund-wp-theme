<?php
/**
 * Bootstraps WordPress theme related functions, most importantly enqueuing javascript and styles.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Managers;

/** Class */
class ThemeManager {

	/**
	 * Array of managers.
	 *
	 * @var array
	 */
	private $managers = array();

	/**
	 * Constructor
	 *
	 * @param array $managers Array of managers.
	 */
	public function __construct( array $managers ) {
		$this->managers = $managers;
	}

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function setup_theme() {
		if ( count( $this->managers ) > 0 ) {
			foreach ( $this->managers as $manager ) {
				$manager->run();
			}
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 999 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'admin_init', array( $this, 'register_menus' ) );
		add_action( 'init', array( $this, 'register_options' ) );
		add_action( 'pre_get_posts', array( $this, 'filter_posts' ) );

		add_filter( 'admin_footer_text', array( $this, 'add_admin_footer_credit' ) );

		add_filter( 'wpseo_meta_author', array( $this, 'modify_meta_author' ), 10, 2 );
		add_filter( 'wpseo_enhanced_slack_data', array( $this, 'modify_meta_slack_data' ), 10, 2 );

		$this->setup_theme_support();
	}

	/**
	 * Enqueue javascript using WordPress
	 *
	 * @return void
	 */
	public function enqueue() {
		// Remove default Gutenberg CSS.
		wp_deregister_style( 'wp-block-library' );

		wp_enqueue_script( 'vendor', THE_EQUITY_FUND_THEME_URL . '/dist/static/vendor.js', array(), THE_EQUITY_FUND_THEME_VERSION, true );

		// Enqueue custom JS file, with cache busting.
		wp_enqueue_script( 'script.js', THE_EQUITY_FUND_THEME_URL . '/dist/static/app.js', array(), THE_EQUITY_FUND_THEME_VERSION, true );
	}

	/**
	 * Enqueue JS and CSS for WP admin panel
	 *
	 * @return void
	 */
	public function enqueue_admin_scripts() {
		wp_enqueue_style( 'admin-styles', THE_EQUITY_FUND_THEME_URL . '/dist/static/admin.css', array(), THE_EQUITY_FUND_THEME_VERSION );
		wp_enqueue_script( 'vendor', THE_EQUITY_FUND_THEME_URL . '/dist/static/vendor.js', array(), THE_EQUITY_FUND_THEME_VERSION, false );
		wp_enqueue_script( 'admin.js', THE_EQUITY_FUND_THEME_URL . '/dist/static/admin.js', array(), THE_EQUITY_FUND_THEME_VERSION, false );
	}

	/**
	 * Register nav menus
	 *
	 * @return void
	 */
	public function register_menus() {
		register_nav_menus(
			array(
				'nav_pages_menu'  => 'Navigation Pages Menu',
				'nav_footer_menu' => 'Navigation Footer Menu',
				'nav_legal_menu'  => 'Navigation Legal Menu',
			)
		);
	}

	/**
	 * Add ACF options page to WordPress
	 *
	 * @return void
	 */
	public function register_options() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				array(
					'page_title' => 'Site Settings',
					'menu_title' => 'Site Settings',
					'menu_slug'  => 'site-settings',
				)
			);
		}
	}

	/**
	 * Exclude password protected and unpublished posts from post results
	 *
	 * @param \WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @return void
	 */
	public function filter_posts( $query ) {
		// if not admin, single post, or page, then filter out password protected posts.
		if ( ! is_admin() && ! is_single() && ( ! is_page() || is_front_page() ) ) {
			$query->set( 'has_password', false );
			/**
			* TODO: Investigate why this excludes gallery images in Promo block for front page.
			* $query->set( 'post_status', 'publish' );
			*/
		}
	}

	/**
	 * Adds Upstatement credit to the admin footer.
	 *
	 * @return string
	 */
	public function add_admin_footer_credit() {
		return '<span id="footer-thankyou">Made by <a href="https://upstatement.com/" target="_blank">Upstatement</a></span>';
	}

	/**
	 * Configure features for the editor. Note that this should be called as part of the `after_setup_theme` hook.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	 * @see https://developer.wordpress.org/reference/functions/add_theme_support/
	 *
	 * @return void
	 */
	private function setup_theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'align-wide' );
	}

	/**
	 * Modify the author data.
	 *
	 * @param string                                                      $author The author data.
	 * @param Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation $presentation The presentation object.
	 *
	 * @return string
	 */
	public function modify_meta_author( $author, $presentation ) {
		if ( $presentation instanceof \Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation ) {
			$post_id = $presentation->model->object_id;
			$author_field = get_field( 'authors', $post_id );

			if ( ! empty( $author_field ) ) {
				return join( ', ', array_column( $author_field, 'name' ) );
			}
		}

		return $author;
	}

	/**
	 * Modify the slack data.
	 *
	 * @param array                                                       $data The slack data.
	 * @param Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation $presentation The presentation object.
	 *
	 * @return array
	 */
	public function modify_meta_slack_data( $data, $presentation ) {
		if ( isset( $data['Written by'] ) && $presentation instanceof \Yoast\WP\SEO\Presentations\Indexable_Post_Type_Presentation ) {
			$post_id = $presentation->model->object_id;
			$author_field = get_field( 'authors', $post_id );

			if ( ! empty( $author_field ) ) {
				$data['Written by'] = join( ', ', array_column( $author_field, 'name' ) );
			}
		}

		return $data;
	}
}
