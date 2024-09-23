<?php
/**
 * States block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context                = Timber::context();

$context['headline'] = get_field( 'headline' );

Timber::render( basename( __DIR__ ) . '/states.twig', $context );
