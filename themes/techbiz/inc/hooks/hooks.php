<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit();
	}

	/**
	* Hook for preloader
	*/
	add_action( 'techbiz_preloader_wrap', 'techbiz_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'techbiz_main_wrapper_start', 'techbiz_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'techbiz_header', 'techbiz_header_cb', 10 );

	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'techbiz_blog_start_wrap', 'techbiz_blog_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'techbiz_blog_col_start_wrap', 'techbiz_blog_col_start_wrap_cb', 10 );

	/**
	* Hook for Service Column Start Wrapper
	*/
    add_action( 'techbiz_service_col_start_wrap', 'techbiz_service_col_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'techbiz_blog_col_end_wrap', 'techbiz_blog_col_end_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'techbiz_blog_end_wrap', 'techbiz_blog_end_wrap_cb', 10 );

	/**
	* Hook for Blog Pagination
	*/
    add_action( 'techbiz_blog_pagination', 'techbiz_blog_pagination_cb', 10 );

    /**
	* Hook for Blog Content
	*/
	add_action( 'techbiz_blog_content', 'techbiz_blog_content_cb', 10 );

    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'techbiz_blog_sidebar', 'techbiz_blog_sidebar_cb', 10 );


    /**
	* Hook for Service Sidebar
	*/
	add_action( 'techbiz_service_sidebar', 'techbiz_service_sidebar_cb', 10 );

    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'techbiz_blog_details_sidebar', 'techbiz_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'techbiz_blog_details_wrapper_start', 'techbiz_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'techbiz_blog_post_meta', 'techbiz_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'techbiz_blog_details_share_options', 'techbiz_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Details post navigation
	*/
	add_action( 'techbiz_blog_details_post_navigation', 'techbiz_blog_details_post_navigation_cb', 10 );



	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'techbiz_blog_details_author_bio', 'techbiz_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'techbiz_blog_details_tags_and_categories', 'techbiz_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Deatils Related Post
	*/
	add_action( 'techbiz_blog_details_related_post', 'techbiz_blog_details_related_post_cb', 10 );

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'techbiz_blog_details_comments', 'techbiz_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('techbiz_blog_details_col_start','techbiz_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('techbiz_blog_details_col_end','techbiz_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('techbiz_blog_details_wrapper_end','techbiz_blog_details_wrapper_end_cb');

	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('techbiz_blog_post_thumb','techbiz_blog_post_thumb_cb');

	/**
	* Hook for Blog Post Content
	*/
	add_action('techbiz_blog_post_content','techbiz_blog_post_content_cb');


	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('techbiz_blog_postexcerpt_read_content','techbiz_blog_postexcerpt_read_content_cb');

	/**
	* Hook for footer content
	*/
	add_action( 'techbiz_footer_content', 'techbiz_footer_content_cb', 10 );

	/**
	* Hook for main wrapper end
	*/
	add_action( 'techbiz_main_wrapper_end', 'techbiz_main_wrapper_end_cb', 10 );

	/**
	* Hook for Back to Top Button
	*/
	add_action( 'techbiz_back_to_top', 'techbiz_back_to_top_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'techbiz_page_start_wrap', 'techbiz_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'techbiz_page_end_wrap', 'techbiz_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'techbiz_page_col_start_wrap', 'techbiz_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'techbiz_page_col_end_wrap', 'techbiz_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'techbiz_page_sidebar', 'techbiz_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'techbiz_page_content', 'techbiz_page_content_cb', 10 );