<?php
/**
 * Single issue.
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();

$_post = Timber::get_post( false );

// Tag-only issues must not be reachable by URL.
if ( ! $_post->has_page() ) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
	$context['wp_title'] = '404 Not Found';
	Timber::render( 'pages/404.twig', $context );
	return;
}

// If post is password protected, render password page.
if ( post_password_required( $_post->ID ) ) {
	$cookie_value       = $_COOKIE[ 'wp-postpass_' . COOKIEHASH ];
	$context['error']   = ! isset( $cookie_value ) ? false : 'Password is incorrect.';
	$context['post_id'] = $_post->ID;

	Timber::render( 'pages/password.twig', $context );
} else {
	$context['issue'] = $_post;
	Timber::render( 'pages/issue.twig', $context );
}
