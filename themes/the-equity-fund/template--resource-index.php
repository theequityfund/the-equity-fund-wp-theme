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
	global $paged;
	$query         = isset( $_GET['query'] ) ? sanitize_text_field( $_GET['query'] ) : '';
	$interventions = isset( $_GET['interventions'] ) ? $_GET['interventions'] : array();
	$interventions = array_map( 'sanitize_text_field', $interventions );

	$context['page'] = $_page;

	if ( empty( $interventions ) ) {
		$context['resources'] = Timber::get_posts(
			array(
				'post_type'      => 'resource',
				'posts_per_page' => 4, // TODO: Update to 6.
				'paged'          => $paged,
				's'              => $query,
			)
		);
	} else {
		$context['resources'] = Timber::get_posts(
			array(
				'post_type'      => 'resource',
				'posts_per_page' => 4, // TODO: Update to 6.
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
						$interventions
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
