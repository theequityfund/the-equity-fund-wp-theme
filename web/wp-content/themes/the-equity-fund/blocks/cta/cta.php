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

$raw_items = get_field( 'cta_items' );
$items     = array();

if ( ! empty( $raw_items ) && is_array( $raw_items ) ) {
	foreach ( $raw_items as $row ) {
		$items[] = array(
			'title'        => $row['title'] ?? '',
			'description'  => $row['description'] ?? '',
			'image'        => $row['image'] ?? null,
			'link'         => $row['link'] ?? null,
		);
	}
}

$context['cta_items'] = $items;

Timber::render( basename( __DIR__ ) . '/cta.twig', $context );
