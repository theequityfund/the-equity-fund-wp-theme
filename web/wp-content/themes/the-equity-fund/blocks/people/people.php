<?php
/**
 * People block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\Person;
use Timber\Timber;

$context = Timber::context();

$context['headline'] = get_field( 'headline' );
$context['columns'] = get_field( 'use_5_columns_per_row' ) ? 5 : 4;

$people_ids = get_field( 'people' );

$context['people'] = Timber::get_posts(
	array(
		'post_type'      => Person::POST_TYPE,
		'post_status'    => 'publish',
		'post__in'       => $people_ids,
		'posts_per_page' => -1,
		'orderby'        => 'post__in',
	)
);


Timber::render( basename( __DIR__ ) . '/people.twig', $context );
