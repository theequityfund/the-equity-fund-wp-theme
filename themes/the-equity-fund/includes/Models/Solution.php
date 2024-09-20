<?php
/**
 * Solutions model.
 *
 * @package TheEquityFund
 */

 namespace TheEquityFund\Models;

 use Timber\Timber;

 /** Class */
class Solution extends \Timber\Post {
	const POST_TYPE = 'solution';

	/**
	 * Register the Person post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => 'Solution',
			'singular_name' => 'Solution',
			'not_found'     => 'No Solutions Found',
			'add_new'       => 'Add New Solution',
			'add_new_item'  => 'Add New Solution',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-lightbulb',
			'show_in_rest'       => true,
			'show_in_menu'       => true,
			'show_in_ui'         => true,
			'has_archive'        => false,
			'supports'           => array( 'title' ),
			'map_meta_cap'       => true,
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
