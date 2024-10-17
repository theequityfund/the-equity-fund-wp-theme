<?php
/**
 * Initializes blocks.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Managers;

use TheEquityFund\Blocks;

/** Class */
class BlockManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_blocks' ) );

		add_action( 'enqueue_block_editor_assets', array( $this, 'load_block_editor_assets' ) );
		add_filter( 'allowed_block_types_all', array( $this, 'enabled_blocks' ) );
	}

	/**
	 * Registers all custom blocks defined by this theme.
	 *
	 * @return void
	 */
	public function register_blocks() {
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/states' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/tease' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/statistics' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/people' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/issues' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/grantees' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/statement' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/checklist' );

		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/image-layout' );
		register_block_type( THE_EQUITY_FUND_THEME_PATH . 'blocks/related-articles' );
	}

	/**
	 * Enqueue Gutenberg block assets for backend editor.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets/
	 *
	 * @return void
	 */
	public function load_block_editor_assets() {
		// Make sure that the asset file exists fiest.
		if ( ! file_exists( THE_EQUITY_FUND_THEME_PATH . 'dist/blocks/index.asset.php' ) ) {
			return;
		}

		$asset_file = include THE_EQUITY_FUND_THEME_PATH . 'dist/blocks/index.asset.php';

		// Scripts.
		wp_enqueue_script(
			'block-js',
			THE_EQUITY_FUND_THEME_URL . '/dist/blocks/index.js',
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		if ( file_exists( THE_EQUITY_FUND_THEME_PATH . 'dist/blocks/index.css' ) ) {
			// Styles.
			wp_enqueue_style(
				'block-editor-css',
				THE_EQUITY_FUND_THEME_URL . '/dist/blocks/index.css',
				array(),
				$asset_file['version'],
			);
		}
	}

	/**
	 * Control which blocks are available for editors.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/allowed_block_types_all/
	 *
	 * @param bool|string[] $allowed List of block type slugs, or boolean to enable/disable all.
	 *
	 * @return bool|string[] the updated allow list
	 */
	public function enabled_blocks( $allowed ) {
		return array(
			// core blocks.
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/list-item',
			'core/quote',
			'core/pullquote',
			'core/table',
			'core/image',
			'core/gallery',
			'core/audio',
			'core/file',
			'core/video',
			'core/media-text',
			'core/buttons',
			'core/button',
			'core/embed',
			'core/code',
			'core/column',
			'core/columns',
			'core/cover',
			'core/details',
			'core/embed',
			'core/footnotes',
			'core/latest-posts',
			'core/separator',
			'core/shortcode',

			// custom blocks.
			'acf/related-articles',
			'acf/image-layout',
			'wsk/static-native-block',
			'acf/states',
			'acf/tease',
			'acf/statistics',
			'acf/people',
			'acf/issues',
			'acf/grantees',
			'acf/statement',
			'acf/checklist',
		);
	}
}
