<?php

$context = Timber::get_context();
$context['page404'] = true;
Timber::render( 'views/templates/404.twig', $context );
?>
