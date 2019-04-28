<?php
/*
 Template Name: Board Members page
*/
?>

<?php get_header(); ?>

<section class="board-members section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div id="content" class="content span9 content-left">
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h2>About Us</h2>

             <?php the_title( '<h3>', '</h3>' ); ?>

            <div id="main-content" class="inner-content">

            <?php the_content(); ?>

            <!-- Start Member ACF Repeater -->
            <?php if( have_rows('members') ): ?>
			<?php while( have_rows('members') ): the_row(); 
			// vars
			$image = get_sub_field('image');
			$name = get_sub_field('name');
			$bio = get_sub_field('bio');

			?>

			<div class="member">
				<div class="two columns">
					<img class="headshot" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
				</div>
				<div class="ten columns">
					<img class="headshot" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
					<p>
						<strong><?php echo $name; ?></strong>
						<?php echo $bio; ?>
					</p>
				</div>
			</div>

			<?php endwhile; ?><?php endif; ?>
			<!-- End Member ACF Repeater -->

			<hr />

			<!-- Start Featured Member ACF Repeater -->
            <?php if( have_rows('featured_member') ): ?>
			<?php while( have_rows('featured_member') ): the_row(); 
			// vars
			$image = get_sub_field('image');
			$name = get_sub_field('name');
			$bio = get_sub_field('bio');

			?>

			<div class="featured-member">
				<div class="twelve columns">
					<img class="headshot" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
					<p>
						<strong><?php echo $name; ?></strong>
						<?php echo $bio; ?>
					</p>
				</div>
			</div>

			<?php endwhile; ?><?php endif; ?>
			<!-- End Featured Member ACF Repeater -->

             <?php endwhile; ?>
             <?php endif; ?>
             </div>
           </div>
          <div id="sidebar" class="span3 sidebar sidebar-right" style="">
          <div class="inner-content">
          <?php generated_dynamic_sidebar(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>