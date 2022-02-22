<?php

$context         = Timber::get_context();
$context['post'] = Timber::get_posts( false, 'OwlPost' )[0];

$args                   = array(
	'posts_per_page' => 7,
	'post__not_in'   => array( $context['post']->ID ),
	'post_type'      => $context['post']->post_type,
	'cache_results' => false,
	'no_found_rows' => true,
);
$context['other_posts'] = Timber::get_posts( $args, 'OwlPost' );

Timber::render( array( 'views/templates/single-' . get_post_type() . '.twig', 'views/templates/index.twig' ), $context );
