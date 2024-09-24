<?php
/**
 * State taxonomy.
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();

$_term = Timber::get_term();

$context['term'] = $_term;

Timber::render( 'pages/solution.twig', $context );
