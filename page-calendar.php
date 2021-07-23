<?php
/**
 * The template in use by a page with the slug of /calendar.
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_template_part( 'templates-global/calendar' );

get_header();
?>

	<main id="skip-to-content" <?php post_class(); ?>>

		<?php

		while ( have_posts() ) {

			the_post();

			get_template_part( 'templates-global/hero' );

            ?>

            <div class="container mt-9">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendar-wrapper" class="grid">
                            <div id="calendar"></div>
                            <div id="event-preview">
                                <h3>Preview headline</h3>
                                <p>Here's the post excerpt and maybe a few more words to help make a bigger paragraph of text below the image.</p>
                                <p><span class="fas fa-calendar"></span>There are 4 events associated with this story</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <?php

			get_template_part( 'templates-global/global-banner' );

			the_content();

			// Display the edit post button to logged in users.
			echo '<footer class="entry-footer"><div class="container"><div class="row"><div class="col-md-12">';
			edit_post_link( __( 'Edit', 'uds-wordpress-theme' ), '<span class="edit-link">', '</span>' );
			echo '</div></div></div></footer><!-- end .entry-footer -->';
		}

		?>

	</main><!-- #main -->

<?php
get_footer();
