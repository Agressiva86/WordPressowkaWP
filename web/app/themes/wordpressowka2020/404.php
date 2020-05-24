<?php

$context = Timber::get_context();
$context['page404'] = true;

$args                   = array(
	'posts_per_page' => 1,
	'post_type'		 => 'post',
);
$context['other_posts'] = Timber::get_posts( $args, 'OwlPost' );
Timber::render( 'views/templates/404.twig', $context );
?>
