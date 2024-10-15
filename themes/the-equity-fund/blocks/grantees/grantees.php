<?php
/**
 * Grantees block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\Grantee;
use Timber\Timber;

$context = Timber::context();

$context['headline'] = get_field( 'headline' );

$grantee_ids = get_field( 'grantees' );

$context['grantees'] = Timber::get_posts(
	array(
		'post_type'      => Grantee::POST_TYPE,
		'post_status'    => 'publish',
		'post__in'       => $grantee_ids,
		'posts_per_page' => -1,
		'orderby'        => 'post__in',
	)
);


Timber::render( basename( __DIR__ ) . '/grantees.twig', $context );
