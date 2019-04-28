<?php get_header(); ?>

<style>
.menu-item-584 a {
	padding: 0;
	color: #009f93 !important;
	font-weight: 600;
}
</style>

<section class="section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="content" class="content span9 content-left">

        	<h2>West Side Stories</h2>

			<?php the_title( '<h3>', '</h3>' ); ?>

			<div id="main-content" class="inner-content">
				<?php the_content(); ?>
			</div>
		</div>
		<div id="sidebar" class="span3 sidebar sidebar-right" style="">
			<div class="inner-content"><?php generated_dynamic_sidebar(); ?></div>
        </div>
      </div>
      <?php endwhile; ?><?php endif; ?><!-- END WP LOOP -->
    </div>
  </div>
</section>

<?php get_footer(); ?>