<?php
/*
 Template Name: Management Plan page
*/
 ?>

 <?php get_header(); ?>

 <section class="resources-page section-with-sidebar">
 	<div class="container">
 		<div class="row-fluid">
 			<div class="row-fluid">

 				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

 				<div id="content" class="content span9 content-left">
 					<h2><?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?></h2>

 					<div class="maps-container plan-page-container">
 						<h3><?php the_title(); ?></h3>
 						<?php if( have_rows('content_section') ): while( have_rows('content_section') ): the_row(); 
						// vars
						$title = get_sub_field('content_heading');
						$content = get_sub_field('content');
						$file = get_sub_field('file');
						$filename = get_sub_field('filename');

						if(get_sub_field('content_heading')): ?>
						<h4><?php echo $title; ?></h4>
 						<?php endif; ?>

						<?php if(get_sub_field('content')): ?>
						<div class="bg-white span12">
							<div id="main-content" class="inner-content">
								<?php echo $content; ?>

								<?php if(get_sub_field('file')): ?>
 								<div class="map-download">
 									<a class="download-link" href="<?php echo $file; ?>" target="_blank">
 										<p><?php echo $filename; ?></p>
 										<span class="download-arrow"></span>
 									</a>
 								</div>
 								<?php endif; ?>
 							</div>
 						</div>
 						<?php endif; ?>
 						<?php endwhile; ?>
 							
 						<?php endif; ?>
 						<?php endwhile; ?><?php endif; ?>
 						<div class="page-content"><?php the_content(); ?></div>
 					</div>
 				</div>

				<div id="sidebar" class="span3 sidebar sidebar-right" style="">
 					<div class="inner-content"><?php generated_dynamic_sidebar(); ?></div>
 				</div>

 			</div>
 		</div>
 		
 	</div>
 </section>

 <?php get_footer(); ?>