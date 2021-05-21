<?php
/**
 * Inner Circle template for displaying tags.
 *
 * @package uds-wordpress-theme
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

    <section id="contact-info">
        <svg id="visual" viewBox="0 0 1920 200" width="1920" height="200" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
            <path
                d="M0 79L45.7 70.2C91.3 61.3 182.7 43.7 274.2 35.5C365.7 27.3 457.3 28.7 548.8 42C640.3 55.3 731.7 80.7 823 79.3C914.3 78 1005.7 50 1097 41C1188.3 32 1279.7 42 1371.2 53.7C1462.7 65.3 1554.3 78.7 1645.8 76C1737.3 73.3 1828.7 54.7 1874.3 45.3L1920 36L1920 201L1874.3 201C1828.7 201 1737.3 201 1645.8 201C1554.3 201 1462.7 201 1371.2 201C1279.7 201 1188.3 201 1097 201C1005.7 201 914.3 201 823 201C731.7 201 640.3 201 548.8 201C457.3 201 365.7 201 274.2 201C182.7 201 91.3 201 45.7 201L0 201Z"
                fill="#f0f0f0"></path>
            <path
                d="M0 99L45.7 106.2C91.3 113.3 182.7 127.7 274.2 134.2C365.7 140.7 457.3 139.3 548.8 130.5C640.3 121.7 731.7 105.3 823 101.5C914.3 97.7 1005.7 106.3 1097 104.3C1188.3 102.3 1279.7 89.7 1371.2 85.8C1462.7 82 1554.3 87 1645.8 90.5C1737.3 94 1828.7 96 1874.3 97L1920 98L1920 201L1874.3 201C1828.7 201 1737.3 201 1645.8 201C1554.3 201 1462.7 201 1371.2 201C1279.7 201 1188.3 201 1097 201C1005.7 201 914.3 201 823 201C731.7 201 640.3 201 548.8 201C457.3 201 365.7 201 274.2 201C182.7 201 91.3 201 45.7 201L0 201Z"
                fill="#e8e8e8"></path>
            <path
                d="M0 148L45.7 153.7C91.3 159.3 182.7 170.7 274.2 173.7C365.7 176.7 457.3 171.3 548.8 165.3C640.3 159.3 731.7 152.7 823 149.8C914.3 147 1005.7 148 1097 144.2C1188.3 140.3 1279.7 131.7 1371.2 133.3C1462.7 135 1554.3 147 1645.8 156.7C1737.3 166.3 1828.7 173.7 1874.3 177.3L1920 181L1920 201L1874.3 201C1828.7 201 1737.3 201 1645.8 201C1554.3 201 1462.7 201 1371.2 201C1279.7 201 1188.3 201 1097 201C1005.7 201 914.3 201 823 201C731.7 201 640.3 201 548.8 201C457.3 201 365.7 201 274.2 201C182.7 201 91.3 201 45.7 201L0 201Z"
                fill="#d8d8d8"></path>
        </svg>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3><span class="highlight-gold">Joe Cool</span></h3>
                    <p>He is Charlie Brown's amazing dog and fighter pilot.</p>
                    <p>(480)-345-6677</p>
                </div>
            </div>
        </div>
    </section>


</main><!-- #main -->

<?php
get_footer();
