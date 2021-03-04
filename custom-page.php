<?php
/*
 Template Name: Custom Page
*/
?>

<?php get_header(); ?>

<section class="home-content">
  <div class="container">
    <div class="row-fluid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	    <!-- Slider ACF Repeater -->
	    <?php if( have_rows('slider') ): ?>
	    <div class="top-slider text-center">
	    	<h1>What's On in Melbourne's West</h1>
	    	<div class="whatson-notification">
	    		<i class="fas fa-info-circle"></i>
	    		<?php 
	    			$notification = get_field('whatson_notification', 3693);
	    			if( $notification ) {
	                   echo $notification;
	                }
	    			
	    		?>
	    	</div>
	    </div>
		<ul class="home-slides">

		<?php while( have_rows('slider') ): the_row(); 

			// vars
			$image = get_sub_field('image');
			$title = get_sub_field('title');
			$content = get_sub_field('tagline');
			$link = get_sub_field('link');
			$photo_info = get_sub_field('photo_info');

			?>

			<li class="slider">

				<?php if( $link ): ?>
					<a href="<?php echo $link; ?>">
				<?php endif; ?>

					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />

				<?php if( $link ): ?>
					</a>
				<?php endif; ?>
				<p>
					<strong><?php echo $title; ?></strong>
					<?php echo $content; ?>
				</p>
				<p class="photo-description">
					<?php echo $photo_info; ?>
				</p>

			</li>

		<?php endwhile; ?>

		</ul>

		<?php endif; ?>
		<!-- End Slider ACF Repeater -->

		<!-- Display page content -->
	    <?php //the_content(); ?> 
		
		<?php endwhile; ?>
		<?php endif; ?>

		<p class="data-info custom clear-magin">Featured Events</p>
		<div class="featured-events col-xs-12">
		   <div class="container-no-gutter items__container items__rseventspro items__grid">
			   <div class="row">
			      	<?php
			 //     	    if (!function_exists('write_log')) {

    //                         function write_log($log) {
    //                             if (true === WP_DEBUG) {
    //                                 if (is_array($log) || is_object($log)) {
    //                                     error_log(print_r($log, true));
    //                                 } else {
    //                                     error_log($log);
    //                                 }
    //                             }
    //                         }
                        
    //                     }
				// 		$request = wp_remote_get( 'https://wmt.everi.com.au/search-results/all/featured/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=small',
				// 		    array(
    //                             'timeout'     => 10,
    //                             'sslverify' => false
    //                         )
				// 		);
				// 		if( is_wp_error( $request ) ) {
				// 		    //error_log($request);
				// 			return false; 
				// 		} else {
				// 		    $body = wp_remote_retrieve_body( $request );
				// 		    $data = json_decode( $body, true);
				// 		}
				
						$url_wmt_api = "https://wmt.everi.com.au/search-results/all/featured/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=small'";
                        $curlopts = [
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_SSL_VERIFYHOST => false,
                            CURLOPT_HEADER => false
                        ];
                        $result = http_get_contents($url_wmt_api, $curlopts);
                        
                        $data = json_decode( $result, true);
						
						if( !empty( $data ) ) {
							$data = $data['data'];
							//var_dump($data[0]);
							$url = get_site_url(null, '/event-details/', '');
							$i = 1;
							foreach ($data as $key => $value) {
								//echo '<img src="'..'" alt=""/>'; 		
								if($i<=3):						
								$id = $data[$key]['Id'];

								$title = $data[$key]['Title'];
								$image = $data[$key]['Images'][0]['Url'];
								$date = $data[$key]['EventDate'];
								$hours = formatDateTime($data[$key]['Hours']);
								$cat = clean($data[$key]['Category']);
								//var_dump($cat);

								$location = removeAuLocation($data[$key]['Address']['Formatted']);
								$description = wp_strip_all_tags($data[$key]['Description'], true);
							?>
						      	<div class="item__container col-xs-12 col-sm-6 col-md-4">
						         	<div class="items__grid-item items_post_content items__grid-item-bg items__rseventspro-grid-item" style="background-image:url('<?php echo $image; ?>')">
							            <a href="<?php echo esc_url( add_query_arg( array('category'=> strtolower($cat), 'eventId' => $id ), $url ) ); ?>">
							               <div class="thumb">
							                  <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
							               </div>
							               <div class="items__grid-item-description">
						                     <?php echo  wp_trim_words( $description, 15, '...' ); ?>
						                  </div>
							            </a>
						         	</div>
						         	<div class="items__content">
					                  <h2><a href="<?php echo esc_url( add_query_arg( array('category'=> strtolower($cat), 'eventId' => $id ), $url ) ); ?>"><?php echo $title; ?></a></h2>
					                  	<ul class="items__content_subtitle">
					                  		<li><span class="items__label"><i class="fa fa-calendar"></i></span><?php echo date('M j, Y', strtotime($date)) ?><label class="eventTime"><?php echo $hours; ?></label></li>
					                  		<li><span class="items__label items__content_label"><i class="fas fa-map-marker"></i></span><?php echo wp_trim_words( $location, 8, '...' ); ?></li>
					              		</ul>
					               </div>
						      	</div>

						    <?php
						    	endif;
					    	$i++;
						  	}
						} 
					?>
			   </div>
			   	<div class="row">
				   	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				   		<a class="btn btn-primary btn-see-more" href="<?php echo esc_url(get_site_url(null, '/category-events/?category=featured', '')); ?>">See all featured</a>
				   	</div>
			   	</div>
			</div>
		</div>

		<p class="data-info custom">Events by Category</p>
		<div class="category-tiles col-xs-12">
		   <div class="container-no-gutter items__container items__featureboxes items__grid items__purplebox">
		      <div class="row">
			<?php
				$categories = get_categories( array(
				    'orderby' => 'term_order',    
				    'taxonomy' => 'tribe_events_cat',
				    'hide_empty' => false

				) );
				$html =''; 
				foreach( $categories as $category ) {
					$url = get_site_url(null, '/category-events/', '');
				    $html .='<div class="col-md-4 col-xs-12 position-1">';
				    $html .='<a href="'.esc_url( add_query_arg( array('category' => $category->slug ), $url ) ).'">';
				    $html .='<div class="items__grid-item items__grid-item-bg items__featureboxes-grid-item-purplebox" style="background-image:url('.z_taxonomy_image_url($category->cat_ID).')">';
				    $html .='<div class="thumb">';
				    if (function_exists('z_taxonomy_image_url')) {
				    	$html .='<img src="'.z_taxonomy_image_url($category->cat_ID).'" alt="'.$category->name.'">';
				    }
				    $html .='</div>'; 
				    $html .='<div class="items__grid-item-text"><h2>'.$category->name.'</h2></div>';
				    $html .='</div>';
				    $html .='</a>';
				    $html .='</div>';
				} 
				echo $html;	
			?>	
      			</div>
		   </div>
		   <div class="row">
			   	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			   		<a class="btn btn-primary btn-see-more" href="<?php echo esc_url(get_site_url(null, '/category-events/', '')); ?>">See all Events</a>
			   	</div>
		   	</div>
		   	
		   	<div class="row">
			   	<div class="col-xs-12 col-sm-12 disclaimer col-md-12 text-center">
			   	    <p>Disclaimer: Please note the events listed are not organised by or affiliated with Western Melbourne Tourism Inc. <br><a href="#" class="modal-toggle">Read the full disclaimer here</a></p>
			   	</div>
		   	</div>
		</div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal">
    <div class="modal-overlay modal-toggle"></div>
    <div class="modal-wrapper modal-transition">
      <div class="modal-header">
        <button class="modal-close modal-toggle"><i class="fa fa-times"></i></button>
        <h2 class="modal-heading">Disclaimer</h2>
      </div>
      
      <div class="modal-body">
        <div class="modal-content">
            <?php 
	   	        $value = get_field( "disclaimer_text", 3693 );
                if( $value ) {
                    echo $value;
                }
	   	    ?>
        </div>
      </div>
    </div>
</div>

<?php get_footer(); ?>