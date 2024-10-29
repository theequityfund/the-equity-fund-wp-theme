<?php
/**
 * Promo block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['overline']   = get_field( 'overline' );
$context['headline']    = get_field( 'headline' );
$context['description'] = get_field( 'description' );
$context['images']      = get_field( 'images' );
$context['cta']         = get_field( 'cta' );

Timber::render( basename( __DIR__ ) . '/promo.twig', $context );
