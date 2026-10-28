<?php
/**
 * Issue post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;
use Timber\PostCollectionInterface;
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
			'show_ui'            => true,
			'has_archive'        => false,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'map_meta_cap'       => true,
			'rewrite'            => array(
				'slug'       => 'issue',
				'with_front' => false,
			),
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/**
	 * Get the grantees related to this issue.
	 *
	 * @return int
	 */
	public function grantees(): PostCollectionInterface|null {
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

		return $grantees;
	}

	/**
	 * Get issues that are tagged on at least one published item.
	 *
	 * @param string $post_type Post type of the tagged items.
	 * @param string $meta_key  Meta key storing the issue IDs on those items.
	 *
	 * @return PostCollectionInterface|iterable
	 */
	public static function with_items( string $post_type, string $meta_key ) {
		global $wpdb;

		// One query for all issues instead of a count query per issue.
		$rows = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT pm.meta_value FROM {$wpdb->postmeta} pm
				INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE pm.meta_key = %s AND p.post_type = %s AND p.post_status = 'publish'",
				$meta_key,
				$post_type
			)
		);

		$issue_ids = array();
		foreach ( $rows as $row ) {
			// ACF stores relationship values as serialized arrays; a single value may be a plain ID.
			$value     = maybe_unserialize( $row );
			$issue_ids = array_merge( $issue_ids, (array) $value );
		}
		$issue_ids = array_values( array_unique( array_filter( array_map( 'absint', $issue_ids ) ) ) );

		if ( empty( $issue_ids ) ) {
			return array();
		}

		return Timber::get_posts(
			array(
				'post_type'      => self::POST_TYPE,
				'post__in'       => $issue_ids,
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);
	}
}
