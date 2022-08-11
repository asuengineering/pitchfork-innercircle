<?php
/**
 * Data validation function to run on start & end dates for the calendar 
 * before attempting to build the Add to Outlook / Add to Google links.
 *
 * @package pitchfork-innercircle
 */


/**
 * Function which returns true or false based on some simple data validation.
 */
function validate_add_to_calendar_dates( $start, $end ) {

    // If either are empty, return empty string.
    if ((empty($start)) || (empty($end))) {
        return false;
    } else if ( $start > $end ) {
        return false;
    } else {
        return true;
    }

}
