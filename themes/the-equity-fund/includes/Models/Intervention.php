<?php
/**
 * Intervention post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;

/** Class */
class Intervention extends TimberPost {
	const POST_TYPE = 'intervention';

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'Interventions',
			'singular_name' => 'Intervention',
			'not_found'     => 'No Interventions Found',
			'add_new'       => 'Add New Intervention',
			'add_new_item'  => 'Add New Intervention',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-flag',
			'show_in_rest'       => true,
			'show_in_menu'       => true,
			'show_in_ui'         => true,
			'has_archive'        => false,
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'map_meta_cap'       => true,
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
