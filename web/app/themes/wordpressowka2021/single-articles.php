<?php
$context = Timber::get_context();
$context['post'] = Timber::get_posts( false, 'OwlPost' )[0];
Timber::render( ['views/templates/single-articles.twig'], $context );
