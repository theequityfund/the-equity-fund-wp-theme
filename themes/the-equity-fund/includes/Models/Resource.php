<?php
/**
 * Resource post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;
use Timber\Timber;

/** Class */
class Resource extends TimberPost {
	const POST_TYPE = 'resource';

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'Resources',
			'singular_name' => 'Resource',
			'not_found'     => 'No Resources Found',
			'add_new'       => 'Add New Resource',
			'add_new_item'  => 'Add New Resource',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-media-text',
			'show_in_rest'       => true,
			'show_in_menu'       => true,
			'show_in_ui'         => true,
			'has_archive'        => false,
			'supports'           => array( 'title', 'excerpt', 'thumbnail' ),
			'map_meta_cap'       => true,
			'rewrite'            => array(
				'slug' => 'resource',
				'with_front' => false,
			),
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/**
	 * Get issue.
	 *
	 * @return array
	 */
	public function issue(): Issue|null {
		// phpcs:ignore
		/** @var string $issue */
		$issues = $this->meta( 'issues' );

		if ( empty( $issues ) ) {
			return null;
		}

		return Timber::get_post( $issues[0] );
	}
}
