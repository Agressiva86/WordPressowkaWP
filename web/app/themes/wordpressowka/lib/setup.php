<?php
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain( 'sasquatch', get_template_directory() . '/lang' );

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support( 'title-tag' );

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support( 'post-thumbnails' );

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  //add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  // add_editor_style(Assets\asset_path('styles/main.css'));
  register_nav_menus(
		[
			'header' => 'Header',
			'footer'      => 'Footer',
		]
	);
}
add_action( 'after_setup_theme', 'setup' );

/**
 * Theme assets
 */

function assets() {
  wp_enqueue_style( 'sasquatch/css', asset_path( 'css/app.css' ), false, null);
  wp_enqueue_script( 'sasquatch/js', asset_path( 'js/app.js' ), ['jquery'], null, true);
}
add_action( 'wp_enqueue_scripts', 'assets', 100 );

// ACF Sync Fields
add_filter( 'acf/settings/save_json', 'acf_json_save_point' );

function acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-fields';

    // return
    return $path;
}

add_filter( 'acf/settings/load_json', 'acf_json_load_point' );

function acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_stylesheet_directory() . '/acf-fields';

    // return
    return $paths;
}

/**
 * Sober Intervention - cleaning wp-admin
 * more info on https://github.com/soberwp/intervention
 */
use function Sober\Intervention\intervention;

if ( function_exists( 'Sober\Intervention\intervention' ) ) {
  intervention( 'add-acf-page', 'Theme Options', [ 'administrator' ] );
  intervention( 'add-dashboard-redirect' );
  intervention( 'add-svg-support' );
}

function deregister_embed() {
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_embed' );

/**
 * Removes comments
 */
// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
	remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action( 'init', 'remove_comment_support', 100 );

function remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');