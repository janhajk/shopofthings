<?php
function shopofthings_css() {
	$parent_style = 'specia-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'shopofthings-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('shopofthings-default',get_stylesheet_directory_uri() .'/css/colors/default.css');
	wp_dequeue_style('specia-default', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('shopofthings-media-query',get_stylesheet_directory_uri() .'/css/media-query.css');
	wp_dequeue_style('specia-media-query', get_template_directory_uri() . '/css/media-query.css');
}
add_action( 'wp_enqueue_scripts', 'shopofthings_css',999);
   	
function shopofthings_setup()	{	
	load_child_theme_textdomain( 'shopofthings', get_stylesheet_directory() . '/languages' );
	add_editor_style( array( 'css/editor-style.css', shopofthings_google_font() ) );
}
add_action( 'after_setup_theme', 'shopofthings_setup' );
	
/**
 * Register Google fonts for shopofthings.
 */
function shopofthings_google_font() {
	
    $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800', 'Raleway:400,700');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return esc_url($get_fonts_url);
	
}

function shopofthings_scripts_styles() {
    wp_enqueue_style( 'shopofthings-fonts', shopofthings_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'shopofthings_scripts_styles' );

function shopofthings_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_panel('features_panel');
	$wp_customize->remove_control('slider-page3');
}
add_action( 'customize_register', 'shopofthings_remove_parent_setting',99 );


function shopofthings_remove_widgets(){

	unregister_sidebar( 'specia_feature_widget' );
}
add_action( 'widgets_init', 'shopofthings_remove_widgets', 11 );

require_once( get_stylesheet_directory() . '/inc/customize/shopofthings-premium.php');

/**
 * Load Sanitization file.
 */
require_once get_stylesheet_directory() . '/inc/sanitization.php';