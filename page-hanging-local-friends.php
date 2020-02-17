<?php
/*
 Template Name: Hanging local friends page
*/
?>

<?php get_header(); ?>

<main class="full-width-content hanging-local-page">
  <article class="container">
    <div class="row-fluid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <!-- Display page content -->
      <h3 class="c-section-header"><?php the_title(); ?></h3>

      <section class="c-friends-intro">
        <?php 
        $friends_intro = get_field('friends_intro');
        echo $friends_intro; 
        ?>
      </section>

      <?php if( have_rows('friends_row') ): while( have_rows('friends_row') ): the_row(); 
      
      // vars
      $image = get_sub_field('image');
      $title = get_sub_field('title');
      $content = get_sub_field('content');
      
      ?>
      <!-- Start info row -->
      <section class="c-grid-layout c-grid-layout__two-column c-grid-layout__gap-2em">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
        <div>
          <?php
            echo '<p class="c-friends-title">' . $title . '</p>';
            echo '<p>' . $content . '</p>';
          ?>
        </div>
      </section>
      <?php endwhile; ?>
      <?php endif; ?>
      <!-- End info row -->
    <?php endwhile; ?>
    <?php endif; ?>
    </div>
  </article>
</main>

<?php get_footer(); ?>