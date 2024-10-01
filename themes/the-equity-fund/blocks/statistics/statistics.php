<?php
/**
 * Statistics block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

Timber::render( basename( __DIR__ ) . '/Statistics.twig', $context );
