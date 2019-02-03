<?php
 /**
  * @package theme
  * Template Name: Front Page
  * Template Post Type: front
  **/

$context          = Timber::get_context();
$context['posts'] = Timber::get_posts();
Timber::render('views/templates/front/front-page.twig', $context);
