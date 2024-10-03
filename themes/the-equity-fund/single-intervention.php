<?php
/**
 * Single intervention.
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();

$_post = Timber::get_post( false );

// If post is password protected, render password page.
if ( post_password_required( $_post->ID ) ) {
	$cookie_value       = $_COOKIE[ 'wp-postpass_' . COOKIEHASH ];
	$context['error']   = ! isset( $cookie_value ) ? false : 'Password is incorrect.';
	$context['post_id'] = $_post->ID;

	Timber::render( 'pages/password.twig', $context );
} else {
	$context['post'] = $_post;
	Timber::render( 'pages/intervention.twig', $context );
}
