<?php
/**
 * Grantee post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;
use Timber\PostCollectionInterface;
use Timber\Timber;

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
			'rewrite'            => array(
				'slug'       => 'grantee',
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

	/**
	 * Get the states related to this grantee.
	 *
	 * @return PostCollectionInterface|null
	 */
	public function states(): PostCollectionInterface|array|null {
		$states = get_field( 'states', $this->ID );

		if ( ! $states ) {
			return array();
		}

		return Timber::get_posts( $states );
	}
}
