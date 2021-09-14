<?php
/**
 * Additional functions for Gravity Forms within this site.
 * 
 * Contents:
 *   - Add taxonomy items to intake form's dropdown fields.
 *   - Enqueue additional CSS file for UDS
 *
 * @package uds-wordpress-innercircle
 */

add_filter('gform_pre_render_1', 'innercircle_intakeform_populate_categories');
function innercircle_intakeform_populate_categories($form){

    $terms = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'orderby'   =>'title',
        'order'   =>'ASC',
    ) );

    //Creating radio button item array.
    $items = array();

    //Adding post titles to the items array
    foreach($terms as $term) {
        $items[] = array(
           "value" => $term->term_id, 
           "text" =>  $term->name
      );
    }

    //Adding items to field id 38
    foreach($form["fields"] as $field) {
        if($field["id"] == 20){
            $field["type"] = "radio";
            $field["choices"] = $items;
        }
    }

    return $form;
}

add_filter('gform_pre_render_1', 'innercircle_intakeform_populate_tags');
function innercircle_intakeform_populate_tags($form){

    $terms = get_terms( array(
        'taxonomy' => 'post_tag',
        'hide_empty' => false,
        'orderby'   =>'title',
        'order'   =>'ASC',
    ) );

    //Creating drop down item array.
    $items = array();

    //Adding initial blank value.
    $items[] = array("text" => "", "value" => "");

    //Adding tag names to the items array
    foreach($terms as $term) {
        $items[] = array(
           "value" => $term->term_id, 
           "text" =>  $term->name
      );
    }

    //Adding items to field id 38
    foreach($form["fields"] as &$field) {
        if($field["id"] == 23){
            $field["type"] = "dropdown";
            $field["choices"] = $items;
        }
    }

    return $form;
}

add_filter('gform_pre_render_1', 'innercircle_intakeform_populate_eventlocation');
function innercircle_intakeform_populate_eventlocation($form){

    $terms = get_terms( array(
        'taxonomy' => 'event_location',
        'hide_empty' => false,
        'orderby'   =>'title',
        'order'   =>'ASC',
    ) );

    //Creating drop down item array.
    $items = array();

    //Adding initial blank value.
    $items[] = array("text" => "", "value" => "");

    //Adding post titles to the items array
    foreach($terms as $term) {
        $items[] = array(
           "value" => $term->term_id, 
           "text" =>  $term->name
      );
    }

    //Adding items to field id 38
    foreach($form["fields"] as &$field) {
        if($field["id"] == 10){
            $field["type"] = "dropdown";
            $field["choices"] = $items;
        }
    }

    return $form;
}

add_filter( 'gform_save_field_value_1_3', 'innercircle_intakeform_format_date_fields', 10, 5 );
add_filter( 'gform_save_field_value_1_3', 'innercircle_intakeform_format_date_fields', 10, 5 );
function innercircle_intakeform_format_date_fields ($value, $entry, $field, $form) {
    // set the form ID and field ID here
    $timestamp = strtotime ( $value );
    $value = date ( 'Y-m-d H:i:s', $timestamp );
    return $value;
}

add_action( 'gform_advancedpostcreation_post_after_creation_1', 'innercircle_intakeform_populate_acf_fields', 10, 4 );
function innercircle_intakeform_populate_acf_fields($post_id, $feed, $entry, $form) {
    // Repeater fields need to have underscore + field names generated.
    // Actual post meta items will be created by ACF - this function should just add the field IDs.
    // See: https://bionicteaching.com/gravity-forms-to-acf-pattern/
    // Repeater fields also need to have ic_event_meta_entry row created with # of items in the repeater.
    // The event link is also stored as seralized data. Make an array, use maybe_seralize to return the storable object.

    // update_field('','',$post_id);

    do_action( 'qm/debug', $post_id); 
    do_action( 'qm/debug', $entry); 

    // Set the category and tags based on the fields.
    $category = rgar ( $entry, '20');
    $tags = rgar( $entry, '23');
    $postcontent = rgar( $entry, '15');

    wp_set_object_terms( $post_id, intval($category), 'category');
    wp_set_object_terms( $post_id, intval($tags), 'post_tag');

    // Get the repeater array and the total number of events captured.
    $repeater = maybe_unserialize( rgar( $entry, '13' ) );
    $repeater_total_events = count($repeater);

    // Get the date values from within the first set of date fields within the repeater array.
    // The remaining sets of date fields will be empty. This is a GF bug. 
    $start_date_array = rgars( $repeater, '1/6');
    $end_date_array = rgars( $repeater, '1/7');
    $start_time_array = rgars( $repeater, '1/8');
    $end_time_array = rgars( $repeater, '1/9');

    $dr_index = 0;
    $start_dts = [];
    $end_dts = [];
    for ($dates = 1; $dates <= $repeater_total_events; $dates++) {
        $startdate = $start_date_array[$dr_index + 2] . '-' . $start_date_array[$dr_index] . '-' . $start_date_array[$dr_index + 1];
        $enddate = $end_date_array[$dr_index + 2] . '-' . $end_date_array[$dr_index] . '-' . $end_date_array[$dr_index + 1];

        $starttime = $start_time_array[$dr_index] . ':' . $start_time_array[$dr_index + 1] . $start_time_array[$dr_index + 2];
        $endtime = $end_time_array[$dr_index] . ':' . $end_time_array[$dr_index + 1] . $end_time_array[$dr_index + 2];

        $start_stamp = DateTime::createFromFormat('Y-m-d h:ia', $startdate . ' ' . $starttime);
        $end_stamp = DateTime::createFromFormat('Y-m-d h:ia', $enddate . ' ' . $endtime);
        
        array_push($start_dts, $start_stamp->format('Y-m-d H:i:s'));
        array_push($end_dts, $end_stamp->format('Y-m-d H:i:s'));

        $dr_index = $dr_index + 3;
    }

    do_action( 'qm/debug', $start_dts);
    do_action( 'qm/debug', $end_dts);

    // Repeater Field ID: field_6093127e5b065. Should be an array of arrays

    $dts_index = 0;
    $acf_rows = [];
    foreach ($repeater as $event) {
        // ACF Field IDs, hard coded. 
        do_action( 'qm/debug', $event); 
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_title', 'field_609310575b062' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_subtitle', 'field_6093106f5b063' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_link', 'field_609311105b064' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_display', 'field_60931d4bfbba9' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_start_dt', 'field_60930de85b05f' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_end_dt', 'field_60930e835b060' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_building', 'field_609436a646343' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_room', 'field_609437a446344' ,$post_id);
        // update_field('_ic_event_meta_entry_' . $acf_index . '_ic_event_meta_agenda', 'field_60930f995b061' ,$post_id);

        $title = rgars( $event, '1/0');
        $subtitle = rgars( $event, '2/0');
        // Deal with the link field. Seralize rgar ($event, '5') + additional info.;
        
        $display = rgars ($event, '3/0');
        $acf_start = $start_dts[$dts_index];
        $acf_end = $end_dts[$dts_index];

        $building = rgars( $event, '10/0');
        $room = rgars( $event, '11/0');
        $agenda = rgars( $event, '12/0');

        $current_event = array(
            'ic_event_meta_title' => $title,
            'ic_event_meta_subtitle' => $subtitle,
            'ic_event_meta_display' => $display,
            'ic_event_meta_start_dt' => $acf_start,
            'ic_event_meta_end_dt' => $acf_end,
            'ic_event_meta_building' => $building,
            'ic_event_meta_room' => $room,
            'ic_event_meta_agenda' => $agenda
        );

        array_push($acf_rows, $current_event);

    };

    do_action( 'qm/debug', $acf_rows );

}
    




