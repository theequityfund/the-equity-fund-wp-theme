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
	$limit           = 4;  // TODO: Update to 6.

	global $paged;
	$query            = isset( $_GET['query'] ) ? sanitize_text_field( $_GET['query'] ) : '';
	$context['query'] = $query;

	$selected_interventions            = isset( $_GET['interventions'] ) ? $_GET['interventions'] : array();
	$selected_interventions            = array_map( 'sanitize_text_field', $selected_interventions );
	$context['selected_interventions'] = $selected_interventions;

	if ( empty( $selected_interventions ) ) {
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
						function( $intervention ) {
							return array(
								'key'     => 'interventions',
								'value'   => '"' . $intervention . '"',
								'compare' => 'LIKE',
							);
						},
						$selected_interventions
					),
				),
			)
		);
	}

	$interventions = Timber::get_posts(
		array(
			'post_type'      => 'intervention',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	$context['interventions'] = $interventions;

	Timber::render( 'pages/page--resource-index.twig', $context );
}
