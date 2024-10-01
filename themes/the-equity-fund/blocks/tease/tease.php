<?php
/**
 * Tease block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['headline'] = 'Tease block';

Timber::render( basename( __DIR__ ) . '/tease.twig', $context );
