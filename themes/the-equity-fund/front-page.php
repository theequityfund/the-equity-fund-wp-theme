<?php
/**
 * Front page.
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();
$_page   = Timber::get_post();

$context['page'] = $_page;

// Render view.
Timber::render( 'pages/front-page.twig', $context );
