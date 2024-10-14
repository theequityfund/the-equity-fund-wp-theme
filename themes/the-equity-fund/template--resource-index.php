<?php
/**
 * Template Name: Resource Index
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();
$_page   = Timber::get_post();

// If page is password protected, render password page.
if ( post_password_required( $_page->ID ) ) {
	$cookie_value       = $_COOKIE[ 'wp-postpass_' . COOKIEHASH ];
	$context['error']   = ! isset( $cookie_value ) ? false : 'Password is incorrect.';
	$context['post_id'] = $_page->ID;

	Timber::render( 'pages/password.twig', $context );
} else {
	$context['page'] = $_page;
	$limit           = 6;

	global $paged;
	$query            = isset( $_GET['query'] ) ? sanitize_text_field( $_GET['query'] ) : '';
	$context['query'] = $query;

	$selected_issues            = isset( $_GET['issues'] ) ? $_GET['issues'] : array();
	$selected_issues            = array_map( 'sanitize_text_field', $selected_issues );
	$context['selected_issues'] = $selected_issues;

	if ( empty( $selected_issues ) ) {
		$context['resources'] = Timber::get_posts(
			array(
				'post_type'      => 'resource',
				'posts_per_page' => $limit,
				'paged'          => $paged,
				's'              => $query,
			)
		);
	} else {
		$context['resources'] = Timber::get_posts(
			array(
				'post_type'      => 'resource',
				'posts_per_page' => $limit,
				'paged'          => $paged,
				's'              => $query,
				'meta_query'     => array(
					'relation' => 'OR',
					...array_map(
						function( $issue ) {
							return array(
								'key'     => 'issues',
								'value'   => '"' . $issue . '"',
								'compare' => 'LIKE',
							);
						},
						$selected_issues
					),
				),
			)
		);
	}

	$issues = Timber::get_posts(
		array(
			'post_type'      => 'issue',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	$context['issues'] = $issues;

	Timber::render( 'pages/page--resource-index.twig', $context );
}
