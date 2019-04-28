<?php
/*
 Template Name: About Us page
*/
?>

<?php get_header(); ?>

<section class="section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div id="content" class="content span9 content-left">
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h2>About Us</h2>

             <?php the_title( '<h3>', '</h3>' ); ?>

            <div id="main-content" class="inner-content">
            	<?php the_content(); ?>
            <?php endwhile; ?><?php endif; ?>
            </div>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<!-- left width container -->
			<div class="about-spacer"></div>
			<h2>Our Strategic Plan 2014 - 2017</h2>

			<h3>Summary</h3>

			<div id="main-content" class="inner-content">
				<!-- ACF Repeater Document Downloads -->
				<?php if( have_rows('highlight') ): ?>

				<?php while( have_rows('highlight') ): the_row(); 

				// vars
				$heading = get_sub_field('heading');
				$text = get_sub_field('text');

				?>
				<div class="summary-box" style="display: none;">
					<!-- summary title -->
					<p class="summary-title"><?php echo $heading; ?></p>
					<!-- arrow image -->
					<img class="desktop" src="../wp-content/themes/Durus-Child/img/summary-arrow.png" />
					<img class="mobile" src="../wp-content/themes/Durus-Child/img/summary-arrow-right.png" />
					<!-- summary info -->
					<?php echo $text; ?>
				</div>
				<?php endwhile; ?><?php endif; ?>
				<!-- END ACF Repeater Document Downloads -->

				<!-- Stratigic Plan image from page back end -->
				<?php 

				$image = get_field('plan_image');

				if( !empty($image) ): ?>
				<span class="strategic-plan-image">
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				</span>
				<?php endif; ?>

			</div>



			<!-- left width container -->
			<div class="about-spacer"></div>

			<h3>Download Our Strategic Plan Here:</h3>

			<div id="main-content" class="inner-content">

				<div class="download">
					<!-- download link and info -->
					<div class="left">

						<?php if( get_field('strategic_file') ): ?>
						<a class="download-link" href="<?php the_field('strategic_file'); ?>" target="_blank">
							<p><?php the_field('file_name'); ?></p>
							<span class="download-arrow"></span>
						</a>
						<?php endif; ?>
						<h4>Document Summary:</h4>
						<?php the_field('strategic_info'); ?>
					</div>

					<!-- download thumb -->
					<div class="right">
						<?php if( get_field('strategic_file') ): ?>
						<a href="<?php the_field('strategic_file'); ?>" target="_blank">
							<?php $image = get_field('strategic_thumb');
							if( !empty($image) ): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php else: ?>
							<img src="http://localhost:8888/wmt/wp-content/uploads/2015/10/download-placeholder.png">
							<?php endif; ?>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

           </div><!-- Left side end -->
          <div id="sidebar" class="span3 sidebar sidebar-right" style="">
	          <div class="inner-content">
	          <?php generated_dynamic_sidebar(); ?>
	          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php endwhile; ?><?php endif; ?>


<?php get_footer(); ?>