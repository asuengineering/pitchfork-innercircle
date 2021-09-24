<?php
/**
 * Additional functions for Advanced Custom Fields.
 * 
 * Contents:
 *   - Load path for ACF groups from the parent.
 *   - Register custom blocks for the theme.
 *
 * @package uds-wordpress-innercircle
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
 * Alter field group assignments from the parent theme.
 * Function runs in the admin area once for every field group. Undocumented from ACF. 
 * See: https://support.advancedcustomfields.com/forums/topic/adding-a-new-location-for-a-field-group-programmatically/
 */

add_filter('acf/get_field_group', 'innercircle_alter_parent_theme_fields');
function innercircle_alter_parent_theme_fields($group) {
    
    // Remove story hero from posts.
    if ( 'group_60906f953cd12' == $group['key'] ) {
        do_action( 'qm/debug', $group);
        $group['location'] = array();
    } 
    return $group;
}

/**
 * Register additional custom blocks for the theme.
 */
add_action('acf/init', 'innercircle_acf_init_block_types');
function innercircle_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

		// IC Post Group
		acf_register_block_type(array(
            'name'              => 'ic-post-group',
            'title'             => __( 'IC: Post Group', 'uds-wordpress-theme' ), 
            'description'       => __( 'A block to display stories from Inner Circle', 'uds-wordpress-theme' ), // description the user will see.
            'icon'              => 'star-filled', 
            'render_template'   => 'templates-blocks/post-group.php',
            'category'          => 'inner-circle',
            'keywords'          => array( 'post', 'group' , 'content-section' ),
            'supports'          => array(
                'align' => false,
            ),
            'mode'              => 'preview',
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                    ),
                ),
            ),
        ));

        // IC Post Column
		acf_register_block_type(array(
            'name'              => 'ic-post-column',
            'title'             => __( 'IC: Post Column', 'uds-wordpress-theme' ), 
            'description'       => __( 'A block to display a column of stories from Inner Circle', 'uds-wordpress-theme' ), // description the user will see.
            'icon'              => 'star-filled', 
            'render_template'   => 'templates-blocks/post-column.php',
            'category'          => 'inner-circle',
            'keywords'          => array( 'post', 'column' , 'content-section' ),
            'supports'          => array(
                'align' => false,
            ),
            'mode'              => 'preview',
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                    ),
                ),
            ),
        ));
    }
}