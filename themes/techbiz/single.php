<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */
 
    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    //header
    get_header();

    /**
    * 
    * Hook for Blog Details Wrapper
    *
    * Hook techbiz_blog_details_wrapper_start
    *
    * @Hooked techbiz_blog_details_wrapper_start_cb 10
    *  
    */
    do_action( 'techbiz_blog_details_wrapper_start' );
    
    /**
    * 
    * Hook for Blog Details Column Start
    *
    * Hook techbiz_blog_details_col_start
    *
    * @Hooked techbiz_blog_details_col_start_cb 10
    *  
    */
    do_action( 'techbiz_blog_details_col_start' );

    while( have_posts( ) ) :
        the_post();
        
        get_template_part( 'templates/content-single');
        
    endwhile;
    /**
    * 
    * Hook for Blog Details Column End
    *
    * Hook techbiz_blog_details_col_end
    *
    * @Hooked techbiz_blog_details_col_end_cb 10
    *  
    */
    do_action( 'techbiz_blog_details_col_end' );

    /**
    * 
    * Hook for Blog Details Sidebar
    *
    * Hook techbiz_blog_details_sidebar
    *
    * @Hooked techbiz_blog_details_sidebar_cb 10
    *  
    */
    do_action( 'techbiz_blog_details_sidebar' );
    /**
    * 
    * Hook for Blog Details Wrapper End
    *
    * Hook techbiz_blog_details_wrapper_end
    *
    * @Hooked techbiz_blog_details_wrapper_end_cb 10
    *  
    */
    do_action( 'techbiz_blog_details_wrapper_end' );

    //footer
    get_footer();