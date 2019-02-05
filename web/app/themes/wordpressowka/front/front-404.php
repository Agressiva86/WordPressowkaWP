<?php
/*
Template Name: Front 404
Template Post Type: front
*/

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['page404'] = true;
Timber::render( 'views/templates/front/front-404.twig', $context );

?>
