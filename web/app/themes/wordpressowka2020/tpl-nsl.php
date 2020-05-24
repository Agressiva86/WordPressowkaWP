<?php
/**
 * Template Name: NSL
 *
 * @package theme
 */

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];
$args                   = array(
	'posts_per_page' => 1,
	'post_type'		 => 'post',
);
$context['other_posts'] = Timber::get_posts( $args, 'OwlPost' );
Timber::render('views/templates/nsl.twig', $context);
