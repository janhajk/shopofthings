<!DOCTYPE html>
<html <?php language_attributes(); ?>>
        <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>

        <?php wp_head(); ?>
           
         <!-- Matomo -->
         <script type="text/javascript">
           var _paq = _paq || [];
           /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
           _paq.push(['trackPageView']);
           _paq.push(['enableLinkTracking']);
           (function() {
             var u="//piwik.janschaer.ch/";
             _paq.push(['setTrackerUrl', u+'piwik.php']);
             _paq.push(['setSiteId', '1']);
             var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
             g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
           })();
         </script>
         <!-- End Matomo Code -->
           
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'specia' ); ?></a>

<?php if ( get_header_image() ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
        </a>
<?php endif;  ?>

<?php get_template_part('sections/header'); ?>

<?php get_template_part('sections/specia','navigation'); ?>


        <div id="content" class="site-content" role="main">
