<?php
/**
 * Runs a query on the DB for calendar events and provide the data to FullCalendar.io
 *
 * @package uds-wordpress-theme
 */

function pass_events_to_fullcalendar() {

    // Get the data from WP_Query first.

    // args
    $args = array(
        'numberposts'	=> -1,
        'post_type'		=> 'post',
        'meta_query' => array(
            array(
                'key'     => 'ic_event_meta_entry',
                'compare' => 'EXISTS',
            ),
        ),
    );

    // query
    $event_posts = new WP_Query( $args );
    // do_action( 'qm/debug', $events->posts );

    $event_array = [];

    if ( $event_posts->have_posts() ) :

        while ( $event_posts->have_posts() ) : $event_posts->the_post();

            $permalink = get_the_permalink();
            $post_title = get_the_title();

            // Loop through rows within the post 
            while ( have_rows('ic_event_meta_entry') ) : the_row();

                $titles = get_sub_field('ic_event_meta');
                $display = get_sub_field('ic_event_meta_display');
                $cta_link_object = get_sub_field('ic_event_meta_link');
                $start_dt = get_sub_field('ic_event_meta_start_dt');
                $end_dt = get_sub_field('ic_event_meta_end_dt');
                $agenda = get_sub_field('ic_event_meta_agenda');

                $title = '';
                if (! empty($titles['title'] )) {
                    $title = $titles['title'];
                }

                $description = '';
                if (! empty($titles['subtitle'] )) {
                    $description = $titles['subtitle'];
                }

                $cta_link = '';
                if (! empty($cta_link_object['url'] )) {
                    $cta_link = $cta_link_object['url'];
                }

                // Basic event details, title, URL, dates
                $event = new stdClass();
                $event->{"title"} = $title;
                $event->{"url"} = $permalink;

                // Determine if date displayed should be all day or a specific interval.
                // Use correct date for proper display on the calendar.
                if ('dates' === $display) {

                    $event->{"start"} = $start_dt;
                    $event->{"end"} = $end_dt;
                    $event->{"allDay"} = true;

                } elseif ('deadline' === $display ) {

                    $event->{"start"} = $end_dt;
                    $event->{"allDay"} = false;

                } else {
                    
                    // Standard date display. Includes the times.
                    $event->{"start"} = $start_dt;
                    $event->{"end"} = $end_dt;
                    $event->{"allDay"} = false;
                }

                // Other data available in "extendedProps" once rendered.
                $event->{"post_title"} = $post_title;
                $event->{"cta_link"} = $cta_link_object;
                $event->{"description"} = $description;
                $event->{"agenda"} = $agenda;
                $event->{"date_string"} = $display;

                array_push( $event_array, $event );

            // End get_rows loop.
            endwhile;
        
        // End wp_query loop.
        endwhile;

    endif;

    do_action( 'qm/debug', $event_array );

    // Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
    $js_child_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/js/child-theme.js' );
	wp_enqueue_script( 'uds-wordpress-child', get_stylesheet_directory_uri() . '/js/child-theme.js', array( 'uds-wordpress-fullcalendar' ), $js_child_version );
    wp_add_inline_script( 'uds-wordpress-child', 'const CALDATA = ' . json_encode( array(
        'events' => $event_array,
    ) ), 'before' );
}
add_action( 'wp_enqueue_scripts', 'pass_events_to_fullcalendar' );

// wp_localize_script( 'uds-wordpress-child',  'meta' , array(
//     'events' => $event_array, )
// );

