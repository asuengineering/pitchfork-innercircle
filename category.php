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
<?php get_template_part( 'templates-global/hero' ); ?>
<main id="skip-to-content" <?php post_class( 'container' ); ?>>

		<div class="row mt-8 pt-8">

			<?php

			if ( have_posts() ) {

				// Start the loop.
				while ( have_posts() ) {
					the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'templates-loop/content', 'card' );
				}
			} else {
				get_template_part( 'templates-loop/content', 'none' );
			}
			?>

		</div>
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
