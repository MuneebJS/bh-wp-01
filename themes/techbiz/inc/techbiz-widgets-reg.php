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
    exit;
}

function techbiz_widgets_init() {

    if( class_exists('ReduxFramework') ) {
        $techbiz_sidebar_widget_title_heading_tag = techbiz_opt('techbiz_sidebar_widget_title_heading_tag');
    } else {
        $techbiz_sidebar_widget_title_heading_tag = 'h3';
    }

    //sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'techbiz' ),
        'id'            => 'techbiz-blog-sidebar',
        'description'   => esc_html__( 'Add Blog Sidebar Widgets Here.', 'techbiz' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<'.esc_attr($techbiz_sidebar_widget_title_heading_tag).' class="widget_title">',
        'after_title'   => '</'.esc_attr($techbiz_sidebar_widget_title_heading_tag).'>',
    ) );

    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'techbiz' ),
        'id'            => 'techbiz-page-sidebar',
        'description'   => esc_html__( 'Add Page Sidebar Widgets Here.', 'techbiz' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Offcanvas Sidebar', 'techbiz' ),
        'id'            => 'techbiz-offcanvas-sidebar',
        'description'   => esc_html__( 'Add Offcanvas Sidebar Widgets Here.', 'techbiz' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists('woocommerce') ) {
        register_sidebar(
            array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'techbiz' ),
                'id'            => 'techbiz-woo-sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce page sidebar.', 'techbiz' ),
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="widget-title"><h4>',
                'after_title'   => '</h4></div>',
            )
        );
    }

}

add_action( 'widgets_init', 'techbiz_widgets_init' );