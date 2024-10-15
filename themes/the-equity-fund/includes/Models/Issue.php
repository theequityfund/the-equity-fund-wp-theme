<?php
/**
 * Issue post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;
use Timber\Timber;

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

	/**
	 * Count the number of grantees associated with this issue.
	 *
	 * @return int
	 */
	public function count_grantees(): int {
		$grantees = Timber::get_posts(
			array(
				'post_type'      => Grantee::POST_TYPE,
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'     => 'issues',
						'value'   => '"' . $this->ID . '"',
						'compare' => 'LIKE',
					),
				),
			)
		);

		return count( $grantees );
	}
}
