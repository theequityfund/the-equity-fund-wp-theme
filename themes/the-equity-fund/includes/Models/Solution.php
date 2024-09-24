<?php
/**
 * Solution taxonomy.
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Image;
use Timber\Term;
use Timber\Timber;

/** Class */
class Solution extends Term {
	const TAXONOMY_NAME = 'solution';

	/**
	 * Register the taxonomy type.
	 *
	 * @return void
	 */
	public static function register(): void {
		register_taxonomy(
			self::TAXONOMY_NAME,
			array( 'post' ),
			array(
				'labels'             => array(
					'name'          => 'Solution',
					'singular_name' => 'Solution',
					'not_found'     => 'No Solutions Found',
					'add_new'       => 'Add New Solution',
					'add_new_item'  => 'Add New Solution',
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_in_rest'       => true,
				'show_in_menu'       => true,
			)
		);
	}

	/**
	 * Get thumbnail.
	 *
	 * @return Image|null
	 */
	public function thumbnail(): Image|null {
		$thumbnail = $this->meta( 'thumbnail', $this->ID );

		return Timber::get_image( $thumbnail );
	}
}
