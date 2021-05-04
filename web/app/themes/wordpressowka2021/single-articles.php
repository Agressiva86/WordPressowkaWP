<?php
$context = Timber::get_context();
$context['post'] = Timber::get_posts( false, 'OwlPost' )[0];

$args                   = array(
	'posts_per_page' => 3,
	'post__not_in'   => array( $context['post']->ID ),
	'post_type'	     => 'articles',
);
$context['other_posts'] = Timber::get_posts( $args, 'OwlPost' );

Timber::render( ['views/templates/single-articles.twig'], $context );
