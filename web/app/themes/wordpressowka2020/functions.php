<?php
require_once __DIR__ . '/vendor/autoload.php';
$timber = new \Timber\Timber();
if ( class_exists( 'Timber' ) ){
    Timber::$cache = true;
}

$sage_includes = [
	'lib/timber.php',
	'lib/assets.php',
	'lib/setup.php',
	'lib/gutenberg.php',
	'lib/Class-owl-post.php',
	'lib/filters.php',
];

foreach ( $sage_includes as $file ) {
	$filepath = locate_template($file);
	if ( ! $filepath ) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'sasquatch'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
