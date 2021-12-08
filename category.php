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

            echo '<div class="row"><div class="col-md-9">';

            // Start the loop.
            while ( have_posts() ) {
                the_post();

                get_template_part( 'templates-loop/loop-category');
            }

            echo '</div></div>';
        }   
        ?>

        <div class="row">
            <div class="col">
                <?php paginate_links(); ?>
                <!-- The pagination component -->
                <?php uds_wp_pagination(); ?>
            </div>
        </div>
	</div>

</main><!-- #main -->

<section class="uds-section bg-color bg-gray-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Related content goes here</h3>
            </div>
        </div>
    </div>
</section>

<?php 

// Generate a new query to find all tags within the current category.
$current = get_queried_object_id();
$all_tags = array();
$grid_links = '';

$args = array(
    'posts_per_page'	=> -1,
    'cat'		=> $current,
);

// Loop through the query, build an array of all tag IDs.
$tag_query = new WP_Query( $args );
if ( $tag_query->have_posts() ) :

    while ( $tag_query->have_posts() ) : $tag_query->the_post();

        $posttags = get_the_tags();
        if ($posttags) {
            foreach($posttags as $posttag) {
                $all_tags[] = $posttag->term_id;
            }
        }

    endwhile;

    // Clean up array. Loop through it to generate the tag names and links.
    $all_tags = array_unique($all_tags);

    foreach($all_tags as $tag) {
        $tag_object = get_term($tag, 'post_tag');
        $tag_permalink = get_term_link($tag);
        $grid_links .= '<a href="' . $tag_permalink . '" class="link">' . $tag_object->name . '</a>';
    }

    if (! empty ($grid_links)) {
        $grid_links = '<div class="uds-grid-links four-columns ">' . $grid_links . '</div>';
    }

    // Output the whole section if there's data in the query.
    ?>
    <section class="uds-section bg-color bg-gray-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Related Tags</h3>
                    <?php echo wp_kses_post($grid_links); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

endif;
   
get_footer();