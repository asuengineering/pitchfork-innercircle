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
        // do_action( 'qm/debug', $group);
        $group['location'] = array();
    }

    // Remove hero from category pages. Leave in place for pages.
    if ( 'group_5ef954da477f5' == $group['key'] ) {
        do_action( 'qm/debug', $group);
        $group['location'] = array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            )
        );
        do_action( 'qm/debug', $group);
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

 function return_repeater_row_string($acf_input_name){
    // When using the acf/validate_value filter, the name of the current input is $input_name.
    // That should look something like this: acf[repeater_field_id]][row-xxx][field_id]
    // This function will return 'row-xxx'
    // Use case: Validate a control within a repeater field against another control in the same row.
    $needle = strpos($input_name, 'row-' );
    $secondbracket = strpos($input_name, ']', $needle);
    $length = $secondbracket - $needle;
    $rownum = substr($input_name, $needle, $length);
    
    return $rownum;
 }

/**
 * Validate meta box end date content.
 *    1. End date should be > start date.
 *    2. Except if date type = deadline. It'll be the only date collected at that point.
 */ 
function innercircle_acf_validate_end_date( $valid, $value, $field, $input_name ) {

    // Bail early if value is already invalid.
    if( $valid !== true ) {
        return $valid;
    }

    // EndDate Field ID: field_60930e835b060
    // StartDate Field ID: field_60930de85b05f
    
    // Calculate which row is being accessed in the repeater.
    $rownum = return_repeater_row_string($input_name);
    $start_date = $_POST['acf']['field_6093127e5b065'][$rownum]['field_60930de85b05f'];

    // Get start date, make sure that both are the same date format.
    $start_dts = strtotime($start_date);
    $end_dts = strtotime($value);

    if (! $start_dts) {
        // strtotime returns false if the date string can't be converted.
        // Likely means that the control is unset. No validation necessary in that case.
        return $valid;
    }

    if ( $start_dts > $end_dts ) {
        return __( 'The end time must occur after the start time.');
    } else {
        return $valid;
    }
}
add_filter('acf/validate_value/key=field_60930e835b060', 'innercircle_acf_validate_end_date', 10, 4);
