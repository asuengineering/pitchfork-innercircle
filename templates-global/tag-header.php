<?php
/**
 * Displays a series of cards at the bottom of an IC post/
 * Geared toward the captured event details and calendar display of posts.
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$term = get_queried_object();
$description = get_field('ic_tag_description', $term);
$link = get_field('ic_tag_cta_button', $term);
$featured_image = get_field( 'ic_tag_featured_image', $term)
?>

<section id="tag-hero">
    <svg id="visual" viewBox="0 0 1920 512" width="1920" height="512" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
        <path
            d="M0 292L45.7 293.5C91.3 295 182.7 298 274.2 319.2C365.7 340.3 457.3 379.7 548.8 384.2C640.3 388.7 731.7 358.3 823 352.2C914.3 346 1005.7 364 1097 364.8C1188.3 365.7 1279.7 349.3 1371.2 358C1462.7 366.7 1554.3 400.3 1645.8 410.3C1737.3 420.3 1828.7 406.7 1874.3 399.8L1920 393L1920 0L1874.3 0C1828.7 0 1737.3 0 1645.8 0C1554.3 0 1462.7 0 1371.2 0C1279.7 0 1188.3 0 1097 0C1005.7 0 914.3 0 823 0C731.7 0 640.3 0 548.8 0C457.3 0 365.7 0 274.2 0C182.7 0 91.3 0 45.7 0L0 0Z"
            fill="rgba(140, 29, 64, .25)"></path>
        <path
            d="M0 253L45.7 262.5C91.3 272 182.7 291 274.2 293.2C365.7 295.3 457.3 280.7 548.8 275.8C640.3 271 731.7 276 823 278.8C914.3 281.7 1005.7 282.3 1097 290.8C1188.3 299.3 1279.7 315.7 1371.2 324.3C1462.7 333 1554.3 334 1645.8 320C1737.3 306 1828.7 277 1874.3 262.5L1920 248L1920 0L1874.3 0C1828.7 0 1737.3 0 1645.8 0C1554.3 0 1462.7 0 1371.2 0C1279.7 0 1188.3 0 1097 0C1005.7 0 914.3 0 823 0C731.7 0 640.3 0 548.8 0C457.3 0 365.7 0 274.2 0C182.7 0 91.3 0 45.7 0L0 0Z"
            fill="rgba(140, 29, 64, .65)"></path>
        <path
            d="M0 214L45.7 201.3C91.3 188.7 182.7 163.3 274.2 155.8C365.7 148.3 457.3 158.7 548.8 174.3C640.3 190 731.7 211 823 220.3C914.3 229.7 1005.7 227.3 1097 218.2C1188.3 209 1279.7 193 1371.2 180C1462.7 167 1554.3 157 1645.8 150.2C1737.3 143.3 1828.7 139.7 1874.3 137.8L1920 136L1920 0L1874.3 0C1828.7 0 1737.3 0 1645.8 0C1554.3 0 1462.7 0 1371.2 0C1279.7 0 1188.3 0 1097 0C1005.7 0 914.3 0 823 0C731.7 0 640.3 0 548.8 0C457.3 0 365.7 0 274.2 0C182.7 0 91.3 0 45.7 0L0 0Z"
            fill="rgba(140, 29, 64, .85)"></path>
        <path
            d="M0 93L45.7 90.2C91.3 87.3 182.7 81.7 274.2 89.8C365.7 98 457.3 120 548.8 123.2C640.3 126.3 731.7 110.7 823 107.7C914.3 104.7 1005.7 114.3 1097 120.3C1188.3 126.3 1279.7 128.7 1371.2 120.7C1462.7 112.7 1554.3 94.3 1645.8 96.2C1737.3 98 1828.7 120 1874.3 131L1920 142L1920 0L1874.3 0C1828.7 0 1737.3 0 1645.8 0C1554.3 0 1462.7 0 1371.2 0C1279.7 0 1188.3 0 1097 0C1005.7 0 914.3 0 823 0C731.7 0 640.3 0 548.8 0C457.3 0 365.7 0 274.2 0C182.7 0 91.3 0 45.7 0L0 0Z"
            fill="rgba(140, 29, 64, 1)"></path>
    </svg>

    <div class="container py-6">
        <div class="row">
            <div class="col-md-7">
                <?php 
                the_archive_title( '<h1 class="page-title">', '</h1>' ); 
                
                echo '<div class="term-description">' . wp_kses_post($description) . '</div>';

                if( $link ) {
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';

                    ?>
                    <a class="btn btn-maroon btn-lg" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php } ?>
            </div>

            <?php
            if( $featured_image ) {
                echo '<div class="col-md-5">';

                $size = 'medium_large';
                $full_image = wp_get_attachment_image( $featured_image, $size, false, array( "class" => "img-fluid" ));
                $trim_image = preg_replace( '/(width|height)="\d+"\s/', '', $full_image );

                echo $trim_image;

                echo '</div>';
            }
            ?>  
        </div>
    </div>
</section>