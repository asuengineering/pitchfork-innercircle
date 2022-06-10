<?php
/**
 * The template for displaying all single posts.
 *
 * Contains additional markup for event information related to Inner Circle. 
 *
 * @package pitchfork-innercircle
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
		
		// Calculate featured image classes based on uploaded image height.
		// If uploaded image height < 515px, use the short format.
		if ( has_post_thumbnail() ) {
			$thumb_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$thumb_height = $thumb_data[2];

			if ( $thumb_height >= 515 ) {
				$featured_class = 'img-fluid featured';
			} else {
				$featured_class = 'img-fluid';
			}
		}

		?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-hero">
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('full', array( 'class' => $featured_class ));
							} else {
								echo '<div class="default-image"></div>';
							}
						?>
						<div class="title-wrap">
							<?php the_title( '<h1 class="article entry-title">', '</h1>' ); ?>
							<p class="meta entry-meta"><?php echo uds_wp_posted_on(); ?></p>
							<?php innercircle_print_tags(); ?>
						</div>
						<div class="category-wrap">
							<?php innercircle_print_categories(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">
			
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

			<div class="row">

				<?php
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
			</div><!-- end .row -->
		</section><!-- #post-## -->
    
        <?php 
	
    }

?>
</main><!-- #main -->

<?php get_footer(); ?>
