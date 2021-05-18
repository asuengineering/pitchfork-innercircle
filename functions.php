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

/**
 * Enqueue the child-theme.css into the editor.
 */
function uds_wp_gutenberg_child_css() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/child-theme.min.css' );

}
add_action( 'after_setup_theme', 'uds_wp_gutenberg_child_css' );


// Other included partials for functions.php.
// ===============================================
require get_stylesheet_directory() . '/inc/custom-post-types.php';
require get_stylesheet_directory() . '/inc/acf-register.php';

/** 
 * Pull just the categories and tags lines from the parent.
 * Used directly in the story-hero replacement for the theme.
 */
function innercircle_print_categories_tags() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = preg_replace( '/<a /', '<a class="btn btn-tag btn-tag-alt-white"', get_the_category_list( ' ' ) );

	if ( $categories_list && uds_wp_categorized_blog() ) {
		if ( ! is_single() ) {
			printf( '<div class="card-tags">%s</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			printf( '<div class="category-tags">%s</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'uds-wordpress-theme' ) );
	if ( $tags_list ) {
		/* translators: %s: Tags of current post */
		printf( '<div class="tags-links"><span class="fas fa-tags" title="Tags"></span>%s</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}