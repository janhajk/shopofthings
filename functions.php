<?php
/**
 * Electro - ShopOfThings
 *
 * @package electro-shopofthings
 */


add_action( 'wp_enqueue_scripts', 'electro_shopofthings_enqueue_styles' );
function electro_shopofthings_enqueue_styles() {
 
    $parent_style = 'electro';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'electro-shopofthings',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
?>