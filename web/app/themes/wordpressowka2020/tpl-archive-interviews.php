<?php
/*
Template Name: Interviews archive
*/

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

$args                   = array(
	'posts_per_page' => 60,
	'post_type'		 => 'interviews',
);
$context['posts'] = new Timber\PostQuery( $args, 'OwlPost' );

Timber::render( 'views/templates/tpl-archive-interviews.twig', $context );
