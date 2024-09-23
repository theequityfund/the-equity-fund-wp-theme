<?php
/**
 * Single state.
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();

// Fetch the current post using default query and the theme's Post model.
$_post = Timber::get_post( false );

// If post is password protected, render password page.
if ( post_password_required( $_post->ID ) ) {
	$cookie_value       = $_COOKIE[ 'wp-postpass_' . COOKIEHASH ];
	$context['error']   = ! isset( $cookie_value ) ? false : 'Password is incorrect.';
	$context['post_id'] = $_post->ID;

	Timber::render( 'pages/password.twig', $context );
} else {
	$context['post'] = $_post;
	Timber::render( 'pages/state.twig', $context );
}
