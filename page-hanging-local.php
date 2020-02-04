<?php
/*
 Template Name: Hanging local page
*/
?>

<?php get_header(); ?>

<main class="full-width-content hanging-local-page">
  <article class="container">
    <div class="row-fluid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <!-- Display page content -->

      <?php
      // setup variables
      $featured_image = get_the_post_thumbnail();

      $image = get_field('featured_image');
      $intro = get_field('right_side_intro_text');

      ?>

      <!-- Two column intro section -->
      <section class="c-grid-layout c-grid-layout__two-column-hanging-intro c-grid-layout__gap-2em c-intro">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
        <?php echo $intro; ?>
      </section>


      <!-- Two column intro section -->


      <!-- Scroll to section buttons -->

      <!-- Two column video repeater boxes -->



      <!-- Two column video repeater boxes -->

      

      <h3>Hanging local Videos</h3>
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

      <?php the_content(); ?>
    <?php endwhile; ?>
    <?php endif; ?>
    </div>
  </article>
</main>

<?php get_footer(); ?>