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
				'icon'            => 'location-alt',
				'keywords'        => [ 'link', 'linki' ],
			]
		);

		acf_register_block(
			[
				'name'            => 'owl_title',
				'title'           => 'Tytuł',
				'description'     => 'Tytuł artykułu',
				'render_callback' => 'owl_block_title_render_callback',
				'category'        => 'layout',
				'icon'            => 'location-alt',
				'keywords'        => [ 'tytuł' ],
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