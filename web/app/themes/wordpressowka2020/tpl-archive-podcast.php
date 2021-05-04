<?php
/*
Template Name: Podcast archive
*/

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

Timber::render( 'views/templates/tpl-archive-podcast.twig', $context );
