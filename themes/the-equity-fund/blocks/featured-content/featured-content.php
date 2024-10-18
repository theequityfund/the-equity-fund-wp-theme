<?php
/**
 * States block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\Resource;
use Timber\Timber;

$context = Timber::context();

$context['headline'] = get_field( 'headline' );

$post_ids = get_field( 'content' );

if ( count( $post_ids ) > 0 ) {
	$context['posts'] = Timber::get_posts(
		array(
			'post_type'      => array( 'post', Resource::POST_TYPE ),
			'post_status'    => 'publish',
			'post__in'       => $post_ids,
			'posts_per_page' => -1,
			'orderby'        => 'post__in',
		)
	);
}

$context['cta'] = get_field( 'cta' );

Timber::render( basename( __DIR__ ) . '/featured-content.twig', $context );
