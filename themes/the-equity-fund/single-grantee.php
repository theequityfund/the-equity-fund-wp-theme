<?php
/**
 * Single grantee.
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
	$external_link = $_post->meta( 'external_link' );

	// 404 if external link is set.
	if ( $external_link ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 );
		exit();
	}

	$context['post'] = $_post;
	Timber::render( 'pages/grantee.twig', $context );
}
