<?php
/*
 Template Name: AAA
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

<section class="section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div id="content" class="content span9 content-right">
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h2>
              <?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?>
            </h2>

             <?php the_title( '<h3>', '</h3>' ); ?>

            <div id="main-content" class="inner-content">

             <div class="your-class">
              <div><img src="http://www.nicenicejpg.com/600/400" /></div>
              <div><img src="http://www.nicenicejpg.com/600/400" /></div>
              <div><img src="http://www.nicenicejpg.com/600/400" /></div>
            </div>

             <?php if(!$brad_data['check_disablecomments']): ?>
       	          <?php wp_reset_query(); ?>
	             <?php comments_template(); ?>
            <?php endif; ?>
             <?php endwhile; ?>
             <?php endif; ?>
             </div>
           </div>
          <div id="sidebar" class="span3 sidebar sidebar-left" style="">
          <div class="inner-content">
          <?php generated_dynamic_sidebar(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>