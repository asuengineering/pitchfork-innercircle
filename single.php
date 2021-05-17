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

			<?php

			the_content();

            get_template_part( 'templates-global/event-attachment' );

			$author_name = get_field( 'name' );
			$author_title = get_field( 'title' );
			$author_email = get_field( 'email' );
			$author_phone = get_field( 'phone' );
			if ( $author_name || $author_title || $author_email || $author_phone ) {
				echo '<div class="author_info">';
				if ( $author_name ) {
					echo '<h4><span class="highlight-gold">' . $author_name . '</span></h4>';
				}
				if ( $author_title ) {
					echo '<p>' . $author_title . '</p>';
				}
				if ( $author_email || $author_phone ) {
					echo '<p>';
					if ( $author_email ) {
						echo '<span class="fas fa-envelope-square"></span><a href="mailto:' . $author_email . '">' . $author_email . '</a>';
					}
					echo '</br>';
					if ( $author_phone ) {
						echo '<span class="fas fa-phone-square"></span><a href="tel:' . $author_phone . '">' . $author_phone . '</a>';
					}
					echo '</p>';
				}
				echo '</div>';
			}

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
        
        get_template_part( 'templates-global/event-meta' );
	
    }

?>
</main><!-- #main -->

<?php get_footer(); ?>
