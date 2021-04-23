<?php
/**
 * Additional functions for Advanced Custom Fields.
 * 
 * Contents:
 *   - Load path for ACF groups from the parent.
 *   - Register custom blocks for the theme.
 *
 * @package uds-wordpress-furi
 */


/**
 * Add additional loading point for the parent theme's ACF groups.
 *
 * @return $paths
 */
add_filter( 'acf/settings/load_json', 'innercircle_parent_theme_field_groups' );
function innercircle_parent_theme_field_groups( $paths ) {
	$path = get_template_directory() . '/acf-json';
	$paths[] = $path;
	return $paths;
}

/**
 * Create save point for the child theme's ACF groups.
 *
 * @return $paths
 */
add_filter( 'acf/settings/save_json', 'innercircle_child_theme_field_groups' );
function innercircle_child_theme_field_groups( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

/**
 * Register additional custom blocks for the theme.
 */
add_action('acf/init', 'innercircle_acf_init_block_types');
function innercircle_acf_init_block_types() {
    // The sky is the limit.
}