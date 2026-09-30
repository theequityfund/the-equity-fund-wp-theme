<?php
/**
 * Image Gallery block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['gallery_title'] = get_field( 'gallery_title' );
$context['palette']       = get_field( 'palette' );

$raw_slides = get_field( 'gallery_slides' );
$slides     = array();

if ( ! empty( $raw_slides ) && is_array( $raw_slides ) ) {
	foreach ( $raw_slides as $row ) {
		if ( empty( $row['image'] ) ) {
			continue;
		}

		$slides[] = array(
			'image'   => $row['image'],
			'caption' => $row['caption'] ?? '',
			'credit'  => $row['credit'] ?? '',
		);
	}
}

$context['gallery_slides'] = $slides;
$context['gallery_id']     = wp_unique_id( 'image-gallery-' );

Timber::render( basename( __DIR__ ) . '/image-gallery.twig', $context );
