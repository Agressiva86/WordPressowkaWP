<?php
/**
 * Template Name: NSL v2
 *
 * @package theme
 */

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];
$args                   = array(
	'posts_per_page' => 1,
	'post_type'		 => 'post',
);

$args                   = array(
	'posts_per_page' => 4,
);
$context['posts'] = Timber::get_posts( $args, 'OwlPost' );

$args                   = array(
	'posts_per_page' => 4,
	'post_type'	=> 'articles',
	'orderby' => 'rand',
);
$context['articles'] = Timber::get_posts( $args, 'OwlPost' );

$args                   = array(
	'posts_per_page' => 4,
	'category_name'		 => 'guest-editor',
	'orderby' => 'rand'
);

$context['guest_editors'] = Timber::get_posts( $args, 'OwlPost' );

Timber::render('views/templates/tpl-newsletter.twig', $context);
