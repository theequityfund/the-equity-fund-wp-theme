<?php
/**
 * People block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use Timber\Timber;

$context = Timber::context();

$context['headline']    = get_field( 'headline' );
$context['people'] = get_field( 'people' );

Timber::render( basename( __DIR__ ) . '/people.twig', $context );
