<?php
/**
 * Bootstraps settings and configurations for taxonomies.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Managers;

use TheEquityFund\Models\Solution;


/** Class */
class TaxonomiesManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_taxonomies' ), 1 );
		add_filter( 'timber/term/classmap', array( $this, 'add_custom_taxonomy_classmap' ) );
	}

	/**
	 * Add custom classmap for taxonomies
	 *
	 * @param array $classmap The classmap.
	 * @return array
	 */
	public function add_custom_taxonomy_classmap( $classmap ) {
		$custom_classmap = array(
			'solution' => Solution::class,
		);

		return array_merge( $classmap, $custom_classmap );
	}

	/**
	 * Register taxonomies in WordPress
	 *
	 * @return void
	 */
	public function register_taxonomies(): void {
		Solution::register();
	}
}
