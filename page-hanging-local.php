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


      <!-- Scroll to section buttons -->

      <!-- Two column video repeater boxes -->
      <h3 id="section-1" class="c-section-header">Hanging Local Experiences</h3>
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

      <!-- Full column about content -->
      <?php
      // vars
      $about_content = get_field('about_hanging_local');
      ?>
      <h3 id="section-2" class="c-section-header">About Hanging Local</h3>
      <section class="c-about-content">
        <?php echo $about_content; ?>
      </section>
      <!-- Full column about content -->

      <!-- Galleries -->
      <h3 id="section-3" class="c-section-header">Galleries</h3>
      <section class="c-galleries c-grid-layout c-grid-layout__four-column c-grid-layout__gap-1em">
      <!-- ACF Repeater Galleries -->
      <?php if( have_rows('gallery_repeater') ): ?><?php while( have_rows('gallery_repeater') ): the_row(); 
      // vars
      $name = get_sub_field('gallery_name');
      $gallery = get_sub_field('gallery');
      ?>
        <!-- Start Video box -->
        <div class="c-gallery">
          <?php if( !empty($gallery) ): ?><?php echo $gallery; ?><?php endif; ?>
          <?php if( !empty($name) ): ?><p><strong><?php echo $name; ?></strong></p><?php endif; ?>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
        <!-- END ACF Repeater Galleries -->
      </section>
      <!-- Galleries -->

      <!-- Friends and Family -->
      <h3 id="section-4" class="c-section-header">Hanging Local with Friends and Family</h3>
      <section class="c-friends">
      <?php
        $friends_intro = get_field('friends_intro');
        if($friends_intro) : 
          echo '<div class="c-friends-intro">';
          echo $friends_intro;
          echo '</div>';
        endif;
      ?>

      <!-- ACF Repeater Document Downloads -->
      <?php if( have_rows('friends_info') ): while( have_rows('friends_info') ): the_row(); 
        // vars
        $file = get_sub_field('file_download');
        $filename = get_sub_field('title');
        $info = get_sub_field('description');
        ?>
        <div class="c-grid-layout c-grid-layout__three-column c-grid-layout__gap-2em">
          <!-- grid item 1 -->
          <p class="c-friends-title"><?php echo $filename; ?></p>
          <!-- grid item 2 -->
          <a href="<?php echo $file['url']; ?>" target="_blank">Click to download</a>
          <!-- grid item 3 -->
          <?php if($info): ?>
            <?php echo $info; ?>
          <?php endif; ?>
        </div>
        <?php endwhile; endif; ?>
        <!-- END ACF Repeater Document Downloads -->
      </section>
      <!-- Friends and Family -->

      <!-- Sponsor logos footer -->
      <section class="c-logos">
      <?php
        $footer_logos = get_field('footer_logos');
        if($footer_logos) : 
          echo $footer_logos;
        endif;
      ?>
      </section>

    <?php endwhile; ?>
    <?php endif; ?>
    </div>
  </article>
</main>

<?php get_footer(); ?>