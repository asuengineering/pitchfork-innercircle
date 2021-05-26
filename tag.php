<?php
/**
 * Inner Circle template for displaying tags.
 *
 * @package uds-wordpress-innercircle
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'tag' ) );
} );

get_header();

?>
<main id="skip-to-content">

    <?php get_template_part( 'templates-global/tag' , 'header'); ?>

	<div class="container py-6">
        <?php

        if ( have_posts() ) {

            // Start the loop.
            while ( have_posts() ) {
                the_post();

                get_template_part( 'templates-loop/loop-tag');
            }
        }
        ?>
	</div>

	<div class="row">
		<div class="col">
			<!-- The pagination component -->
			<?php uds_wp_pagination(); ?>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
