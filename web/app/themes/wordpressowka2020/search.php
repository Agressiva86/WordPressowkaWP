<?php
/**
 * Template Name: Search
 *
 * @package theme
 */

$context         = Timber::get_context();
$context['post'] = Timber::get_posts()[0];
Timber::render('views/templates/search.twig', $context);
