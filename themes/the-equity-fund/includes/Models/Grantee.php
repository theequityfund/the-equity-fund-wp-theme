<?php
/**
 * Grantee post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;

/** Class */
class Grantee extends TimberPost {
	const POST_TYPE = 'grantee';

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'Grantees',
			'singular_name' => 'Grantee',
			'not_found'     => 'No Grantees Found',
			'add_new'       => 'Add New Grantee',
			'add_new_item'  => 'Add New Grantee',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-groups',
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
