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


	<div class="container py-6">
		<?php the_archive_title( '<h2 class="page-title mb-6">', '</h2>' ); ?>
        <div class="row mb-10">
            <div classs="col-md-12">
				<h2><span class="highlight-gold">FURI</span></h2>
                <div class="ic-post-group">
                    <img src="https://placeimg.com/800/450/architecture" alt="Lorem Pixum" />
                    <div class="story-wrap">
                        <div class="story">
							<a href="https://google.com">
								<h4>An article title would go here. It might be a little long. May need to trimmed.</h4>
								<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
							</a>
						</div>
                        <div class="story active">
							<a href="https://google.com">
                                <h4>Variety is the spice of life. Let's live a little. This needs to wrap to a second line.</h4>
                                <p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
							</a>
                        </div>
						<div class="story">
							<a href="https://google.com">
								<h4>Collaborators includes many physicians, nutritionists, scientists, and other staff.</h4>
                                <p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
							</a>
                        </div>
                        <!-- <div class="story">
                            <h4>Determination of iodine in low mass human hair samples by inductively coupled plasma mass spectrometry.</h4>
                            <p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
                        </div> -->
                    </div>
                </div>

				<h2 class="mt-8">Regular content-image overlay block</h2>
				<div class="uds-image-overlap">
					<img class="img-fluid" src="https://placeimg.com/800/600/nature" alt="Generic image from PlaceIMG" />
					<div class="content-wrapper">
						<h3>This is the content that goes in the box.</h3>
						<p>Instagram tour operator travel sailing flying package. Territory New York City group discount active lifestyle creditcard insurance wellness kayak guide overnight rural lonely planet.</p>
						<p>Train luxury Paris recommendations nature France sight seeing. Flexibility Amsterdam maps. Pacific lonely planet private jet national insurance taxi tourist attractions. Budget Pacific guide caravan Barcelona place to stay maps gateway diary tour operator money</p>
					</div>
				</div>

				<h2 class="mt-8">Reversed: <span class="highlight-black">MORE</span></h2>
                <div class="ic-post-group reversed">
                    <img src="https://placeimg.com/800/450/people" alt="Lorem Pixum" />
                    <div class="story-wrap">
                        <div class="story">
							<a href="https://google.com">
								<h4>An article title would go here. It might be a little long. May need to trimmed.</h4>
								<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
							</a>
						</div>
                        <div class="story active">
							<a href="https://google.com">
                                <h4>Variety is the spice of life. Let's live a little. This needs to wrap to a second line.</h4>
                                <p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
							</a>
                        </div>
						<div class="story">
							<a href="https://google.com">
								<h4>Collaborators includes many physicians, nutritionists, scientists, and other staff.</h4>
                                <p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
							</a>
                        </div>
                        <!-- <div class="story">
                            <h4>Determination of iodine in low mass human hair samples by inductively coupled plasma mass spectrometry.</h4>
                            <p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
                        </div> -->
                    </div>
                </div>
			</div>
        </div>

		<div class="row">
			<div class="col-md-12">
				<h2>Here is some meat and three action.</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="ic-post-column">
					<h4><span class="highlight-black">Spirit and Traditions</span></h4>
					<img class="img-fluid" src="https://placeimg.com/400/225/architecture" alt="Lorem Pixum" />
					<div class="story">
						<h4><a href="https://nba.com">Collaborators includes many physicians, nutritionists, scientists, and other staff.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
					<div class="story">
						<h4><a href="https://nba.com">Instagram tour operator travel sailing flying package.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
					<div class="story">
						<h4><a href="https://nba.com">Budget Pacific guide caravan Barcelona place to stay maps gateway.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="ic-post-column">
					<h4><span class="highlight-black">Scholarships</span></h4>
					<img class="img-fluid" src="https://placeimg.com/400/225/any" alt="Lorem Pixum" />
					<div class="story">
						<h4><a href="https://nba.com">A brief title.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
					<div class="story">
						<h4><a href="https://nba.com">Post title markup should be removed from the browser window / tab.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
					<div class="story">
						<h4><a href="https://nba.com">Collaborators includes many physicians, nutritionists, scientists, and other staff.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="ic-post-column">
					<h4><span class="highlight-black">Career Center</span></h4>
					<img class="img-fluid" src="https://placeimg.com/400/225/people" alt="Lorem Pixum" />
					<div class="story">
						<h4><a href="https://nba.com">Private jet national insurance taxi tourist attractions.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
					<div class="story">
						<h4><a href="https://nba.com">Collaborators includes many physicians, nutritionists, scientists, and other staff.</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
					<div class="story">
						<h4><a href="https://nba.com">Ebb and flow of the various image positioning options is to nestle them snuggly</a></h4>
						<p class="event-meta"><span class="far fa-calendar"></span>Multiple dates and times</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-16">
			<div class="col-md-12">
				<h2>Tag cloud</h2>
				<p>This should query the database and list every tag that has an entry under the listed category. Useful for outlining all of the Fulton Difference programs or anything belonging to the more general Events category.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="ic-grid-links two-columns mobile-at-lg">
					<a href="#"><i class="fa fa-fw fa-university"></i>First-year student</a>
					<a href="#"><i class="fa fa-fw fa-desktop"></i>Online student</a>
					<a href="#"><i class="fa fa-fw fa-lightbulb"></i>Transfer student</a>
					<a href="#"><i class="fa fa-fw fa-user-graduate"></i>Veteran student</a>
					<a href="#"><i class="fa fa-fw fa-graduation-cap"></i>Graduate student</a>
					<a href="#"><i class="fa fa-fw fa-rocket"></i>Universal Learner</a>
					<a href="#"><i class="fa fa-fw fa-globe-americas"></i>International student</a>
					<a href="#"><i class="fa fa-fw fa-users"></i>Non-degree student</a>
				</div>
			</div>
		</div>
		


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
