<?php
/**
 * Gutenberg related functions
 *
 * @package theme
 */

/**
 * ACF Blocks editor style
 *
 * @return void
 */
function acf_block_editor_style() {
	wp_enqueue_style(
		'url_css',
		get_template_directory_uri() . '/dist/css/editor.css',
		array(),
		'1'
	);

	wp_enqueue_script(
		'url_js',
		get_template_directory_uri() . '/dist/js/editor.js',
		array(),
		'1',
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'acf_block_editor_style' );
