<?php
/**
 * Template Name: Homepage
 *
 * @package TheEquityFund
 */

use Timber\Timber;

$context = Timber::context();
$_page   = Timber::get_post();

$context['page'] = $_page;
Timber::render( 'pages/page--homepage.twig', $context );
