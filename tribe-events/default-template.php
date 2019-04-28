<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
?>

<section class="whats-on">
	<div class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<!-- full width container -->
				<div class="span12">
					<h2>What's On</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="whats-on">
	<div class="container">
		<div class="row-fluid calendar">
			<div class="row-fluid">
				<!-- full width container -->
				<div class="span12">

					<div id="tribe-events-pg-template">
						<?php tribe_events_before_html(); ?>
						<?php tribe_get_view(); ?>
						<?php tribe_events_after_html(); ?>
					</div> <!-- #tribe-events-pg-template -->

				</div>
			</div>
		</div>
	</div>
</section>

<section class="whats-on">
	<div class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<!-- full width container -->
				<div class="span12">
					<p class="sponsors">In addition to the above Calendar there is a large range of venues with ongoing programs of exhibitions, performances,
					events, tours, screenings, holiday programs, sports events. These venues include:</p>
				</div>
			</div>
		</div>
	</div>

	<div id="calendar-sponsors" class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="content span12" id="content">
					<div class="inner-content" id="main-content">
					<?php if( have_rows('venues', 'option') ): ?>
						<div class="grid">
						<?php while( have_rows('venues', 'option') ): the_row(); 
							// vars
							$image_venue = get_sub_field('venue_image', 'option');
							$content = get_sub_field('venue_content', 'option');
							$link = get_sub_field('link', 'option');
							?>

							<div class="grid-item">

								<?php if( $link ): ?>
									<a href="<?php echo $link; ?>" target="_blank">
								<?php endif; ?>

									<img src="<?php echo $image_venue['url']; ?>" />
									<?php echo $content; ?>

								<?php if( $link ): ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END full width container -->





<?php
get_footer();