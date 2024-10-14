<?php
/**
 * Template Name: Article Index
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

	$featured_article            = get_field( 'featured_article' );
	$context['featured_article'] = $featured_article ? Timber::get_post( $featured_article ) : Timber::get_post( array( 'post_type' => 'post' ) );

	$context['articles'] = Timber::get_posts(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 6,
			'post__not_in'   => array( $context['featured_article']->ID ),
			'paged'          => $paged,
		)
	);

	Timber::render( 'pages/page--article-index.twig', $context );
}
