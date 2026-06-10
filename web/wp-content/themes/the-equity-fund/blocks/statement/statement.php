<?php
/**
 * Statement block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['overline']              = get_field( 'overline' );
$context['statement']             = get_field( 'statement' );
$context['description']           = get_field( 'description' );
$context['cta']                   = get_field( 'cta' );
$context['variant']               = get_field( 'variant' );
$context['line_above_statement']  = get_field( 'line_above_statement' );
$context['full_width_statement']  = get_field( 'full_width_statement' );

Timber::render( basename( __DIR__ ) . '/statement.twig', $context );
