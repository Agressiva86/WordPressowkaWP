<?php
/*
Template Name: All Editions
*/

$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

Timber::render( 'views/templates/tpl-editions.twig', $context );
