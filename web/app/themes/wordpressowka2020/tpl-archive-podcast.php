<?php
/*
Template Name: Podcast archive
*/

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

$args                   = array(
	'posts_per_page' => 12,
	'post_type'		 => 'podcast',
);
$context['posts'] = new Timber\PostQuery( $args, 'OwlPost' );

Timber::render( 'views/templates/tpl-archive-podcast.twig', $context );
