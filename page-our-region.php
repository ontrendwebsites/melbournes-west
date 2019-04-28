<?php
/*
 Template Name: Our Region page
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
        <div id="content" class="content span9 content-left">
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h2>About Us</h2>

             <?php the_title( '<h3>', '</h3>' ); ?>

            <div id="main-content" class="inner-content">

            <?php the_content(); ?>
            <?php endwhile; ?><?php endif; ?>

            <!-- start Region Highlights -->
            <?php if( have_rows('region_highlight') ): ?>
            <?php while( have_rows('region_highlight') ): the_row();

              // vars
              $title = get_sub_field('region_title');
              $suburbs = get_sub_field('region_suburbs');
              $info = get_sub_field('region_info');
              ?>

              <!-- Region container -->
              <div class="region">

                <h4><?php echo $title; ?></h4>

                <!-- Slideshow images -->
                <?php if( have_rows('region_slideshow') ): ?>

                <ul class="region-slides">

                <?php while( have_rows('region_slideshow') ): the_row();

                // vars
                $image = get_sub_field('region_image');
                $caption = get_sub_field('region_caption');
                ?>

                  <li class="slider">
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                  <?php if( $caption ): ?>
                  <p class="photo-description"><?php echo $caption; ?></p>
                  <?php endif; ?>
                  </li>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?><!-- End slideshow images -->

                <div class="region-info">

                  
                  <p class="region-suburbs"><?php echo $suburbs; ?></p>
                  <?php echo $info; ?>

                </div>
              </div>
              <hr class="region-hr" />
              <!-- End Region container -->
            <?php endwhile; ?><?php endif; ?>
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