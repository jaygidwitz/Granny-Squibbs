<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'parallax', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'parallax' ) );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'parallax_customizer' );
function parallax_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );
	
}

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Squibbs' );
define( 'CHILD_THEME_URL', 'http://stuioissa.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles' );
function parallax_enqueue_scripts_styles() {

	wp_enqueue_script( 'parallax-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'waypoints', get_bloginfo( 'stylesheet_directory' ) . '/js/waypoints.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'waypoints-sticky', get_bloginfo( 'stylesheet_directory' ) . '/js/waypoints-sticky.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'waypoints-script', get_bloginfo( 'stylesheet_directory' ) . '/js/waypoints-script.js', array( 'jquery' ), '1.0.0' );
	//wp_enqueue_script( 'preloadcssimages', get_bloginfo( 'stylesheet_directory' ) . '/js/preloadCssImages.jQuery_v5.js', array( 'jquery' ), '1.0.0' );
	//wp_enqueue_script( 'preloadload', get_bloginfo( 'stylesheet_directory' ) . '/js/preloadload.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'retinajs', get_bloginfo( 'stylesheet_directory' ) . '/js/retina.min.js', array( 'jquery' ), '1.3.0', 'in_footer' );
	wp_enqueue_script( 'jpanelmenu', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.jpanelmenu.min.js', array( 'jquery' ), '1.3.0', 'in_footer' );
	wp_enqueue_script( 'prada', get_bloginfo( 'stylesheet_directory' ) . '/js/prada.js', array( 'jquery' ), '1.3.0', 'in_footer' );
	wp_enqueue_script( 'footerstick', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.footerstick.js', array( 'jquery' ), '1.3.0' );



	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'parallax-google-fonts', '//fonts.googleapis.com/css?family=Montserrat|Lobster+Two', array(), CHILD_THEME_VERSION );

}



//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
//remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'parallax_secondary_menu_args' );
function parallax_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'parallax-pro-blue'   => __( 'Parallax Pro Blue', 'parallax' ),
	'parallax-pro-green'  => __( 'Parallax Pro Green', 'parallax' ),
	'parallax-pro-orange' => __( 'Parallax Pro Orange', 'parallax' ),
	'parallax-pro-pink'   => __( 'Parallax Pro Pink', 'parallax' ),
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 70,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Hook after post widget after the entry content
add_action( 'genesis_after_entry', 'parallax_after_entry', 5 );
function parallax_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );

}



//* Hook before post widget before the entry content
add_action( 'genesis_before_entry', 'parallax_before_entry', 5 );
function parallax_before_entry() {

	if ( is_singular() )
		genesis_widget_area( 'before-entry', array(
			'before' => '<div class="before-entry widget-area">',
			'after'  => '</div>',
		) );

}


//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'parallax_comments_gravatar' );
function parallax_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-section-1',
	'name'        => __( 'Home Section 1', 'parallax' ),
	'description' => __( 'This is the home section 1 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-2',
	'name'        => __( 'Home Section 2', 'parallax' ),
	'description' => __( 'This is the home section 2 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-3',
	'name'        => __( 'Home Section 3', 'parallax' ),
	'description' => __( 'This is the home section 3 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-4',
	'name'        => __( 'Home Section 4', 'parallax' ),
	'description' => __( 'This is the home section 4 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-5',
	'name'        => __( 'Home Section 5', 'parallax' ),
	'description' => __( 'This is the home section 5 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'parallax' ),
	'description' => __( 'This is the after entry widget area.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'before-entry',
	'name'        => __( 'Before Entry', 'parallax' ),
	'description' => __( 'This is the before entry widget area.', 'parallax' ),
) );



add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
/**
 * Register and load font awesome CSS files using a CDN.
 *
 * @link   http://www.bootstrapcdn.com/#fontawesome
 * @author FAT Media
 */
function prefix_enqueue_awesome() {
	wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '4.1.0' );
}




// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');


// Add Shortcode
function recipe_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'link' => '',
			'src' => '',
			'title' => '',
		), $atts )
	);

	// Code
return '<div class="col-3  m-half">
	<div class="module type-text-bottom  small-image">
		<a href="' . $link . '" class="module-link">
			<div class="module-img">
				<img class="sized" src="' . $src . '" >
			</div>
			<div class="module-content bg-white">
				<div class="module-title">' . $title . '</div>
		
				<div class="module-action">See recipe</div>
		
			</div>
		</a>
	</div>
</div>';

}
add_shortcode( 'recipe', 'recipe_shortcode' );




//* Reposition the breadcrumbs
//remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
//add_action( 'genesis_before_entry', 'genesis_do_breadcrumbs' );


// Add Shortcode
function teas_insert_shortcode_first( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'img' => '',
			'title' => '',
			'desc' => '',
			'link' => '',
		), $atts )
	);

	// Code
return '<div class="one-third first teas" ><li>
<figure class="tea-type-green">
<a href="' . $link . '" class="more"><div style="background-image: url(' . $img . '); background-repeat:no-repeat; background-position:center; background-size: 60%; height: 300px; width: 300px; margin: 0 auto;"></div></a>
</figure>
<article><div><h2>' . $title . '</h2><p>' . $desc . '</p></div><a href="' . $link . '" class="more"><span>See details</span></a></article></a></li></div>';
}
add_shortcode( 'tea_first', 'teas_insert_shortcode_first' );



// Add Shortcode
function teas_insert_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'img' => '',
			'title' => '',
			'desc' => '',
			'link' => '',
		), $atts )
	);

	// Code
return '<div class="one-third teas" ><li>
<figure class="tea-type-green">
<a href="' . $link . '" class="more">
<div style="background-image: url(' . $img . '); background-repeat:no-repeat; background-position:center; background-size: 60%; height: 300px; width: 300px; margin: 0 auto;"></div>
</a>
</figure>
<article><div><h2>' . $title . '</h2><p>' . $desc . '</p></div><a href="' . $link . '" class="more"><span>See details</span></a></article></li></div>';
}
add_shortcode( 'tea', 'teas_insert_shortcode' );



/** Load scripts on Portfolio page */
add_action('genesis_after_footer', 'child_load_portfolio');
function child_load_portfolio() {
    if(is_page('hashtag-grannysquibbs') && ! wp_is_mobile()) { 
       				wp_enqueue_script( 'parallax-script2', get_bloginfo( 'stylesheet_directory' ) . '/js/parallax2.js', array( 'jquery' ), '1.0.0' );
    }
}
/*
//* Sticky Footer Functions
add_action( 'genesis_before_header', 'stickyfoot_wrap_begin');
function stickyfoot_wrap_begin() {
	echo '<div class="page-wrap">';
}
 
add_action( 'genesis_before_footer', 'stickyfoot_wrap_end');
function stickyfoot_wrap_end() {
	echo '</div><!-- page-wrap -->';
}*/
