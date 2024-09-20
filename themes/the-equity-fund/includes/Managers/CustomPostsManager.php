<?php
/**
 * Bootstraps settings and configurations for custom post types.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Managers;

use TheEquityFund\Models\Post;
use TheEquityFund\Models\Solution;


/** Class */
class CustomPostsManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_post_types' ), 1 );

		add_filter( 'timber/post/classmap', array( $this, 'add_custom_post_classmap' ) );
	}

	/**
	 * Add custom post class map.
	 *
	 * @param array $classmap Class map.
	 * @return array
	 */
	public function add_custom_post_classmap( $classmap ) {
		$custom_classmap = array(
			'post' => Post::class,
		);

		return array_merge( $classmap, $custom_classmap );
	}


	/**
	 * Register post types in WoPostsrdPress
	 *
	 * @return void
	 */
	public function register_post_types() {
		Solution::register();
	}
}
