<?php
use TwigWrapper\TwigWrapper;
use CriticalCssProcessor\CriticalCssProcessor;
/**
 * Conditional tags for Timber
 */

function asset_path_no_manifest($filename) {
	$dist_path = get_template_directory_uri() . '/dist/';
	$directory = dirname($filename) . '/';
	$file = basename($filename);

	return $dist_path . $directory . $file;
}

function add_to_context( $data ) {
	$data['is_home']          = is_home();
	$data['is_front_page']    = is_front_page();
	$data['is_single']        = is_single();
	$data['is_page']          = is_page();
	$data['is_page_template'] = is_page_template();
	$data['is_category']      = is_category();
	$data['is_tag']           = is_tag();
	$data['is_tax']           = is_tax();
	$data['is_author']        = is_author();
	$data['is_date']          = is_date();
	$data['is_year']          = is_year();
	$data['is_month']         = is_month();
	$data['is_day']           = is_day();
	$data['is_archive']       = is_archive();
	$data['is_404']           = is_404();
	$data['is_paged']         = is_paged();
	$data['is_singular']      = is_singular();
	$data['is_main_query']    = is_main_query();

	$data['options'] = get_fields( 'options' );

	$data['menu']['header']   = new TimberMenu( 'header' );
	$data['menu']['footer']   = new TimberMenu( 'footer' );
	$data['menu']['top_menu'] = new TimberMenu( 'top_menu' );

	$data['css_file'] = asset_path( 'css/app.css' );
	$data['css_file_purged'] = asset_path( 'css/app-purged.css' );
	$data['css_file_purged_content'] = wp_remote_get( $data['css_file_purged'] );


	if ( is_wp_error( $data['css_file_purged_content'] ) ) {
		$data['css_file_content'] = wp_remote_get( $data['css_file'] );
		if ( is_wp_error( $data['css_file_content'] ) ) {
			$data['load_file'] = false;
		} else {
			$data['load_file'] = true;
			$data['css_file_content'] = str_replace( '../fonts/', get_bloginfo( 'template_url' ) . '/dist/fonts/', $data['css_file_content']['body'] );
		}
	} else {
		$data['load_file'] = true;
		$data['css_file_content'] = str_replace( '../fonts/', get_bloginfo( 'template_url' ) . '/dist/fonts/', $data['css_file_purged_content']['body'] );
	}

	$data['browser'] = $_SERVER['HTTP_USER_AGENT'];
	$data['get_data'] = $_GET;
	return $data;
}
add_filter( 'timber_context', 'add_to_context' );

/**
 * Config vars
 */
function add_to_config( $data ) {
	/**
	 * Example
	 * $data['config']['name'] = 'value'l
	 */
	return $data;
}

add_filter( 'timber_context', 'add_to_config' );
