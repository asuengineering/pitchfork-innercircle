<?php
/**
 * Displays a series of cards at the bottom of an IC post/
 * Geared toward the captured event details and calendar display of posts.
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add to calendar link class
require get_stylesheet_directory() . '/vendor/autoload.php';
use Spatie\CalendarLinks\Link;

// Loop through the ACF Event repeater field.
if( have_rows('ic_event_meta_entry') ):

    echo '<section id="events" class="bg topo-black">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<h2>Details</h2>';
    echo '</div>';
    echo '</div>';
    echo '<div class="row">';

    // Loop through rows.
    while( have_rows('ic_event_meta_entry') ) : the_row();

        $titles = get_sub_field('ic_event_meta');
        $display = get_sub_field('ic_event_meta_display');
        $link = get_sub_field('ic_event_meta_link');
        $start_dt = get_sub_field('ic_event_meta_start_dt');
        $end_dt = get_sub_field('ic_event_meta_end_dt');
        $location = get_sub_field('ic_event_meta_location');
        $agenda = get_sub_field('ic_event_meta_agenda');

        $building = $location['building'];

        // The output, starting with opening column + card + card header
        ?>

        <div class="col col-12 col-lg-6">
            <div class="card card-horizontal card-ic-event">
                <div class="card-header">

        <?php 

        if (! empty($titles['title'] )) {
            echo '<h3>' . $titles['title'] . '</h3>';
        }

        if (! empty($titles['subtitle'] )) {
            echo '<p>' . $titles['subtitle'] . '</p>';
        }

        if (! empty($titles['subtitle'] )) {
            echo '<a class="btn btn-md btn-maroon" href="' . esc_html($link['url']) . '">' . esc_html($link['title']) . '</a>';
        }
        
        echo '</div>';
        echo '<div class="card-details">';

        // Card details
        $start_full = date_create_from_format('Y-m-d H:i', $start_dt);
        $start_date = date('F d, Y', strtotime($start_dt));
        $start_time = str_replace(array('am','pm'),array('a.m.','p.m.'),date('g:i a', strtotime($start_dt)));

        $end_full = date_create_from_format('Y-m-d H:i', $end_dt);
        $end_date = date('F d, Y', strtotime($end_dt));
        $end_time = str_replace(array('am','pm'),array('a.m.','p.m.'),date('g:i a', strtotime($end_dt)));

        if ('dates' === $display ) {

            ?>

                <p><span class="far fa-calendar"></span>Start: <?php echo $start_date; ?></p>
                <p><span class="far fa-calendar"></span>End: <?php echo $end_date; ?></p>
                <p><span class="fas fa-map-marker-alt"></span><?php echo $building->name . ' ' . $location['room']; ?></p>

            <?php

        } elseif ('agenda' === $display ) {

            ?>

                <p><span class="far fa-calendar"></span><?php echo $start_date; ?></p>
                <p><?php echo wp_kses_post( $agenda ); ?><p>
                <p><span class="fas fa-map-marker-alt"></span><?php echo $building->name . ' ' . $location['room']; ?></p>
                
            <?php

        } elseif ('deadline' === $display) {

            ?>

                <p><span class="far fa-alarm-exclamation"></span><?php echo $end_date; ?> by <?php echo $end_time; ?></p>
                <p><span class="fas fa-map-marker-alt"></span><?php echo $building->name . ' ' . $location['room']; ?></p>

            <?php

        } else {
            
            // Handles 'standard' === $display and any errors.
            ?>
                
                <p><span class="far fa-calendar"></span><?php echo $start_date; ?></p>
                <p><span class="far fa-clock"></span><?php echo $start_time . ' - ' . $end_time; ?></p>
                <p><span class="fas fa-map-marker-alt"></span><?php echo $building->name . ' ' . $location['room']; ?></p>

            <?php
        }

        $cal_from = date_create_from_format('m/d/Y g:i a', $start_dt);
        $cal_to = date_create_from_format('m/d/Y g:i a', $end_dt);
        $cal_link = Link::create( $titles['title'], $cal_from, $cal_to)
            ->description($titles['subtitle'])
            ->address($building->name . ' ' . $location['room']);
        echo '<p><a href="' . $cal_link->ics() . '">Add to Outlook</a></p>';
        echo '<p><a href="' . $cal_link->google() . '">Add to Google</a></p>';

        echo '</div>'; // end .card-details.
        echo '</div>'; // end .card.
        echo '</div>'; // end .column.

    // End loop.
    endwhile;

    echo '</div>';
    echo '</div><!-- end .container -->';
    echo '</section>';

// No value.
else :
    // Do something...
endif;