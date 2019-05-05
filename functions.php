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
	wp_enqueue_style( 'ontrend-styles', get_stylesheet_directory_uri() . '/css/ontrendwebsites.css' );
	wp_enqueue_style( 'responsive-styles', get_stylesheet_directory_uri() . '/css/responsive.css' );

	wp_enqueue_style( 'event-styles', get_stylesheet_directory_uri() . '/css/events.css' );

	wp_enqueue_style( 'skeleton-styles', get_stylesheet_directory_uri() . '/css/skeleton.css' );
	
	wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );


	wp_enqueue_script( 'equal-heights-js', get_stylesheet_directory_uri() . '/js/equal-heights.js');
	wp_enqueue_script( 'masonry-js', get_stylesheet_directory_uri() . '/js/masonry.js');

	// Load slick carousel: http://kenwheeler.github.io/slick/
	wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js');
	wp_enqueue_style( 'slick-styles', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css' );

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

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );





?>