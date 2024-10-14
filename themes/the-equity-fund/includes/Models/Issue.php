<?php
/**
 * Issue post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;

/** Class */
class Issue extends TimberPost {
	const POST_TYPE = 'issue';

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'Issues',
			'singular_name' => 'Issue',
			'not_found'     => 'No Issues Found',
			'add_new'       => 'Add New Issue',
			'add_new_item'  => 'Add New Issue',
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
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'map_meta_cap'       => true,
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
