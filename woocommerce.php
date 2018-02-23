<?php
get_header();
get_template_part('sections/specia','breadcrumb'); ?>

<!-- Blog & Sidebar Section -->
<section class="page-wrapper">
        <div class="container">
                <div class="row padding-top-0 padding-bottom-60">
                   
                        <?php get_sidebar('woocommerce'); ?>

                        <!--Blog Detail-->
                        <div class="col-md-<?php echo ( !is_active_sidebar( 'woocommerce-1' ) ? '12' :'8' ); ?> col-md-12">

                                        <?php woocommerce_content(); ?>
                        </div>
                        <!--/End of Blog Detail-->




                </div>  
        </div>
</section>
<!-- End of Blog & Sidebar Section -->
 
<div class="clearfix"></div>

<?php get_footer(); ?>