<?php
/**
 * Statement block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['statement'] = get_field( 'statement' );
$context['description'] = get_field( 'description' );

Timber::render( basename( __DIR__ ) . '/statement.twig', $context );
