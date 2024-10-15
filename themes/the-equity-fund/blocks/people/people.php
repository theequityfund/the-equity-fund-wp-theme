<?php
/**
 * People block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['overline']    = get_field( 'overline' );
$context['palette']     = get_field( 'palette' );

Timber::render( basename( __DIR__ ) . '/people.twig', $context );
