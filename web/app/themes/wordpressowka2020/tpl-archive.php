<?php
/*
Template Name: Blog archive
*/

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

$args                   = array(
	'posts_per_page' => 24,
	'post_type'		 => 'articles',
);
$context['posts'] = new Timber\PostQuery( $args, 'OwlPost' );

Timber::render( 'views/templates/tpl-archive.twig', $context );
