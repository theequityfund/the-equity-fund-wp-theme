<?php
/**
 * Statement block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\Person;
use Timber\Timber;

$context = Timber::context();

$context['headline'] = get_field( 'headline' );

Timber::render( basename( __DIR__ ) . '/statement.twig', $context );
