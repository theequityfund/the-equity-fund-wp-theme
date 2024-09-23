<?php
/**
 * State post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;

/** Class */
class State extends TimberPost {
	const POST_TYPE = 'state';

	/**
	 * Register the State post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'States',
			'singular_name' => 'State',
			'not_found'     => 'No States Found',
			'add_new'       => 'Add New State',
			'add_new_item'  => 'Add New State',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-location-alt',
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
