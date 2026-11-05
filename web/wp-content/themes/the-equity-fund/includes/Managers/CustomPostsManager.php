<?php
/**
 * Bootstraps settings and configurations for custom post types.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Managers;

use TheEquityFund\Models\Grantee;
use TheEquityFund\Models\Issue;
use TheEquityFund\Models\Person;
use TheEquityFund\Models\Post;
use TheEquityFund\Models\Resource;
use TheEquityFund\Models\State;


/** Class */
class CustomPostsManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'init', array( $this, 'register_post_types' ), 1 );

		// These 404, so they must not be advertised to search engines.
		add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', array( Issue::class, 'page_less_ids' ) );

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
			'post'     => Post::class,
			'state'    => State::class,
			'grantee'  => Grantee::class,
			'resource' => Resource::class,
			'issue'    => Issue::class,
			'person'   => Person::class,
		);

		return array_merge( $classmap, $custom_classmap );
	}


	/**
	 * Register post types in WoPostsrdPress
	 *
	 * @return void
	 */
	public function register_post_types() {
		State::register();
		Grantee::register();
		Resource::register();
		Issue::register();
		Person::register();
	}
}
