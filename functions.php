<?php 


// options page ACF
if( function_exists('acf_add_options_page') ) {	acf_add_options_page(); }



/**
 * Proper way to enqueue scripts and styles
 */
function load_custom_script() {
	
	wp_enqueue_script('jquery', ("http://code.jquery.com/jquery-latest.min.js"), false, '');

	// moment.js
	wp_enqueue_script('script-moment', ("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"), false, '');
	
	// onTrend custom files
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js');	
	wp_enqueue_style( 'ontrend-styles', get_stylesheet_directory_uri() . '/css/ontrendwebsites.css?v=2.0' );
	wp_enqueue_style( 'responsive-styles', get_stylesheet_directory_uri() . '/css/responsive.css' );
	wp_enqueue_style( 'remodal-styles', get_stylesheet_directory_uri() . '/css/remodal.css' );
	wp_enqueue_style( 'remodal-theme-styles', get_stylesheet_directory_uri() . '/css/remodal-default-theme.css' );

	wp_enqueue_style( 'event-styles', get_stylesheet_directory_uri() . '/css/events.css' );
	wp_enqueue_style( 'additions-2020-styles', get_stylesheet_directory_uri() . '/css/additions-2020.css', array(), '12', 'all' );

	wp_enqueue_style( 'skeleton-styles', get_stylesheet_directory_uri() . '/css/skeleton.css' );
	
	wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );


	wp_enqueue_script( 'equal-heights-js', get_stylesheet_directory_uri() . '/js/equal-heights.js');
	wp_enqueue_script( 'masonry-js', get_stylesheet_directory_uri() . '/js/masonry.js');
	wp_enqueue_script( 'remodal-js', get_stylesheet_directory_uri() . '/js/remodal.js');

	// Load slick carousel: http://kenwheeler.github.io/slick/
	wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js');
	wp_enqueue_style( 'slick-styles', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css' );

	//wp_enqueue_script( 'datepicker-js', get_stylesheet_directory_uri() . '/vendor/jquery.daterangepicker.min.js');
	//wp_enqueue_style( 'datepicker-styles', get_stylesheet_directory_uri() . '/vendor/daterangepicker.min.css' );


}

add_action( 'wp_enqueue_scripts', 'load_custom_script' );


// remove auto formatting
//remove_filter( 'the_content', 'wpautop' );



function my_theme_add_editor_styles() {
	    add_editor_style( 'editor-style.css' );
	}
	add_action( 'init', 'my_theme_add_editor_styles' );



/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'West Side Stories', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'West Side Story', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'West Side Stories', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent West Side Story', 'twentythirteen' ),
		'all_items'           => __( 'All West Side Stories', 'twentythirteen' ),
		'view_item'           => __( 'View West Side Story', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New West Side Story', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit West Side Story', 'twentythirteen' ),
		'update_item'         => __( 'Update West Side Story', 'twentythirteen' ),
		'search_items'        => __( 'Search West Side Story', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'West Side Stories', 'twentythirteen' ),
		'description'         => __( 'West Side Story news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'west-side-stories', $args );

}
add_action( 'init', 'custom_post_type', 0 );
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

function add_query_vars_filter( $vars ){
  	$vars[] = "category";
	$vars[] = "eventId";
	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter', 10, 1 );


function check_in_range($start_date, $end_date, $date_from_user) {
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function search_ajax_enqueue() {
	// Enqueue javascript on the frontend.
	wp_enqueue_script(
		'search-filter',
		get_stylesheet_directory_uri() . '/js/search-filter.js',
		array('jquery')
	);
	// The wp_localize_script allows us to output the ajax_url path for our script to use.
	wp_localize_script(
		'search-filter',
		'ajax_obj',
		array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
	);
}
add_action( 'wp_enqueue_scripts', 'search_ajax_enqueue' );

function search_ajax_request() {

    if ( isset($_REQUEST) ) {
        $category = esc_html(clean_dash($_REQUEST['category']));
        $datetimeRequest = $_REQUEST['datetime'];
        $titleRequest = esc_html(clean($_REQUEST['title']));
        $locationRequest = esc_html($_REQUEST['location']);
        $currentPageRequest = esc_html($_REQUEST['current']);
        $categoryName = get_term_by('slug', $category, 'tribe_events_cat'); 

		$dateRange = 'all'; 
		$startDate = 0; 
		$endDate = 0; 
		$pagenum = 1;
		$html = ''; 
		$total = 0; 
		$arrResponse = array();

		if( !empty( $currentPageRequest )) {
			$pagenum = $currentPageRequest;
		} else {
			$pagenum = $pagenum;
		}

		if ($category == 'default') {
			$category ='all';
		}

		if(!array_filter($datetimeRequest) == []) {
			$startDate = esc_html($datetimeRequest[0]);
			$endDate = esc_html($datetimeRequest[1]);
			$dateRange = 'date-range';
		} else {
			$startDate = 'none';
			$endDate = 'none';
			$dateRange = $dateRange;
		}

		if (!empty($titleRequest)) {
			$titleRequest = $titleRequest;
		} else {
			$titleRequest = 'none';
		}

		if($locationRequest != 'default') {
			$locationRequest = esc_html(clean($locationRequest));
		} else {
			$locationRequest = 'none';
		}

		if( !empty( $categoryName )) {
			$arrResponse['category'] = $categoryName->name. ' Events';
		} else {
			$arrResponse['category'] = 'all events';
		}
			
// 			$request = wp_remote_get( 'https://wmt.everi.com.au/search-results/'.$category.'/none/'.$titleRequest.'/0/0/0/none/none/'.$locationRequest.'/date/'.$dateRange.'/'.$startDate.'/'.$endDate.'/false/'.$pagenum.'?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=small');
// 			if( is_wp_error( $request ) ) {
// 				return false; 
// 			}
// 			$body = wp_remote_retrieve_body( $request );
// 			$data = json_decode( $body, true);


			$url_wmt_api = 'https://wmt.everi.com.au/search-results/'.$category.'/none/'.$titleRequest.'/0/0/0/none/none/'.$locationRequest.'/date/'.$dateRange.'/'.$startDate.'/'.$endDate.'/false/'.$pagenum.'?out=json&access_token=f0e38e70b8cd4efab644a5046b546edb&image_size=small';
// 			$ch = curl_init();
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 			curl_setopt($ch, CURLOPT_URL,$url_wmt_api);
// 			$result=curl_exec($ch);
// 			curl_close($ch);
// 			$data = json_decode( $result, true);

            $curlopts = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HEADER => false
            ];
            $result = http_get_contents($url_wmt_api, $curlopts);
            
            $data = json_decode( $result, true);
			
			
			//var_dump($data);
			
			if(!array_filter($data) == []) {
				$total = $data['total'];
				$data = $data['data'];
				//print_r($data);
				$url = get_site_url(null, '/event-details/', '');

				foreach ($data as $key => $value) {
					$title = $data[$key]['Title'];
					$id = $data[$key]['Id'];
					$cat = clean($data[$key]['Category']);
					$image = $data[$key]['Images'][0]['Url'];
					$date = $data[$key]['EventDate'];
					$location = removeAuLocation($data[$key]['Location']);
					$hours = formatDateTime($data[$key]['Hours']);
					$description = wp_strip_all_tags($data[$key]['Description'], true);
			    
			    	$html .= '<div class="item-event item__container col-xs-12 col-sm-6 col-md-4" data-title="'.strtolower($title).'" data-location="'.strtolower($location).'" data-datetime="'.date('dmY', strtotime($date)).'">
			         	<div class="items__grid-item items_post_content items__grid-item-bg items__rseventspro-grid-item" style="background-image:url('.$image.')">
				            <a href="'.esc_url( add_query_arg( array('category'=> strtolower($cat), 'eventId' => $id ), $url ) ).'">
				               <div class="thumb">
				                  <img src="'.$image.'" alt="'.$title.'">
				               </div>
				               <div class="items__grid-item-description">'.wp_trim_words( $description, 15, '...' ).'</div>
				            </a>
			         	</div>
			         	<div class="items__content">
		                  <h2><a href="'.esc_url( add_query_arg( array('category'=> strtolower($cat), 'eventId' => $id ), $url ) ).'">'.$title.'</a></h2>
		                   <ul class="items__content_subtitle">
		                  		<li><span class="items__label item_date"><i class="fa fa-calendar"></i></span>'.date('M j, Y', strtotime($date)).'<label class="eventTime">'.$hours.'</label></li>
		                  		<li><span class="items__label items__content_label"><i class="fas fa-map-marker"></i></span>'.wp_trim_words( $location, 8, '...' ).'</li>
	              			</ul>
		               </div>
			      	</div>';
			  	}
			  	if(count($data) >= 20) {
			 		$pagenum++;
			 		$html .= '<div class="col-xs-12 text-center loadmore_content"><a href="#" class="btn btn-primary" id="loadMore" data-pagenum="'.$pagenum.'" >Load More </a></div>';
				} 
			} else {
				$html .= '<div class="item__container col-xs-12 text-center clear-search-wrapper"><span>Sorry, there are no events that match your search or chosen category.</span><a class="clearSearch" id="clearSearch" href="#"><i class="fas fa-times"></i> Clear Filters</a></div>';
			}

			$arrResponse['html'] = $html;
			$arrResponse['pagenum'] = $pagenum; 
			$arrResponse['total'] = $total;
			
			echo json_encode($arrResponse);
    }

   die();
}
 

function clean($post_name) {
   $name = trim($post_name);
   $post_name = str_replace(' ', '-', $name); 
   $newname =  preg_replace('/[^a-zA-Z0-9\s]/', '-', strip_tags(html_entity_decode($post_name)));
   return preg_replace('/-+/', '-', $newname);
}


function clean_dash($post_name) {
   $name = trim($post_name);
   $post_name = str_replace(' ', '_', $name); 
   $newname =  preg_replace('/[^a-zA-Z0-9\s]/', '_', strip_tags(html_entity_decode($post_name)));
   return preg_replace('/-+/', '_', $newname);
}
//$post_url=clean($post_name); 

add_action( 'wp_ajax_search_ajax_request', 'search_ajax_request' );
 
// If you wanted to also use the function for non-logged in users (in a theme for example)
add_action( 'wp_ajax_nopriv_search_ajax_request', 'search_ajax_request' );

function getNumEvents($number) {
    return $number;
}


function formatDateTime( $string ) {
	$arr = array();
	if (!empty($string)) { 
		preg_match_all("/(?:(?:0?[1-9]|1[0-2]):[0-5][0-9]\s?(?:[AP][Mm]?|[ap][m]?)?|(?:00?|1[3-9]|2[0-3]):[0-5][0-9])/", $string, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
		   array_push($arr, $val[0]);
		}
	}

	$stringDash = '';
	if(count($arr) > 1) {
		$stringDash = ' - ';
		return $arr[0].$stringDash.$arr[1];
	} else {
		return $arr[0];	
	}
}

function removeAuLocation($location) {

	$newlocation = str_replace("Victoria, Australia","Victoria", $location);
	$location_remove_au = explode (",", $newlocation); 
	
	//var_dump($location_remove_au);
	$trimmed_array=array_map('trim',$location_remove_au);
	if (strpos(end($trimmed_array), 'Australia') !== false) {
	    array_pop($trimmed_array);
	}
	//print_r($trimmed_array);
	return implode(", ",$trimmed_array);
}

// function get_api_info($jsonlink) {
//     global $apiInfo; // Check if it's in the runtime cache (saves database calls)
//     if( empty($apiInfo) ) $apiInfo = get_transient('api_info'); // Check database (saves expensive HTTP requests)
//     if( !empty($apiInfo) ) return $apiInfo;

//     $data = wp_remote_retrieve_body($jsonlink);

//     if( empty($data) ) return false;

//     $apiInfo = json_decode($data, true); // Load data into runtime cache
//     set_transient( 'api_info', $apiInfo, 12 * HOURS ); // Store in database for up to 12 hours
//     return $apiInfo;
// }
function theme_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_enqueue_style( 'durus-style-css', get_template_directory_uri() . '/style.css', array(), '1.3', 'all' );
}
add_action('wp_enqueue_scripts', 'theme_styles');


function http_get_contents($url, Array $opts = [])
{
    $ch = curl_init();
    if(!isset($opts[CURLOPT_TIMEOUT])) {
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    if(is_array($opts) && $opts) {
      foreach($opts as $key => $val) {
        curl_setopt($ch, $key, $val);
      }
    }
    if(!isset($opts[CURLOPT_USERAGENT])) {
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['SERVER_NAME']);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if(FALSE === ($retval = curl_exec($ch))) {
      error_log(curl_error($ch));
    }
    return $retval;
}


?>
