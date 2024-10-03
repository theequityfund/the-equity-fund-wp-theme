<?php
/**
 * Statistics block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['headline']   = get_field( 'headline' );
$context['cta']        = get_field( 'cta' );
$context['statistics'] = get_field( 'statistics' );
$context['palette']    = get_field( 'palette' );
$context['size']       = get_field( 'size' );

Timber::render( basename( __DIR__ ) . '/statistics.twig', $context );
