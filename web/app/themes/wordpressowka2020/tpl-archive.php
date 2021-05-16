<?php
/*
Template Name: Blog archive
*/

$context = Timber::get_context();
$args                   = array(
	'posts_per_page' => 12,
	'post_type'		 => 'articles',
);
$context['posts'] = new Timber\PostQuery( $args, 'OwlPost' );

Timber::render( 'views/templates/tpl-archive.twig', $context );
