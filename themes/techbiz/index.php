<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}   
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook techbiz_blog_start_wrap
    *
    * @Hooked techbiz_blog_start_wrap_cb 10
    *  
    */
    do_action( 'techbiz_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook techbiz_blog_col_start_wrap
    *
    * @Hooked techbiz_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'techbiz_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook techbiz_blog_content
    *
    * @Hooked techbiz_blog_content_cb 10
    *  
    */
    do_action( 'techbiz_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook techbiz_blog_pagination
    *
    * @Hooked techbiz_blog_pagination_cb 10
    *  
    */
    do_action( 'techbiz_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook techbiz_blog_col_end_wrap
    *
    * @Hooked techbiz_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'techbiz_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook techbiz_blog_sidebar
    *
    * @Hooked techbiz_blog_sidebar_cb 10
    *  
    */
    do_action( 'techbiz_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook techbiz_blog_end_wrap
    *
    * @Hooked techbiz_blog_end_wrap_cb 10
    *  
    */
    do_action( 'techbiz_blog_end_wrap' );

    /**
    *
    * Hook for Home Page Team Members Section
    *
    * Hook techbiz_home_team_members
    *
    * @Hooked techbiz_home_team_members_cb 10
    *
    */
    do_action( 'techbiz_home_team_members' );

    //footer
    get_footer();