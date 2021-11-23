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

    // The only action we're taking manually now is to set the ACF event meta associated with the post.
    // The update_field action from ACF takes care of all of the complicated DB posting.
    // See: https://bionicteaching.com/gravity-forms-to-acf-pattern/

    // TODO: Submit bug for Gravity Forms repeater field. Stores date data in the wrong part of the serialized array.

    do_action( 'qm/debug', $post_id); 
    do_action( 'qm/debug', $entry); 

    // Are we including events on the calendar at all?
    $include_events = rgar( $entry, '35');

    if ( 'yes' === $include_events ) {
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

        $dts_index = 0;
        $acf_rows = [];
        foreach ($repeater as $event) {

            do_action( 'qm/debug', $event); 

            $title = rgars( $event, '1/0');
            $subtitle = rgars( $event, '2/0');
            $link_url = rgars($event, '5/0');
            $link_cta = rgars($event, '30/0');
            $link_array = array( 'title' => $link_cta, 'url' => $link_url, 'target' => '' );
            
            $display = rgars ($event, '3/0');
            $acf_start = $start_dts[$dts_index];
            $acf_end = $end_dts[$dts_index];

            $building = rgars( $event, '10/0');
            $room = rgars( $event, '11/0');
            $agenda = rgars( $event, '12/0');

            $current_event = array(
                'ic_event_meta_title' => $title,
                'ic_event_meta_subtitle' => $subtitle,
                'ic_event_meta_link' => $link_array,
                'ic_event_meta_display' => $display,
                'ic_event_meta_start_dt' => $acf_start,
                'ic_event_meta_end_dt' => $acf_end,
                'ic_event_meta_building' => $building,
                'ic_event_meta_room' => $room,
                'ic_event_meta_agenda' => $agenda
            );

            array_push($acf_rows, $current_event);

        };

        // Repeater Field ID: field_6093127e5b065. Should be an array of arrays
        update_field( 'field_6093127e5b065', $acf_rows, $post_id);

    } else {
        // There were no events to add to the calendar. 
    }

}
    




