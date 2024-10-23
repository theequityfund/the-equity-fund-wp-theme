<?php
/**
 * Tease block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['groups'] = get_field( 'groups' );

Timber::render( basename( __DIR__ ) . '/checklist.twig', $context );
