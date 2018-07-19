<?php
function shopofthings_css() {
   $parent_style = 'specia-parent-style';
   wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
   wp_enqueue_style( 'shopofthings-style', get_stylesheet_uri(), array( $parent_style ), wp_get_theme()->get('Version'));

   wp_enqueue_style('shopofthings-default',get_stylesheet_directory_uri() .'/css/colors/default.css');
   wp_dequeue_style('shopofthings-default', get_template_directory_uri() . '/css/colors/default.css');

   wp_enqueue_style('shopofthings-media-query',get_stylesheet_directory_uri() .'/css/media-query.css');
   wp_dequeue_style('shopofthings-media-query', get_template_directory_uri() . '/css/media-query.css');
}
add_action( 'wp_enqueue_scripts', 'shopofthings_css', 999);


function shopofthings_javascript() {
    wp_enqueue_script('shopofthings-js', get_stylesheet_directory_uri().'/js/shopofthings.js', array('jquery'), '1.0', true);
}
add_filter('child_add_javascripts','shopofthings_javascript');

function shopofthings_setup() {
    load_child_theme_textdomain('shopofthings', get_stylesheet_directory() . '/languages');
    add_editor_style(array(
        'css/editor-style.css',
        shopofthings_google_font()
    ));
}
add_action('after_setup_theme', 'shopofthings_setup');

/**
 * Register Google fonts for shopofthings.
 */
function shopofthings_google_font() {
    $get_fonts_url = '';
    $font_families = array();
    $font_families = array(
        'Open Sans:300,400,600,700,800',
        'Raleway:400,700'
    );
    $query_args    = array(
        'family' => urlencode(implode('|', $font_families)),
        'subset' => urlencode('latin,latin-ext')
    );
    $get_fonts_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
    return esc_url($get_fonts_url);
}

// fonts einfügen
function shopofthings_scripts_styles() {
    wp_enqueue_style('shopofthings-fonts', shopofthings_google_font(), array(), null);
}
add_action('wp_enqueue_scripts', 'shopofthings_scripts_styles');

// 
function shopofthings_remove_parent_setting($wp_customize) {
    $wp_customize->remove_panel('features_panel');
    $wp_customize->remove_control('slider-page3');
}
add_action('customize_register', 'shopofthings_remove_parent_setting', 99);

// Parent feature widgets entfernen > warum?
function shopofthings_remove_widgets() {
    unregister_sidebar('specia_feature_widget');
}
add_action('widgets_init', 'shopofthings_remove_widgets', 11);


//require_once( get_stylesheet_directory() . '/inc/customize/shopofthings-premium.php');

/**
 * Load Sanitization file.
 */
require_once get_stylesheet_directory() . '/inc/sanitization.php';





/**
 * @snippet       WooCommerce Remove "What is PayPal?" @ Checkout
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21186
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.4.2
 */
 
add_filter( 'woocommerce_gateway_icon', 'bbloomer_remove_what_is_paypal', 10, 2 );
 
function bbloomer_remove_what_is_paypal( $icon_html, $gateway_id ) {
// the apply_filters comes with 2 parameters: $icon_html, $this->id
// hence we declare 2 parameters within the function
// and the hook above takes the "2" as we decided to pass 2 variables
 
if( 'paypal' == $gateway_id ) {
// we use one of the passed variables to make sure we only
// run this function for the gateway ID == 'paypal'
 
$icon_html = '<img src="/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png" alt="PayPal Acceptance Mark">';
// in here we define our own $icon_html
// note there is no mention of the "What is PayPal"
// all we want is to repeat the part with the paypal logo
 
}
// endif
 
return $icon_html;
// we send the $icon_html variable back to the system
// if PayPal, the system will use our custom $icon_html
// if not, the system will use the original $icon_html
 
}