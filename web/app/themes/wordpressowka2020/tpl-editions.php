<?php
/*
Template Name: All Editions
*/

$context = Timber::get_context();

if ( get_query_var( 'paged' ) ) {
	$paged_num = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged_num = get_query_var( 'page' );
} else {
	$paged_num = 1;
}

$context['post']        = Timber::get_posts()[0];
$args                   = array(
	'posts_per_page' => 12,
	'paged'          => $paged_num,
);
$context['other_posts'] = new Timber\PostQuery( $args, 'OwlPost' );

Timber::render( 'views/templates/tpl-editions.twig', $context );
