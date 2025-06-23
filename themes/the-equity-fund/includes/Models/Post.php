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
	public function issue(): iterable|null {
		// phpcs:ignore
		/** @var array $issue_ids */
		$issue_ids = $this->meta( 'issue' );

		if ( empty( $issue_ids ) ) {
			return null;
		}

		return Timber::get_posts(
			array(
				'post_type'      => 'issue',
				'post__in'       => $issue_ids,
				'orderby'        => 'post__in',
				'posts_per_page' => -1,
			)
		);
	}
}
