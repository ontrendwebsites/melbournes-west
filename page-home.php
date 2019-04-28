<?php
/*
 Template Name: Home page
*/
?>

<?php get_header(); ?>

<section class="home-content">
  <div class="container">
    <div class="row-fluid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	    <!-- Slider ACF Repeater -->
	    <?php if( have_rows('slider') ): ?>

		<ul class="home-slides">

		<?php while( have_rows('slider') ): the_row(); 

			// vars
			$image = get_sub_field('image');
			$title = get_sub_field('title');
			$content = get_sub_field('tagline');
			$link = get_sub_field('link');
			$photo_info = get_sub_field('photo_info');

			?>

			<li class="slider">

				<?php if( $link ): ?>
					<a href="<?php echo $link; ?>">
				<?php endif; ?>

					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />

				<?php if( $link ): ?>
					</a>
				<?php endif; ?>
				<p>
					<strong><?php echo $title; ?></strong>
					<?php echo $content; ?>
				</p>
				<p class="photo-description">
					<?php echo $photo_info; ?>
				</p>

			</li>

		<?php endwhile; ?>

		</ul>

		<?php endif; ?>
		<!-- End Slider ACF Repeater -->

		<!-- Display page content -->
	    <?php the_content(); ?>
		
		<?php endwhile; ?>
		<?php endif; ?>

		<!-- ACF left and right columns -->
		<!-- full width container -->
		<div class="span12 home-content">
			<div class="span6">
				<?php the_field('left_column'); ?>
			</div>

			<div class="span6">
				<?php the_field('right_column'); ?>
			</div>
		</div>
		<!-- Logos ACF Repeater -->
	    <?php if( have_rows('partners') ): ?>


		<div class="span12 light-grey">
			<div class="inner-box">
			<?php while( have_rows('partners') ): the_row(); 

			// vars
			$logo = get_sub_field('logo');
			$link = get_sub_field('link');

			?>

				<div class="span3">

					<?php if( $link ): ?>
						<a href="<?php echo $link; ?>" target="_blank">
					<?php endif; ?>

						<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt'] ?>" />

					<?php if( $link ): ?>
						</a>
					<?php endif; ?>

				</div>

			<?php endwhile; ?>

			</div>

		</div>

		<?php endif; ?>
		<!-- End Logos ACF Repeater -->
    </div>
  </div>
</section>

<?php get_footer(); ?>