<?php
/**
 * Person post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;

/** Class */
class Person extends TimberPost {
	const POST_TYPE = 'person';

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'People',
			'singular_name' => 'Person',
			'not_found'     => 'No People Found',
			'add_new'       => 'Add New Person',
			'add_new_item'  => 'Add New Person',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-admin-users',
			'show_in_rest'       => false,
			'show_in_menu'       => true,
			'show_ui'            => true,
			'has_archive'        => false,
			'supports'           => array( 'title', 'excerpt', 'thumbnail' ),
			'map_meta_cap'       => true,
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
