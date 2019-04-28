<?php
/*
 Template Name: Chair Report page
*/
?>

<?php get_header(); ?>

<section class="section-with-sidebar chair-report">
	<div class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<div id="content" class="content span9 content-left">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?><!-- START WP LOOP -->
					<h2>About Us</h2>
					<?php the_title( '<h3>', '</h3>' ); ?>
					<div class="our-partners">
					
					<!-- ACF Repeater Document Downloads -->
					<?php if( have_rows('downloads') ): ?>

					<?php while( have_rows('downloads') ): the_row(); 

						// vars
						$file = get_sub_field('file');
						$filename = get_sub_field('filename');
						$thumb = get_sub_field('thumb');
						$info = get_sub_field('info');

						?>
						<div class="partner-box download">
							<!-- download link and info -->
							<div class="left">
								<a class="download-link" href="<?php echo $file['url']; ?>" target="_blank">
									<p><?php echo $filename; ?></p>
									<span class="download-arrow"></span>
								</a>
								<?php if(get_sub_field('info')): ?>
									<p>DOCUMENT SUMMARY:</p>
									<?php echo $info; ?>
									<?php else: ?><?php endif; ?>
							</div>

							<!-- download thumb -->
							<div class="right">
								<a href="<?php echo $file['url']; ?>" target="_blank">
									<?php if(get_sub_field('thumb')): ?>
									<img src="<?php echo $thumb['url']; ?>" />
									<?php else: ?><?php endif; ?>
								</a>
							</div>
						</div>
						<?php endwhile; ?><?php endif; ?>
						<!-- END ACF Repeater Document Downloads -->


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