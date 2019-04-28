<?php
/*
 Template Name: Resources page
*/
?>

<?php get_header(); ?>

<section class="resources-page section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- full width container -->
		<div class="span12">
			<h2>
				<?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?>
			</h2>

			<h3>Research Data – Western Region</h3>

			<!-- ACF left and right columns -->
			<div class="resources-inner-content">
				<div class="span6"><?php the_field('left_column'); ?></div>
				<div class="span6"><?php the_field('right_column'); ?></div>
			</div>
			<!-- END ACF left and right columns -->
			<?php if( get_field('data_info') ): ?>
			<p class="data-info"><?php the_field('data_info'); ?></p>
			<?php endif; ?>
		</div>
		<!-- END full width container -->

        <div id="content" class="content span9 content-left">
        	<h3>Research Data – Documents available for Download Here...</h3>
            <div id="main-content" class="inner-content">
			<!-- ACF Repeater Document Downloads -->
			<?php if( have_rows('downloads') ): ?>

			<?php while( have_rows('downloads') ): the_row(); 

				// vars
				$file = get_sub_field('file');
				$filename = get_sub_field('filename');
				$thumb = get_sub_field('thumb');
				$info = get_sub_field('info');

				?>
				<div class="download">
					<!-- download link and info -->
					<div class="left">
						<a class="download-link" href="<?php echo $file['url']; ?>" target="_blank">
							<p><?php echo $filename; ?></p>
							<span class="download-arrow"></span>
						</a>
						<?php if(get_sub_field('info')): ?>
						<h4>Document Summary:</h4>
						<?php echo $info; ?>
						<?php endif; ?>
						
					</div>

					<!-- download thumb -->
					<div class="right">
						<a href="<?php echo $file['url']; ?>" target="_blank">
							<?php if(get_sub_field('thumb')): ?>
							<img src="<?php echo $thumb['url']; ?>" />
							<?php endif; ?>
						</a>
					</div>
				</div>
				<hr />
				<?php endwhile; ?><?php endif; ?>
				<!-- END ACF Repeater Document Downloads -->
				<!-- Content not used on this page -->
				<?php //the_content(); ?>
			<?php endwhile; ?><?php endif; ?>

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