<?php
/**
 * Template Name: Homepage v2
 *
 * @package theme
 */
$context         = Timber::get_context();
$context['post'] = Timber::get_posts( false, 'OwlPost' )[0];

$args                   = array(
	'posts_per_page' => 3,
);
$context['posts'] = Timber::get_posts( $args, 'OwlPost' );

$args                   = array(
	'posts_per_page' => 3,
	'post_type'	=> 'articles',
);
$context['articles'] = Timber::get_posts( $args, 'OwlPost' );

$args                   = array(
	'posts_per_page' => 3,
	'category_name'		 => 'guest-editor',
);
$context['guest_editors'] = Timber::get_posts( $args, 'OwlPost' );

Timber::render( array( 'views/templates/homepage-v2.twig' ), $context );
