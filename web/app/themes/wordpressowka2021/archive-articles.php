<?php
/**
 * Template Name: Archive - Articles
 */

$context         = Timber::get_context();
$context['post'] = Timber::get_posts()[0];
Timber::render('views/templates/archive-articles.twig', $context);
