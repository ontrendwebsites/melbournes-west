<?php
/*
 Template Name: Eat Drink Westside page
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
      $intro_video = get_field('intro_video');
      $image = get_field('featured_image');
      $intro = get_field('right_side_intro_text');
      $intro_content = get_field('intro_content', false, false);
      ?>

      <!-- Two column intro section -->
      <section class="c-grid-layout c-grid-layout__two-column-hanging-intro c-grid-layout__gap-2em c-intro">
        <!-- <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" /> -->
        <?php echo $intro_video; ?>
        <div><?php echo $intro; ?></div>
      </section>
      <!-- Two column intro section -->

      <!-- One column intro content -->
      
        <?php if($intro_content) {
          echo '<section class="c-intro-content">';
          echo $intro_content; 
          echo '</section>';
        } 
        ?>
      <!-- One column intro section -->

      <!-- Two column video repeater boxes -->
      <?php
        if( have_rows('video') ):
      ?>

      <h3 id="section-1" class="c-section-header">Westside Crawls 2021</h3>
      <section class="c-grid-layout c-grid-layout__two-column c-grid-layout__gap-3em c-videos">
        <!-- ACF Repeater Videos -->
        <?php
        $i = 1;

        while( have_rows('video') ): the_row(); 
        // vars
        $link = get_sub_field('link');
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $info = get_sub_field('info');
        $url = get_sub_field('cta_url'); ?>
        <!-- Start Video box -->
        <div class="video">
          <?php 
          // Video or image
          if($link):
            echo $link;
          elseif($image):
            echo '<img src="' . $image["url"] . '" />';
          endif;



          ?>
          <h5>Westside Crawl&nbsp;<?php echo $i; ?></h5>
          <?php if( !empty($info) ): ?><?php echo $info; ?><?php endif; ?><!-- video info -->
          <?php 
            if( $url ) :
          ?>
          <a class="booking-link" href="<?php echo $url; ?>" target="_blank">Book now</a>
          <?php endif; ?>
        </div>
        <?php $i++; endwhile; ?>
        
        <!-- END ACF Repeater Videos -->
      </section>
      <?php endif; ?>

      <!-- Two column video repeater boxes -->

      <!-- Sponsor logos footer -->
      <?php
        $footer_logos = get_field('footer_logos', false, false);
        if($footer_logos) : 
          echo '<section class="c-logos" style="text-align: center;">';
          echo $footer_logos;
          echo '</section>';
        endif;
      ?>

    <?php endwhile; ?>
    <?php endif; ?>
    </div>
  </article>
</main>

<?php get_footer(); ?>