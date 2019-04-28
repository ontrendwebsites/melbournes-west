<?php
/*
 Template Name: Videos page
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
  <div class="container"><!-- div 1 -->
    <div class="row-fluid"><!-- div 2 -->
      <div class="row-fluid"><!-- div 3 -->
        <div id="content" class="content span9 content-left"><!-- div 4 -->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <h2><?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?></h2>
          <?php the_title( '<h3>', '</h3>' ); ?>
          <div id="main-content" class="inner-content">
            <?php //the_content(); ?>
            <div class="videos">
            <!-- ACF Repeater Videos -->
            <?php if( have_rows('video') ): ?><?php while( have_rows('video') ): the_row(); 
            // vars
            $link = get_sub_field('link');
            $title = get_sub_field('title');
            $info = get_sub_field('info'); ?>
              <!-- Start Video box -->
              <div class="video">
              
                <div class="vid-left"><?php echo $link; ?></div><!-- Video embed code -->
                <div class="vid-right">
                  <?php if( !empty($title) ): ?><h5><?php echo $title; ?></h5><?php endif; ?><!-- video title if it has one -->
                  <?php if( !empty($info) ): ?><?php echo $info; ?><?php endif; ?><!-- video info -->
                </div>
              </div>
              <?php endwhile; ?><?php endif; ?>
              <!-- END ACF Repeater Videos -->
            </div>
            <?php endwhile; ?><?php endif; ?>
          </div>
        </div><!-- div 4 -->
        <div id="sidebar" class="span3 sidebar sidebar-right" style=""><!-- sidebar div 1 -->
          <div class="inner-content"><!-- sidebar div 2 -->
            <?php generated_dynamic_sidebar(); ?>
          </div><!-- sidebar div 2 -->
        </div><!-- sidebar div 1 -->
      </div><!-- div 3 -->
    </div><!-- div 2 -->
  </div><!-- div 1 -->
</section>

<?php get_footer(); ?>