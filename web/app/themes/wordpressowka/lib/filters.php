<?php
use Mexitek\PHPColors\Color;

function darken( $color, $amount = '' ) {
	$color = new Color($color);
	if( $amount != '' ){
		$ret   = '#' . $color->darken($amount);
	} else {
		$ret = $color;
	}
	return $ret;
}

function lighten( $color, $amount = '' ) {
	$color = new Color($color);
	if( $amount != '' ){
		$ret   = '#' . $color->lighten($amount);
	} else {
		$ret = $color;
	}
	return $ret;
}

add_filter('timber/twig', 'add_to_twig');

function add_to_twig( $twig ) {
	/* this is where you can add your own functions to twig */
	$twig->addExtension(new Twig_Extension_StringLoader());
	$twig->addFilter(new Twig_SimpleFilter('lighten', 'lighten'));
	$twig->addFilter(new Twig_SimpleFilter('darken', 'darken'));
	return $twig;
}
