<?php
/*
 Template Name: Maps page
*/
?>

<?php get_header(); ?>

<section class="resources-page section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="content" class="content span9 content-left">
        	<h2>
				<?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?>
			</h2>
			<!-- Content not used on this page --><?php //the_content(); ?><?php endwhile; ?><?php endif; ?>

			<!-- Maps downloads -->
			<div class="maps-container">
				<h3>Maps Documents – Available for Download Here...</h3>
				<div class="bg-white span12">
		            <div id="main-content" class="inner-content">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!-- ACF Repeater Maps Downloads -->
					<?php if( have_rows('maps') ): ?>

					<?php while( have_rows('maps') ): the_row(); 

						// vars
						$file = get_sub_field('file');
						$filename = get_sub_field('map_name');
						$thumb = get_sub_field('thumb');

						?>
						<div class="map-download">
							<!-- download link -->
							<a class="download-link" href="<?php echo $file['url']; ?>" target="_blank">
								<p><?php echo $filename; ?></p>
								<span class="download-arrow"></span>
							</a>
							<!-- map image container -->
							<div class="map-container">
								<!-- map image -->
								<?php if(get_sub_field('thumb')): ?>
								<img src="<?php echo $thumb['url']; ?>" />
								<?php else: ?>
								<img src="http://localhost:8888/wmt/wp-content/uploads/2015/10/download-placeholder.png">
								<?php endif; ?>
								<p class="data-info map-info"><?php echo $filename; ?></p>
							</div>
						</div>
						<?php endwhile; ?><?php endif; ?>
						<!-- END ACF Repeater Maps Downloads -->
						
						<?php endwhile; ?>
						<?php endif; ?>
		            </div>
		        </div>
		    </div>
		    <!-- end Maps container -->
		</div>
		<div id="sidebar" class="span3 sidebar sidebar-right" style="">
			<div class="inner-content"><?php generated_dynamic_sidebar(); ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>