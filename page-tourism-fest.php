<?php
/*
 Template Name: Tourism Fest page
*/
?>

<?php get_header(); ?>

<section class="section-with-sidebar">
	<div class="container">
		<div class="row-fluid">
			<div class="row-fluid">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="content" class="content span9 content-left">
					<h2>
						<?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?>
					</h2>
					<?php the_title( '<h3>', '</h3>' ); ?>
					<div id="main-content" class="inner-content">
						<?php the_content(); ?>
					</div>

					<!-- Repeater Fest -->
					<?php if( have_rows('fest') ): ?>

					<div class="fest">
						<?php while( have_rows('fest') ): the_row(); 

						// vars
						$link = get_sub_field('link');
						$info = get_sub_field('info'); ?>

						<div id="main-content" class="inner-content">
							<h3><?php the_sub_field('fest_title'); ?></h3>
							<div class="videos">
								<?php
								// vars
								$link = get_sub_field('link');
								$info = get_sub_field('info'); ?>
								<!-- Start Video box -->
								<div class="video">
									<div class="vid-left"><?php echo $link; ?></div><!-- Video embed code -->
									<div class="vid-right">
										<?php if( !empty($info) ): ?><?php echo $info; ?><?php endif; ?><!-- video info -->
									</div>
									<?php the_sub_field('fest_content'); ?>
									<hr />
									<h4>Tourism Fest in the West Data</h4>
									<h6>Documents available for Download Here...</h6>

									<!-- ACF Repeater Document Downloads -->
									<?php if( have_rows('fest_file') ): ?>
									<?php while( have_rows('fest_file') ): the_row(); 

									// vars
									$file = get_sub_field('file');
									$filename = get_sub_field('filename');
									?>
									<div class="download">
									<!-- download link and info -->
										<div class="left">
											<a class="download-link" href="<?php echo $file['url']; ?>" target="_blank">
												<p><?php echo $filename; ?></p>
												<span class="download-arrow"></span>
											</a>
										</div>
									</div>
								<?php endwhile; ?><?php endif; ?>
								<!-- END ACF Repeater Document Downloads -->
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>
				<?php endwhile; ?><?php endif; ?>
				</div>
				<div id="sidebar" class="span3 sidebar sidebar-right" style="">
					<div class="inner-content"><?php generated_dynamic_sidebar(); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>