<?php
/**
 * UDS WordPress Child Theme functions and definitions
 *
 * @package uds-wordpress-child-theme
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Enqueue child scripts and styles.
 */
function uds_wordpress_child_scripts() {
	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$css_child_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/css/child-theme.min.css' );
	wp_enqueue_style( 'uds-wordpress-child-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array( 'uds-wordpress-styles' ), $css_child_version );

	$js_child_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/js/child-theme.js' );
	wp_enqueue_style( 'uds-wordpress-child-styles', get_stylesheet_directory_uri() . '/js/child-theme.js', array( 'jquery' ), $js_child_version );
}
add_action( 'wp_enqueue_scripts', 'uds_wordpress_child_scripts' );

//enqueue the child-theme.css into the editor
if ( ! function_exists( 'uds_wp_gutenberg_child_css' ) ) {
	/**
	 * Load CSS styles in editor area.
	 */
	function uds_wp_gutenberg_child_css() {
		add_theme_support( 'editor-styles' );
		add_editor_style( 'css/child-theme.min.css' );

	}
}// End of if function_exists( 'uds_wp_gutenberg_child_css' ).
add_action( 'after_setup_theme', 'uds_wp_gutenberg_child_css' );
