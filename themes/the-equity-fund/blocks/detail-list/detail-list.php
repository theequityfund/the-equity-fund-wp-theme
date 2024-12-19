<?php
/**
 * Detail List block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['overline']       = get_field( 'overline' );
$context['statement']   = get_field( 'statement' );
$context['detail_list'] = get_field( 'detail_list' );
$context['numbered']  = get_field( 'numbered' );

Timber::render( basename( __DIR__ ) . '/detail-list.twig', $context );
