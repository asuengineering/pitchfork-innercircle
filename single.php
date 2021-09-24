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

		?>

		<div <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="col">
					<?php the_title( '<h1 class="article entry-title">', '</h1>' ); ?>
					<p class="meta entry-meta"><?php echo uds_wp_posted_on(); ?></p>
					<?php innercircle_print_categories_tags(); ?>
				</div>
				
				<?php 
				if ( has_post_thumbnail() ) {
					echo '<div class="col-lg-5">';
					the_post_thumbnail('medium_large', ['class' => 'img-fluid']);
					echo '</div>';
				}
				?>
				
			</div>
			<div class="row">
				<div class="col-lg-8">
					<?php 
					the_content();
					get_template_part( 'templates-global/event-attachment' );
					?>
				</div>

				<aside class="col-lg-4">
					
					<?php get_template_part( 'templates-global/event-meta' ); ?>
				</aside>
			</div>
		</div>

			<?php
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
	
    }

?>
</main><!-- #main -->

<?php get_footer(); ?>
