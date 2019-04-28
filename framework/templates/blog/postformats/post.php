<?php global $brad_data; ?>
<?php  global $post; ?>
<?php if( $brad_data['blog_layout'] == 'sidebar' ){ $img_size = 'post-wide';}
      else { $img_size = 'post-fullwidth'; } 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(' post-standard clearfix '); ?>>
  <?php  $img_list = get_post_meta( get_the_ID(), 'brad_image_list', false );
         if ( !is_array( $img_list ) )
			    	$img_list = ( array ) $img_list;
			    if ( !empty( $img_list ) ) {
			    	$img_list = implode( ',', $img_list );
			    	$images = $wpdb->get_col( "
			    	SELECT ID FROM $wpdb->posts
			    	WHERE post_type = 'attachment'
			    	AND ID IN ( $img_list )
			    	ORDER BY menu_order ASC
			    	" );
				}
				else{
					$images = false;
				}
    ?>
  <?php if( !empty($images) || get_post_meta(get_the_ID(),'brad_video_embed',true) != ''  ): ?>
  <div class="flexslider" data-effect="fade">
    <ul class="slides">
      <?php if( get_post_meta(get_the_ID(),'brad_video_embed',true) != ''):?>
      <li>
        <div class="video"><?php echo get_post_meta(get_the_ID(),'brad_video_embed',true);?></div>
      </li>
      <?php endif; ?>
      <?php if(!empty($images)):
		 foreach($images as $image ){
			$src = wp_get_attachment_image_src( $image , $img_size ); 
			$full_image = wp_get_attachment_image_src($image, '');
		?>
      <li>
        <div class="image hoverlay">
             <a href="<?php the_permalink(); ?>"><img src="<?php echo $src[0];?>" alt="<?php the_title();?>" /></a>
             <div class="overlay">
                 <div class="overlay-content"> <a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>" rel="prettyPhoto[post<?php the_ID();?>]"><i class="fa-search"></i></a></div>
             </div>
         </div>
      </li>
      <?php } endif; ?>
      <?php if(has_post_thumbnail()): ?>
      <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), ''); ?>
      <li>
        <div class="image hoverlay">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($img_size); ?></a>
          <?php if( $brad_data['blog_lightbox']): ?>
          <div class="overlay">
            <div class="overlay-content"> <a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>" rel="prettyPhoto[post<?php the_ID();?>]"><i class="fa-search"></i></a></div>
          </div>
         <?php endif; ?> 
        </div>
      </li>
      <?php endif; ?>
    </ul>
  </div>
  <?php endif; ?>

  <!-- Featured image left side -->
  <?php if(has_post_thumbnail()): ?>
  <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), ''); ?>
  <div class="image hoverlay">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($img_size); ?></a>
    <?php if( $brad_data['blog_lightbox']): ?>
    <div class="overlay">
      <div class="overlay-content"> <a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>" rel="prettyPhoto[post<?php the_ID();?>]"><i class="fa-search"></i></a></div>
    </div>
    <?php endif; ?> 
  </div>
  <?php endif; ?>
  <!-- END Featured image left side -->
  
  <!-- Blog right side -->
  <div class="blog-right">
    <!-- News Post title -->
    <h3 class="blog-link"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'brad'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h3>
    <!-- Post Meta Data -->
    <div class="post-meta-data"> 
    <?php if( $brad_data['check_author'] == true ):?>
      <span><?php echo __("Posted By:","brad");?>
      <?php the_author_posts_link(); ?>
      </span>
      <?php endif; ?>
      <?php if(has_category() && $brad_data['check_blog_categories'] == true ):?>
      <span class="divider">|</span><span><?php echo __('Posted In:','brad');?>
      <?php the_category(' , '); ?>
      </span>
      <?php endif; ?>
      <?php if($brad_data['check_blog_date'] == true): ?>
      <span class="divider">|</span><span>
      <?php echo get_the_date();?>
      </span>
      <?php endif; ?>
      <?php if ( comments_open() ) : ?>
      <span class="divider">|</span><span>
      <?php comments_popup_link('<i class="ss-air ss-chat"></i> 0','<i class="ss-air ss-chat"></i> 1', '<i class="ss-air ss-chat"></i>  %' ,'comments-info'); ?>
      </span>
      <?php endif; ?>
    </div>
    <!-- post excerpt -->
    <?php if(empty( $post->post_excerpt ) && $brad_data['check_excerpts'] != true ) { ?>
    <div class="post-content">
      <?php the_content('<span class="readmore">'. __("Read More", 'brad') . '<i class="icon-arrow-right-8"></i></span>'); ?>
    </div>
    <?php } else { ?>
    <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
    <?php if( $brad_data['check_readmore'] ): ?>
    <a href="<?php the_permalink(); ?>#post_content" class="button button_alternatelight button_small"> <?php echo __('Read More','brad');?><i class="icon-arrow-right8"></i></a>
    <?php endif; ?>
    <?php } ?>
    <!-- END post excerpt -->
  </div>
  <!-- END Blog right side -->
</div>
