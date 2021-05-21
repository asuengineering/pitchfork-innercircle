<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="col-lg-4">';
		the_post_thumbnail('medium-large', ['class' => 'img-fluid mt-2']);
		echo '</div>';
	}
	?>
	
	<div class="col-lg-8">

		<header class="entry-header">

			<?php
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h2>'
			);
			?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php the_excerpt(); ?></p>
		</div>

		<footer class="entry-footer">
			<?php 

			$eventmeta = get_field('ic_event_meta_entry');

			if (count($eventmeta) > 1 ) :

				echo '<div class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</div>';
				innercircle_print_categories();
			
			elseif (have_rows('ic_event_meta_entry')) :

				// Loop through rows.
				while( have_rows('ic_event_meta_entry') ) : the_row();

					// Required meta fields.
					$display = get_sub_field('ic_event_meta_display');
					$start_dt = get_sub_field('ic_event_meta_start_dt');
					$end_dt = get_sub_field('ic_event_meta_end_dt');
					$location = get_sub_field('ic_event_meta_location');

					// Date and time strings.
					$start_date = date('F d, Y', strtotime($start_dt));
					$start_time = str_replace(array('am','pm'),array('a.m.','p.m.'),date('g:i a', strtotime($start_dt)));
			
					$end_date = date('F d, Y', strtotime($end_dt));
					$end_time = str_replace(array('am','pm'),array('a.m.','p.m.'),date('g:i a', strtotime($end_dt)));

					// Location details
					$building = $location['building'];
					
					if (!empty($location)){
						$location_string = '<span class="fas fa-map-marker-alt"></span>'. $building->name . ' ' . $location['room'];
					} else {
						$location_string = '';
					}
					
					$eventmeta = '<div class="event-meta">';

					// Output depending on the type of event displayed.
					if ('dates' === $display ) {

						$eventmeta .= '<span class="far fa-calendar"></span>' . $start_date . ' through ' .  $end_date;

					} elseif ('agenda' === $display ) {

						$eventmeta .= '<span class="far fa-calendar"></span>' . $start_date ;
			
					} elseif ('deadline' === $display) {

						$eventmeta .= '<span class="far fa-alarm-exclamation"></span>' . $end_date . ' by ' . $end_time;
			
					} else {
						
						// Handles 'standard' === $display and any errors.
						$eventmeta .= '<span class="far fa-calendar"></span>' . $start_date . '<span class="far fa-clock"></span>' . $start_time . ' - ' . $end_time;
					}

					echo $eventmeta . $location_string . '</div>';

					innercircle_print_categories();

				// End loop.
				endwhile;

			endif; ?>

		</footer><!-- .entry-footer -->
	
	</div>

</article><!-- #post-## -->

