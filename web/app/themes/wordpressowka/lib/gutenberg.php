<?php
/**
 * Gutenberg related functions
 *
 * @package theme
 */

/**
 * Registers block "Links" for ACF Blocks
 */
function owl_blocks() {
	if ( function_exists('acf_register_block') ) {
		acf_register_block(
			[
				'name'            => 'owl_link',
				'title'           => 'Link',
				'description'     => 'Link do artykułu',
				'render_callback' => 'owl_block_link_render_callback',
				'category'        => 'layout',
				'icon'            => 'menu',
				'keywords'        => [ 'link', 'linki' ],
			]
		);

		acf_register_block(
			[
				'name'            => 'owl_fb_banner',
				'title'           => 'FB Banner',
				'description'     => 'Banner FB',
				'render_callback' => 'owl_block_fb_banner_render_callback',
				'category'        => 'layout',
				'icon'            => 'menu',
				'keywords'        => [ 'fb' ],
			]
		);

		acf_register_block(
			[
				'name'            => 'owl_newsletter_banner',
				'title'           => 'Newsletter Banner',
				'description'     => 'Banner Newsletter',
				'render_callback' => 'owl_block_newsletter_banner_render_callback',
				'category'        => 'layout',
				'icon'            => 'menu',
				'keywords'        => [ 'newsletter' ],
			]
		);
	}
}
add_action('acf/init', 'owl_blocks');

/**
 * Renders block "linki"
 *
 * @param array  $block - block information.
 * @param string $content - block content.
 * @param bool   $is_preview - checks if showing in gutenberg.
 */
function owl_block_link_render_callback( $block, $content = '', $is_preview ) {
	$context               = Timber::get_context();
	$context['block']      = $block;
	$context['fields']     = get_fields();
	$context['is_preview'] = $is_preview;
	Timber::render('views/blocks/link.twig', $context);
}

/**
 * Renders block "fb banner"
 *
 * @param array  $block - block information.
 * @param string $content - block content.
 * @param bool   $is_preview - checks if showing in gutenberg.
 */
function owl_block_fb_banner_render_callback( $block, $content = '', $is_preview ) {
	$context               = Timber::get_context();
	$context['block']      = $block;
	$context['fields']     = get_fields();
	$context['is_preview'] = $is_preview;
	Timber::render('views/blocks/fb_banner.twig', $context);
}

/**
 * Renders block "newsletter banner"
 *
 * @param array  $block - block information.
 * @param string $content - block content.
 * @param bool   $is_preview - checks if showing in gutenberg.
 */
function owl_block_newsletter_banner_render_callback( $block, $content = '', $is_preview ) {
	$context               = Timber::get_context();
	$context['block']      = $block;
	$context['fields']     = get_fields();
	$context['is_preview'] = $is_preview;
	Timber::render('views/blocks/newsletter_banner.twig', $context);
}

/**
 * ACF Blocks editor style
 *
 * @return void
 */
function acf_block_editor_style() {
	wp_enqueue_style(
		'url_css',
		get_template_directory_uri() . '/dist/css/editor.css'
	);
}

add_action('enqueue_block_editor_assets', 'acf_block_editor_style');
