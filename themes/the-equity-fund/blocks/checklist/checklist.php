<?php
/**
 * Tease block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['headline']  = get_field( 'headline' );
$context['checklist'] = get_field( 'checklist' );

Timber::render( basename( __DIR__ ) . '/checklist.twig', $context );
