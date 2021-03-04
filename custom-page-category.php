<?php
/*
 Template Name: Custom Category Page
*/
?>

<?php 
	get_header(); 
	$category = get_query_var('category');
	$eventTag = 'none';
    if( !empty( $category )  && $category == 'featured' ) {
		$category = 'all';
		$eventTag = 'featured';
	} elseif (!empty( $category )  && $category != 'featured') {
		if ($category == 'default') {
			$category = 'all';
		} else {
			$category = esc_html(clean_dash($category));	
		}
		
		$eventTag = $eventTag;
	} else {
		$category = 'all';
		$eventTag = $eventTag;
	}
?>

<section class="section-custom home-content <?php if( $category == 'featured') { echo 'featured-section'; } else { echo 'category-section';  } ?>">
  <div class="container">
    <div class="row-fluid">
    	<div class="span12 span12-custom">
    		<span class="label-text">What's On in Melbourne's West</span>
			<h2 class="category-name">
				<?php 
					$term = get_term_by('slug', $category, 'tribe_events_cat'); 
					if ($eventTag == 'featured' ) {
						echo esc_html('Featured Events'); 
					} else {
						if( empty( $term->name )) {
							echo esc_html('All Events'); 
						} else {
							echo esc_html(str_replace('_', ' ', $term->name))." Events"; 
						}
					}
				?>
			</h2>
			<span class="numberEvents"></span>
		</div>
		<div class="search-filter-events col-xs-12">
			<?php get_template_part('search-event', 'top'); ?>
		</div>
		<div class="category-page category-events-page col-xs-12">
		   <div class="container-no-gutter items__container items__rseventspro items__grid">
			   
			      	<?php
		      			$pagenum = 1;
	      			 	 // $stringTest = 'https://wmt.everi.com.au/search-results/'.$category.'/'.$eventTag.'/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb';

       					// var_dump($category);
		  //    			$request = wp_remote_get( 'https://wmt.everi.com.au/search-results/'.$category.'/'.$eventTag.'/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=small', 
		  //    			    array(
    //                             'timeout'     => 10,
    //                             'sslverify' => false
    //                         )
		  //    			);
		      			
				// 		if( is_wp_error( $request ) ) {
				// 		    //error_log($request);
				// 			return false; 
				// 		} else {
				// 		    $body = wp_remote_retrieve_body( $request );
				// 		    $data = json_decode( $body, true);
				// 		}

						$url_wmt_api = 'https://wmt.everi.com.au/search-results/'.$category.'/'.$eventTag.'/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=small';
                        $curlopts = [
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_SSL_VERIFYHOST => false,
                            CURLOPT_HEADER => false
                        ];
                        $result = http_get_contents($url_wmt_api, $curlopts);
                        
                        $data = json_decode( $result, true);
						
						if(!array_filter($data) == []) {
							echo '<input type="hidden" id="totalEvent" name="totalEvent" value="'.$data['total'].'">';
							?>
							<div class="row list-events">
							<?php
							$data = $data['data'];
							//var_dump($data);
							$url = get_site_url(null, '/event-details/', '');

							foreach ($data as $key => $value) {
								$title = $data[$key]['Title'];
								$id = $data[$key]['Id'];
								$cat = clean($data[$key]['Category']);
								$image = $data[$key]['Images'][0]['Url'];
								$date = $data[$key]['EventDate'];
								$location = removeAuLocation($data[$key]['Address']['Formatted']);
								$hours = formatDateTime($data[$key]['Hours']);
								$description = wp_strip_all_tags($data[$key]['Description'], true);								
							?>

						      	<div class="item-event item__container col-xs-12 col-sm-6 col-md-4" data-title="<?php echo strtolower($title); ?>" data-location="<?php echo strtolower($location); ?>" data-datetime="<?php echo date('dmY', strtotime($date)) ?>">
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
					                  		<li><span class="items__label item_date"><i class="fa fa-calendar"></i></span><?php echo date('M j, Y', strtotime($date)); ?><label class="eventTime"><?php echo $hours; ?></label></li>
					                  		<li><span class="items__label items__content_label"><i class="fas fa-map-marker"></i></span><?php echo wp_trim_words( $location, 8, '...' ); ?></li>
				              			</ul>
					               </div>
						      	</div>

						    <?php
						  	}
						  	if(count($data) >= 20) {
						 		$pagenum++;
						 		echo '<div class="col-xs-12 text-center loadmore_content"><a href="#" class="btn btn-primary" id="loadMore" data-pagenum="'.$pagenum.'" >Load More </a></div>';
							} 
							?></div><?php
							
						} else {
							echo '<div class="item__container col-xs-12 text-center clear-search-wrapper"><span>Sorry, there are no events that match your search or chosen category.</span><a class="clearSearch" id="clearSearch" href="#"><i class="fas fa-times"></i> Clear Filters</a></div>';
						}
					?>
			   
			</div>
		</div>
    </div>
  </div>
</section>

<?php get_footer(); ?>