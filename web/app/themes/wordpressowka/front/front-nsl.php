<?php
/*
Template Name: Front NSL
Template Post Type: front
*/

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['newsletter'] = true;
Timber::render( 'views/templates/front/front-nsl.twig', $context );

?>
