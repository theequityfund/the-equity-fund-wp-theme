<?php
/**
 * Tease block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['overline']    = get_field( 'overline' );
$context['headline']    = get_field( 'headline' );
$context['description'] = get_field( 'description' );
$context['cta']         = get_field( 'cta' );
$context['image']       = Timber::get_image( get_field( 'image' ) );
$context['palette']     = get_field( 'palette' );
$context['size']        = get_field( 'size' );

Timber::render( basename( __DIR__ ) . '/tease.twig', $context );
