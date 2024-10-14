<?php
/**
 * Additional functionality for extending the TimberPost object
 *
 * @package TheEquityFund
 */

namespace TheEquityFund\Models;

use Timber\Post as TimberPost;
use Timber\Timber;

/** Class */
class Post extends TimberPost {
	/**
	 * Get byline authors.
	 *
	 * @return array
	 */
	public function bylines(): array {
		// phpcs:ignore
		/** @var array $authors */
		$authors = $this->meta( 'authors' );

		if ( empty( $authors ) ) {
			return array();
		}

		return array_column( $authors, 'name' );
	}

	/**
	 * Get issue.
	 *
	 * @return array
	 */
	public function issue(): Issue|null {
		// phpcs:ignore
		/** @var string $issue */
		$issue = $this->meta( 'issue' );

		if ( empty( $issue ) ) {
			return null;
		}

		return Timber::get_post( $issue );
	}
}
