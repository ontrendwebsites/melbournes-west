<?php
/*
 Template Name: Our Partners page
*/
?>

<?php get_header(); ?>

<section class="section-with-sidebar">
	<div class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<div id="content" class="content span9 content-left">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?><!-- START WP LOOP -->
					<h2>About Us</h2>
					<?php the_title( '<h3>', '</h3>' ); ?>
					<div class="our-partners">
					<!-- ACF Repeater Partners -->
					<?php if( have_rows('partner') ): ?>

					<?php while( have_rows('partner') ): the_row(); 

					// vars
					$logo = get_sub_field('logo');
					$info = get_sub_field('info');
					?>

						<!-- Start Partner box -->
						<div class="partner-box">
							<!-- Partner logo -->
							<?php 
							if( !empty($logo) ): ?>
							<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
							<?php endif; ?>
							<!-- END Partner logo -->
							<!-- Partner info -->
							<?php echo $info; ?>
							<!-- END Partner info -->
						</div>
						<!-- END Partner box -->
						<?php endwhile; ?><?php endif; ?>
						<!-- END ACF Repeater Partners -->
					</div>
				</div><!-- Left side end -->
				<div id="sidebar" class="span3 sidebar sidebar-right" style="">
					<div class="inner-content">
					<?php generated_dynamic_sidebar(); ?>
					</div>
					<?php endwhile; ?><?php endif; ?><!-- END WP LOOP -->
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>