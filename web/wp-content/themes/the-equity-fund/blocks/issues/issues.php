<?php
/**
 * Issues block.
 *
 * @package TheEquityFund
 * @param array $block The block settings and attributes.
 */

use TheEquityFund\Models\Issue;
use Timber\Timber;

$context = Timber::context();

$context['headline']            = get_field( 'headline' );
$context['show_grantees_count'] = get_field( 'show_grantees_count' );

$issue_ids = get_field( 'issues' );

$context['issues'] = Timber::get_posts(
	array(
		'post_type'      => Issue::POST_TYPE,
		'post_status'    => 'publish',
		'post__in'       => $issue_ids,
		'posts_per_page' => -1,
		'orderby'        => 'post__in',
	)
);


Timber::render( basename( __DIR__ ) . '/issues.twig', $context );
