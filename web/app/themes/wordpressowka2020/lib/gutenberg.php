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

	wp_enqueue_style(
		'url_css',
		get_template_directory_uri() . '/dist_tw/css/editor.css',
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

	wp_enqueue_script(
		'url_js',
		get_template_directory_uri() . '/dist_tw/js/editor.js',
		array(),
		'1',
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'acf_block_editor_style' );

add_filter( 'timber/acf-gutenberg-blocks-data/owl-interview', function( $context ){
    $context['fields']['name'] = get_field( 'name', $context['post_id'] );

	$pos = strpos ($context['fields']['answer'],'<p>' );
	if ( $pos !== false ) {
		$newstring = substr_replace( $context['fields']['answer'], '<p><strong class="text-owl-green">' . $context['fields']['name'] . ': </strong>' ,$pos, strlen( '<p>' ) );
		$context['fields']['answer'] = $newstring;
	}

    return $context;
} );

add_filter( 'timber/acf-gutenberg-blocks-data/owl-quote', function( $context ){
    $context['fields']['post_url'] = str_replace( '://app.', '://', get_the_permalink() );

    return $context;
} );
