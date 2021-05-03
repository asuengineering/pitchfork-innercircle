<?php
/**
 * The template for displaying all single posts.
 *
 * This template includes an intrinsic Bootstrap container to make the process of
 * content creation easier for the post author. To escape from the original container
 * and layout other parts of the page, consider inserting a custom HTML block to deliver the closing <div>'s.
 *
 * @package uds-wordpress-innercircle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="skip-to-content">

	<?php

	while ( have_posts() ) {

		the_post();

        ?>
        <section class="uds-story-hero entry-header">
            <img class="hero" src="https://source.unsplash.com/random/1920x512" alt="Here is some alt text" />
            <div class="content">
                <p class="meta entry-meta"><?php uds_wp_posted_on(); ?></p>
                <?php the_title( '<h1 class="article entry-title">', '</h1>' ); ?>
            </div>
        </section>

		<!-- // Remove support for the global hero template part. Intended for pages, primarily.
		// get_template_part( 'templates-global/hero' ); .

		// get_template_part( 'templates-global/global-banner' );

		// get_template_part( 'templates-loop/content', 'single' ); -->

        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <?php 
                // echo get_the_post_thumbnail( $post->ID, 'large' ); 
                the_content();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . __( 'Pages:', 'uds-wordpress-theme' ),
                        'after'  => '</div>',
                    )
                );
            ?>

            <footer class="entry-footer">

                <?php uds_wp_entry_footer(); ?>

            </footer><!-- .entry-footer -->

        </article><!-- #post-## -->
    
    <?php 
	}

    echo '</main><!-- #main -->';

get_footer();