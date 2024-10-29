<?php
/**
 * State post type.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;
use Timber\PostCollectionInterface;
use Timber\Timber;

/** Class */
class State extends TimberPost {
	const POST_TYPE = 'state';

	const STATES = array(
		'Alabama',
		'Alaska',
		'Arizona',
		'Arkansas',
		'California',
		'Colorado',
		'Connecticut',
		'Delaware',
		'Florida',
		'Georgia',
		'Hawaii',
		'Idaho',
		'Illinois',
		'Indiana',
		'Iowa',
		'Kansas',
		'Kentucky',
		'Louisiana',
		'Maine',
		'Maryland',
		'Massachusetts',
		'Michigan',
		'Minnesota',
		'Mississippi',
		'Missouri',
		'Montana',
		'Nebraska',
		'Nevada',
		'New Hampshire',
		'New Jersey',
		'New Mexico',
		'New York',
		'North Carolina',
		'North Dakota',
		'Ohio',
		'Oklahoma',
		'Oregon',
		'Pennsylvania',
		'Rhode Island',
		'South Carolina',
		'South Dakota',
		'Tennessee',
		'Texas',
		'Utah',
		'Vermont',
		'Virginia',
		'Washington',
		'West Virginia',
		'Wisconsin',
		'Wyoming',
	);

	/**
	 * Register the post type.
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
			'rewrite'            => array(
				'slug' => 'state',
				'with_front' => false,
			),
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/**
	 * Get the state slug.
	 *
	 * @return string|null
	 */
	public function handle(): string|null {
		if ( $this->meta( 'state' ) ) {
			return $this->meta( 'state' );
		}

		$title = $this->title();

		if ( in_array( $title, self::STATES ) ) {
			return str_replace( ' ', '-', strtolower( $title ) );
		}

		return null;
	}

	/**
	 * Get the grantees related to this state.
	 *
	 * @return PostCollectionInterface|null
	 */
	public function grantees(): PostCollectionInterface|null {
		return Timber::get_posts(
			array(
				'post_type'  => Grantee::POST_TYPE,
				'meta_query' => array(
					array(
						'key'     => 'states',
						'value'   => $this->ID,
						'compare' => 'LIKE',
					),
				),
			)
		);

	}
}
