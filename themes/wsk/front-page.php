<?php
/**
 * Front page.
 *
 * @package WordPressStarterKit
 */

use Timber\Timber;
use Timber\PostQuery;

global $paged;

$context = Timber::context();

$_posts = new PostQuery(
	array(
		'posts_per_page' => 10,
		'post_status'    => 'publish',
		'paged'          => $paged,
	),
	'WordPressStarterKit\Models\Post'
);

$context['posts'] = $_posts;
$context['title'] = 'Latest';

// Render view.
Timber::render( 'pages/archive.twig', $context );
