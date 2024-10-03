<?php
/**
 * States block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\State;
use Timber\Timber;

$context = Timber::context();

$context['headline'] = get_field( 'headline' );

$provided_states_ids = get_field( 'states' );

$states = Timber::get_posts(
	array(
		'post_type'      => State::POST_TYPE,
		'post_status'    => 'publish',
		'post__in'       => $provided_states_ids && count( $provided_states_ids ) > 0 ? $provided_states_ids : false,
		'posts_per_page' => -1,
		'orderby'        => 'post__in',
	)
);

$context['states'] = $states;
$context['show_grantees_count'] = get_field( 'show_grantees_count' );
$context['cta'] = get_field( 'cta' );

Timber::render( basename( __DIR__ ) . '/states.twig', $context );
