<?php
/**
 * Template Name: NSL
 *
 * @package theme
 */

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['newsletter'] = true;
Timber::render('views/templates/nsl.twig', $context);
