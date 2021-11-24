<?php
/**
 * The template for displaying category pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package uds-wordpress-innercircle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<main id="skip-to-content">

    <?php get_template_part( 'templates-global/category' , 'header'); ?>

	<div class="container pb-6">
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
