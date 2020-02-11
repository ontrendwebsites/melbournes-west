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
        <div><?php echo $intro; ?></div>
      </section>


      <!-- Two column intro section -->


      <!-- Scroll to section buttons -->

      <!-- Two column video repeater boxes -->
      <h3 class="c-section-header">Hanging Local Experiences</h3>
      <section class="c-grid-layout c-grid-layout__two-column c-grid-layout__gap-3em c-videos">
      <!-- ACF Repeater Videos -->
      <?php if( have_rows('video') ): 
        $i = 1;

        while( have_rows('video') ): the_row(); 
      // vars
      $link = get_sub_field('link');
      $title = get_sub_field('title');
      $info = get_sub_field('info');
      $url = get_sub_field('cta_url'); ?>
        <!-- Start Video box -->
        <div class="video">
          <?php echo $link; ?><!-- Video embed code -->
          <h5>Hanging Local Experience&nbsp;<?php echo $i; ?></h5>
          <?php if( !empty($info) ): ?><?php echo $info; ?><?php endif; ?><!-- video info -->
          <?php 
            if( $url ) :
          ?>
          <a class="booking-link" href="<?php echo $url; ?>" target="_blank">Bookings</a>
          <?php endif; ?>
        </div>
        <?php $i++; endwhile; ?>
        <?php endif; ?>
        <!-- END ACF Repeater Videos -->
      </section>

      <!-- Two column video repeater boxes -->

      <!-- Galleries -->
      <h3 class="c-section-header">Galleries</h3>
      <section class="c-galleries c-grid-layout c-grid-layout__three-column c-grid-layout__gap-2em">
      <!-- ACF Repeater Galleries -->
      <?php if( have_rows('gallery_repeater') ): ?><?php while( have_rows('gallery_repeater') ): the_row(); 
      // vars
      $name = get_sub_field('gallery_name');
      $gallery = get_sub_field('gallery');
      ?>
        <!-- Start Video box -->
        <div class="c-gallery">
          <?php if( !empty($name) ): ?><h5><?php echo $name; ?></h5><?php endif; ?>
          <?php if( !empty($gallery) ): ?><?php echo $gallery; ?><?php endif; ?>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
        <!-- END ACF Repeater Galleries -->
      </section>
      <!-- Galleries -->

      <!-- Friends and Family -->
      <h3 class="c-section-header">Friends and Family</h3>
      <section class="c-content">
        <?php the_content(); ?>
      </section>
      <!-- Friends and Family -->
    <?php endwhile; ?>
    <?php endif; ?>
    </div>
  </article>
</main>

<?php get_footer(); ?>