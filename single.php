<?php
/**
 * The template for displaying all single posts.
 *
 * Contains additional markup for event information related to Inner Circle. 
 *
 * @package uds-wordpress-innercircle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_template_part( 'templates-global/calendar' );

get_header();
?>

<main id="skip-to-content">

	<?php

	while ( have_posts() ) {

		the_post();

		get_template_part( 'templates-global/global-banner' );
		get_template_part( 'templates-global/story-hero' );

		?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<div id="calendar"></div>

			<?php

			the_content();

            get_template_part( 'templates-global/event-attachment' );

            // get_template_part( 'templates-global/single-author');

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'uds-wordpress-theme' ),
					'after'  => '</div>',
				)
			);

			?>

			<footer class="entry-footer">
            
                <?php
                // Edit post link, scraped from parent tempalte-tags.php
                edit_post_link(
                    sprintf(
                        /* translators: %s: Name of current post */
                        esc_html__( 'Edit %s', 'uds-wordpress-theme' ),
                        the_title( '<span class="sr-only">"', '"</span>', false )
                    ),
                    '<div class="edit-link my-1">',
                    '</div>'
                );
                ?>

			</footer><!-- .entry-footer -->

		</article><!-- #post-## -->
    
        <?php 
        
        get_template_part( 'templates-global/event-meta' );
	
    }

?>
</main><!-- #main -->

<?php get_footer(); ?>
