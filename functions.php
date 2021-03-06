<?php
/**
 * Electro - ShopOfThings
 *
 * @package electro-shopofthings
 */
add_action('wp_enqueue_scripts', 'electro_shopofthings_enqueue_styles');
function electro_shopofthings_enqueue_styles() {
    $parent_style = 'electro';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('electro-shopofthings', get_stylesheet_directory_uri() . '/style.css', array($parent_style), wp_get_theme()->get('Version'));
}



// require_once '/var/www/vhosts/jan/shopofthings/wordpress/wp-content/geoip/vendor/autoload.php';
// use GeoIp2\Database\Reader;
function createAdsenseBlogResponsive() {
    $ad = '';

    // // This creates the Reader object, which should be reused across
    // // lookups.
    // $reader = new Reader('/var/www/vhosts/jan/shopofthings/wordpress/wp-content/geoip/GeoLite2-Country_20190205/GeoLite2-Country.mmdb');


    // if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //     $IP = $_SERVER['REMOTE_ADDR'];
    // }
    // else {
    //     $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    // }
    // $record = $reader->country($IP);
    // $ISO = $record->country->isoCode;

    // if (!in_array($ISO, array('CH', 'LI'))) {
        $ad = '<div align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Blog_Ad -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9031640881990657"
     data-ad-slot="1335518191"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
             ';
    // }
    $ad = '';
    return $ad;
}
add_shortcode('adsenseBlogResponsive', 'createAdsenseBlogResponsive');



/*
 * Remove jetpack ads
 *
 */
add_filter( 'jetpack_just_in_time_msgs', '__return_false' );


/**
 * Display Shortcode in description fields like attribute pages
 *
 * not working anymore
 */
// add_filter( 'term_description', 'shortcode_unautop' );
// add_filter( 'term_description', 'do_shortcode' );
// remove_filter( 'pre_term_description', 'wp_filter_kses' );


/*
* Reduce the strength requirement for woocommerce registration password.
* Strength Settings:
* 0 = Nothing = Anything
* 1 = Weak
* 2 = Medium
* 3 = Strong (default)
*/

add_filter( 'woocommerce_min_password_strength', 'wpglorify_woocommerce_password_filter', 10 );
function wpglorify_woocommerce_password_filter() {
      return 1;
}

//add_filter( 'allow_subdirectory_install', create_function( '', 'return true;' ));




/***** Adding Facebook Pixel *****/
add_action('wp_head', 'oiw_add_fbpixel');

function oiw_add_fbpixel() {
?>
<!-- Facebook Pixel Code -->
      <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '2735434730048399');
      fbq('track', 'PageView');
      </script>
      <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=2735434730048399&ev=PageView&noscript=1"
      /></noscript>
<!-- End Facebook Pixel Code -->
<?php
}


/***** Adding Facebook Pixel *****/
add_action('wp_head', 'oiw_add_linkedin');

function oiw_add_linkedin() {
?>
<script type="text/javascript">
_linkedin_partner_id = "2806769";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=2806769&fmt=gif" />
</noscript>
<?php
}


/**
 *
 * Remove "Archive" from all page titles
 *
 *
 *
 */
add_filter( 'get_the_archive_title', function ($title) {
 if ( is_category() ) {
 $title = single_cat_title( '', false );
 } elseif ( is_tag() ) {
 $title = single_tag_title( '', false );
 } elseif ( is_author() ) {
 $title = '<span class="vcard">' . get_the_author() . '</span>' ;
 }

 return $title;
});



add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
  $DEFAULT_BIG_STOCK_THRESHOLD = 20;
  $DEFAULT_LOW_STOCK_THRESHOLD = 2;
  $id = $_product->get_id();
    $product_stock = $_product->get_stock_quantity();
    if($product_stock){
      $big_stock_available = get_post_meta($id,'product_bigstock_threshold',true);
      $low_stock_available = get_post_meta($id,'product_lowstock_threshold',true);
      if(($big_stock_available != '' && $product_stock > $big_stock_available)){
         $availability['availability'] = __('>'.$big_stock_available.' sofort versandbereit', 'woocommerce');
      }
      else if(($lowstock_available != '' && $product_stock <= $lowstock_available)){
         $availability['availability'] = __('Nur noch '.$product_stock.' auf Lager', 'woocommerce');
      }
      else if ($product_stock >= $DEFAULT_BIG_STOCK_THRESHOLD) {
            $availability['availability'] = __('>'.$DEFAULT_BIG_STOCK_THRESHOLD.' sofort versandbereit', 'woocommerce');
      }
      else if ($product_stock < $DEFAULT_LOW_STOCK_THRESHOLD) {
            $availability['availability'] = __('Nur noch '.$product_stock.' auf Lager', 'woocommerce');
      }
    }
    return $availability;
}







?>