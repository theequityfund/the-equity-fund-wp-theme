<?php
/**
 * CTA block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['headline']     = get_field( 'headline' );
$context['introduction'] = get_field( 'introduction' );
$context['palette']      = get_field( 'palette' );
$context['cta_link']     = get_field( 'cta_link' );
$raw_items               = get_field( 'cta_items' );
$items                   = array();

if ( ! empty( $raw_items ) && is_array( $raw_items ) ) {
	foreach ( $raw_items as $item_id ) {
		$item_post = get_post( $item_id );

		if ( ! $item_post ) {
			continue;
		}

		$items[] = array(
			'title'       => get_the_title( $item_post ),
			'link'        => get_permalink( $item_post ),
			'image'       => get_post_thumbnail_id( $item_post ),
			'description' => get_field( 'description', $item_post->ID ) ? get_field( 'description', $item_post->ID ) : get_the_excerpt( $item_post ),
		);
	}
}

$context['cta_items'] = $items;

Timber::render( basename( __DIR__ ) . '/cta.twig', $context );
