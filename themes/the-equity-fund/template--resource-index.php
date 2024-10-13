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

	$context['page'] = $_page;

	$context['resources'] = Timber::get_posts(
		array(
			'post_type'      => 'resource',
			'posts_per_page' => 4, // TODO: Update to 6.
			'paged'          => $paged,
		)
	);

	Timber::render( 'pages/page--resource-index.twig', $context );
}
