<?php
/**
 * Statement block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['headline']    = get_field( 'headline' );
$context['statement']   = get_field( 'statement' );
$context['description'] = get_field( 'description' );
$context['images']      = get_field( 'images' );
$context['cta']         = get_field( 'cta' );
$context['variant']     = get_field( 'variant' );

Timber::render( basename( __DIR__ ) . '/statement.twig', $context );
