<?php
/*
 Template Name: Custom Details Page
*/
?>

<?php 
	get_header(); 
	$event_id = get_query_var('eventId');
	if( empty( $event_id )) {
		$event_id = 0;
	} else {
		$event_id = esc_html($event_id);
	}
?>

<section class="section-custom event-details-page">
    <div class="whatson-notification">
		<i class="fas fa-info-circle"></i>
		<?php 
			$notification = get_field('whatson_notification', 3693);
			if( $notification ) {
               echo $notification;
            }
			
		?>
	</div>
	
	<div class="container containerCustom">
		<div class="event-heo-image"></div>
	</div>	
  
  <div class="container">
    <div class="row-fluid">
    	<!-- <div class="span12">
			<h2><?php //echo esc_html($cat); ?></h2>
		</div> -->
		<div class="category-page category-events-page col-xs-12">
		   <div class="container-no-gutter items__container items__rseventspro items__grid">
			   <div class="row">
			      	<?php
			      		
				// 		$request = wp_remote_get( 'https://wmt.everi.com.au/search-results/all/none/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=large&list_id='.$event_id,
				// 		    array(
    //                             'timeout'     => 10,
    //                             'sslverify' => false
    //                         )
				// 		);

				// 		if( is_wp_error( $request ) ) {
				// 			return false; 
				// 		} else {
				// 		    $body = wp_remote_retrieve_body( $request );
				// 		    $data = json_decode( $body, true);
				// 		}
				
						$url_wmt_api = 'https://wmt.everi.com.au/search-results/all/none/none/0/0/0/none/none/none/date/all/none/none/false/1?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=large&list_id='.$event_id;
                        $curlopts = [
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_SSL_VERIFYHOST => false,
                            CURLOPT_HEADER => false
                        ];
                        $result = http_get_contents($url_wmt_api, $curlopts);
                        
                        $data = json_decode( $result, true);
						
						if( ! empty( $data ) ) {
							//var_dump($data[0]);
							$data = $data['data'];
							//var_dump($data);
							$eventId = esc_html($event_id);
							//print_r($eventId);
							$url = get_site_url(null, '/category-events/', '');
							foreach ($data as $key => $value) {
								//var_dump($data[$key]['Id']);
								if($data[$key]['Id'] === $eventId ) {
									$title = $data[$key]['Title'];
									$image = $data[$key]['Images'][0]['Url'];
									$date = $data[$key]['EventDate'];
									$cat = clean($data[$key]['Category']);
									$location = removeAuLocation($data[$key]['Address']['Formatted']);
									$description = $data[$key]['Description'];

									$email = $data[$key]['EventEmailAddress'];
									$bookaticket = $data[$key]['BookingUrl'];
									$eventurl = $data[$key]['EventUrl'];
									$phone = $data[$key]['PhoneNumber'];
									$mobile = $data[$key]['MobileNumber'];
									$hours = formatDateTime($data[$key]['Hours']);
									//var_dump($value);
								?>

									<div id="rs_event_show" itemscope="" itemtype="http://schema.org/Event">
										   <!-- Event Title -->
										   <img class="main-image" src ="<?php echo esc_html($image); ?>" alt="<?php echo esc_html($title); ?>" /> 
										   <h1 itemprop="name"><?php echo esc_html($title); ?></h1>
										   <div class="breadcrumb">
										   		<p><a href="<?php echo esc_url(get_site_url(null, '/whats-on/', ''))?>">What's on</a> > <a href="<?php echo esc_url( add_query_arg( array('category'=> strtolower($cat)), $url ) ); ?>"><?php echo $data[$key]['Category']; ?> Events</a></p>
										   		<hr>
										   </div>
										   <!--//end Event Title -->
										   <div class="rs_clear"></div>
										   
										   <p class="rsep_date">
										   		<i class="fa fa-calendar"></i> On <?php echo date('M j, Y', strtotime($date));?> <span class="hours"><?php echo ', '.$hours; ?></span>
										   </p>
										   <div class="rsep_contact_block">      
										      	<p class="rsep_location" itemscope="" itemtype="http://schema.org/EventVenue">
										         	<i class="fas fa-map-marker"></i> At <?php echo esc_html($location); ?>
										      	</p>
										    	
										        <?php  if (!empty($email)): ?>  	
										      	<p class="rsep_mail">
										         	<i class="fas fa-envelope"></i> <a href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a>
										      	</p>
										      	<?php endif; ?>
										      	<?php  if (!empty($phone)): ?>
										      	<p class="rsep_phone">
										         	<i class="fas fa-phone"></i> <?php echo esc_html($phone); ?> <?php  if (!empty($mobile)): ?><?php echo " - ".esc_html($mobile); ?><?php endif; ?>
										      	</p>
										      	<?php endif; ?>
										      	<?php  if (!empty($eventurl)): ?>
										      	<p class="rsep_url">
										         	<i class="fas fa-globe" aria-hidden="true"></i> <a href="<?php echo esc_html($eventurl); ?>" target="_blank" title="<?php echo esc_html($eventurl); ?>"><?php echo esc_html('Visit website'); ?></a>
										      	</p>
										      	<?php endif; ?>
										      	<?php  if (!empty($bookaticket)): ?>  	
										      	<p class="rsep_ticket">
										         	<i class="fas fa-ticket" aria-hidden="true"></i> <a target="_blank" title="<?php echo esc_html($bookaticket); ?>" href="<?php echo esc_html($bookaticket); ?>">Book Tickets</a>
										      	</p>
										      	<?php endif; ?>
										      
										   </div>
										   <div class="rsep_taxonomy_block">
										      <div class="single-event-description">
										         <div itemprop="description">
									             	<?php  if (!empty($description)): ?>  	
											      	<?php echo $description; ?>
											      	<?php endif; ?>
										         </div>
										      </div>
										   </div>
										</div>
								   </div>

								<?php
								} // endif eventID
						  	}
						}
					?>
			</div>
		</div>
		<div class="col-xs-12"><a href="<?php echo esc_url( add_query_arg( array('category'=> strtolower($cat)), $url ) ); ?>" class="btn btn-primary back-button" id="back-button"><i class="fas fa-chevron-left"></i> BACK</a></div>
    </div>
  </div>
</section>
<section class="section-event-category">
  <p class="data-info custom">Events by Category</p>
  <div class="container">
    <div class="row-fluid">
		<div class="category-tiles col-xs-12">
		   <div class="container-no-gutter items__container items__featureboxes items__grid items__purplebox">
		      <div class="row">
			<?php
				$categories = get_categories( array(
				    'orderby' => 'name',
				    'order'   => 'ASC',
				    'taxonomy' => 'tribe_events_cat',
				    'hide_empty' => false

				) );
				$html =''; 
				foreach( $categories as $category ) {
				    //echo '<p>' . sprintf( esc_html__( '%s', 'textdomain' ), var_dump($category) ) . '</p>';					
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
		</div>
    </div>
  </div>

</section>

<?php get_footer(); ?>