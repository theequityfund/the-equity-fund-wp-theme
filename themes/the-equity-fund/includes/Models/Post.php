<?php
/**
 * Additional functionality for extending the TimberPost object
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;

/** Class */
class Post extends TimberPost {
	/**
	 * Get byline authors.
	 *
	 * @return array
	 */
	public function bylines(): array {
		$authors = $this->meta( 'authors' );

		if ( empty( $authors ) ) {
			return array();
		}

		return array_column( $authors, 'name' );
	}
}
