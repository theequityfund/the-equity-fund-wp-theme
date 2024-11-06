<?php
/**
 * Grantees block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\Grantee;
use Timber\Timber;

$context = Timber::context();

$context['headline'] = get_field( 'headline' );
$context['show_grantee_description'] = get_field( 'show_grantee_description' );

$grantee_ids = get_field( 'grantees' );

$issue = get_field( 'issue' );
$state = get_field( 'state' );

if ( $grantee_ids && count( $grantee_ids ) ) {
	$context['grantees'] = Timber::get_posts(
		array(
			'post_type'      => Grantee::POST_TYPE,
			'post_status'    => 'publish',
			'post__in'       => $grantee_ids,
			'posts_per_page' => -1,
			'orderby'        => 'post__in',
		)
	);
} elseif ( $issue || $state ) {
	$meta_query = array(
		'relation' => 'AND',
	);

	if ( $issue ) {
		$meta_query[] = array(
			'key'     => 'issues',
			'value'   => '"' . $issue . '"',
			'compare' => 'LIKE',
		);
	}

	if ( $state ) {
		$meta_query[] = array(
			'key'     => 'states',
			'value'   => '"' . $state . '"',
			'compare' => 'LIKE',
		);
	}

	$context['grantees'] = Timber::get_posts(
		array(
			'post_type'      => Grantee::POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'post_date',
			'meta_query'     => $meta_query,
		)
	);
} else {
	$context['grantees'] = Timber::get_posts(
		array(
			'post_type'      => Grantee::POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'post_date',
		)
	);
}

Timber::render( basename( __DIR__ ) . '/grantees.twig', $context );
