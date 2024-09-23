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

$provided_states = get_field( 'states' );

$states = Timber::get_posts(
	array(
		'post_type'      => State::POST_TYPE,
		'post_status'    => 'publish',
		'post__in'       => $provided_states && count( $provided_states ) > 0 ? array_column( $provided_states, 'ID' ) : false,
		'posts_per_page' => -1,
		'orderby'        => 'post__in',
	)
);

$context['states'] = $states;

Timber::render( basename( __DIR__ ) . '/states.twig', $context );
