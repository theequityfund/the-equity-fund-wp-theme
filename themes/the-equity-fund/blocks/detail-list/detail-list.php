<?php
/**
 * Detail List block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['title']       = get_field( 'title' );
$context['statement']   = get_field( 'statement' );
$context['detail_list'] = get_field( 'detail_list' );
$context['list_style']  = get_field( 'list_style' );

Timber::render( basename( __DIR__ ) . '/detail-list.twig', $context );
