<?php
/*
 Template Name: Advocacy page
*/
?>

<?php get_header(); ?>

<section class="section-with-sidebar">
	<div class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<div id="content" class="content span9 content-left">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?><!-- START WP LOOP -->
					<h2>News</h2>
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
								<p>DOCUMENT SUMMARY:</p>
								<?php echo $info; ?>
							</div>

							<!-- download thumb -->
							<div class="right">
								<a href="<?php echo $file['url']; ?>" target="_blank">
									<?php if(get_sub_field('thumb')): ?>
									<img src="<?php echo $thumb['url']; ?>" />
									<?php else: ?>
									<img src="http://localhost:8888/wmt/wp-content/uploads/2015/10/download-placeholder.png">
									<?php endif; ?>
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