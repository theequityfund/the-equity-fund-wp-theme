<?php
/**
 * Bootstraps settings and configurations for taxonomies.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Managers;

/** Class */
class TaxonomiesManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_taxonomies' ), 1 );
	}

	/**
	 * Register taxonomies in WordPress
	 *
	 * @return void
	 */
	public function register_taxonomies(): void {
		register_taxonomy(
			'solution',
			array( 'post' ),
			array(
				'labels'             => array(
					'name'          => 'Solution',
					'singular_name' => 'Solution',
					'not_found'     => 'No Solutions Found',
					'add_new'       => 'Add New Solution',
					'add_new_item'  => 'Add New Solution',
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_in_rest'       => true,
				'show_in_menu'       => true,

			)
		);
	}
}
