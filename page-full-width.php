<?php
/*
 Template Name: Full Width page
*/
?>

<?php get_header(); ?>

<section class="full-width-content">
  <div class="container">
    <div class="row-fluid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	    

		<!-- Display page content -->
	    <?php the_content(); ?>
		
		<?php endwhile; ?>
		<?php endif; ?>

		
    </div>
  </div>
</section>

<?php get_footer(); ?>