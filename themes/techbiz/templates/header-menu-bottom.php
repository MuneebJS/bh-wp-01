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

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( techbiz_meta('page_breadcrumb_area') ) ) {
            $techbiz_page_breadcrumb_area  = techbiz_meta('page_breadcrumb_area');
        } else {
            $techbiz_page_breadcrumb_area = '1';
        }
    }else{
        $techbiz_page_breadcrumb_area = '1';
    }

    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );

    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $techbiz_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title -->';
            echo '<div class="breadcumb-wrapper breadcumb-layout1 pt-175 pb-125 bg-black" data-overlay="dark" data-opacity="6">';
                echo '<div class="container z-index-common">';
                    echo '<div class="breadcumb-content">';
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                            if( techbiz_meta('page_breadcrumb_settings') == 'page' ) {
                                $techbiz_page_title_switcher = techbiz_meta('page_title');
                            } elseif( techbiz_opt('techbiz_page_title_switcher') == true ) {
                                $techbiz_page_title_switcher = techbiz_opt('techbiz_page_title_switcher');
                            }else{
                                $techbiz_page_title_switcher = '1';
                            }
                        } else {
                            $techbiz_page_title_switcher = '1';
                        }

                        if( $techbiz_page_title_switcher == '1' ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $techbiz_page_title_tag    = techbiz_opt('techbiz_page_title_tag');
                            }else{
                                $techbiz_page_title_tag    = 'h1';
                            }

                            if( defined( 'CMB2_LOADED' )  ){
                                if( !empty( techbiz_meta('page_title_settings') ) ) {
                                    $techbiz_custom_title = techbiz_meta('page_title_settings');
                                } else {
                                    $techbiz_custom_title = 'default';
                                }
                            }else{
                                $techbiz_custom_title = 'default';
                            }

                            if( $techbiz_custom_title == 'default' ) {
                                echo techbiz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $techbiz_page_title_tag ),
                                        "text"  => esc_html( get_the_title( ) ),
                                        'class' => 'breadcumb-title sec-title text-white'
                                    )
                                );
                            } else {
                                echo techbiz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $techbiz_page_title_tag ),
                                        "text"  => esc_html( techbiz_meta('custom_page_title') ),
                                        'class' => 'breadcumb-title sec-title text-white'
                                    )
                                );
                            }

                        }
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                            if( techbiz_meta('page_breadcrumb_settings') == 'page' ) {
                                $techbiz_breadcrumb_switcher = techbiz_meta('page_breadcrumb_trigger');
                            } else {
                                $techbiz_breadcrumb_switcher = techbiz_opt('techbiz_enable_breadcrumb');
                            }

                        } else {
                            $techbiz_breadcrumb_switcher = '1';
                        }

                        if( $techbiz_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                            techbiz_breadcrumbs(
                                array(
                                    'breadcrumbs_classes' => 'nav',
                                )
                            );
                        }
                        echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
        }
    } else {
        echo '<!-- Page title -->';
        echo '<div class="breadcumb-wrapper breadcumb-layout1 pt-175 pb-125 bg-black" data-overlay="dark" data-opacity="6">';
            echo '<div class="container z-index-common">';
                echo '<div class="breadcumb-content">';
                    if( class_exists( 'ReduxFramework' )  ){
                        $techbiz_page_title_switcher  = techbiz_opt('techbiz_page_title_switcher');
                    }else{
                        $techbiz_page_title_switcher = '1';
                    }

                    if( $techbiz_page_title_switcher ){
                        if( class_exists( 'ReduxFramework' ) ){
                            $techbiz_page_title_tag    = techbiz_opt('techbiz_page_title_tag');
                        }else{
                            $techbiz_page_title_tag    = 'h1';
                        }
                        if( class_exists('woocommerce') && is_shop() ) {
                            echo techbiz_heading_tag(
                                array(
                                    "tag"   => esc_attr( $techbiz_page_title_tag ),
                                    "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                    'class' => 'breadcumb-title sec-title text-white'
                                )
                            );
                        }elseif ( is_archive() ){
                            echo techbiz_heading_tag(
                                array(
                                    "tag"   => esc_attr( $techbiz_page_title_tag ),
                                    "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                    'class' => 'breadcumb-title sec-title text-white'
                                )
                            );
                        }elseif ( is_home() ){
                            $techbiz_blog_page_title_setting = techbiz_opt('techbiz_blog_page_title_setting');
                            $techbiz_blog_page_title_switcher = techbiz_opt('techbiz_blog_page_title_switcher');
                            $techbiz_blog_page_custom_title = techbiz_opt('techbiz_blog_page_custom_title');
                            if( class_exists('ReduxFramework') ){
                                if( $techbiz_blog_page_title_switcher ){
                                    echo techbiz_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $techbiz_page_title_tag ),
                                            "text"  => !empty( $techbiz_blog_page_custom_title ) && $techbiz_blog_page_title_setting == 'custom' ? esc_html( $techbiz_blog_page_custom_title) : esc_html__( 'Blog', 'techbiz' ),
                                            'class' => 'breadcumb-title sec-title text-white'
                                        )
                                    );
                                }
                            }else{
                                echo techbiz_heading_tag(
                                    array(
                                        "tag"   => "h1",
                                        "text"  => esc_html__( 'Blog', 'techbiz' ),
                                        'class' => 'breadcumb-title sec-title text-white',
                                    )
                                );
                            }
                        }elseif( is_search() ){
                            echo techbiz_heading_tag(
                                array(
                                    "tag"   => esc_attr( $techbiz_page_title_tag ),
                                    "text"  => esc_html__( 'Search Result', 'techbiz' ),
                                    'class' => 'breadcumb-title sec-title text-white'
                                )
                            );
                        }elseif( is_404() ){
                            echo techbiz_heading_tag(
                                array(
                                    "tag"   => esc_attr( $techbiz_page_title_tag ),
                                    "text"  => esc_html__( '404 PAGE', 'techbiz' ),
                                    'class' => 'breadcumb-title sec-title text-white'
                                )
                            );
                        }elseif( is_singular( 'product' ) ){
                            $posttitle_position  = techbiz_opt('techbiz_product_details_title_position');
                            $postTitlePos = false;
                            if( class_exists( 'ReduxFramework' ) ){
                                if( $posttitle_position && $posttitle_position != 'header' ){
                                    $postTitlePos = true;
                                }
                            }else{
                                $postTitlePos = false;
                            }

                            if( $postTitlePos != true ){
                                echo techbiz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $techbiz_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title sec-title text-white'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $techbiz_post_details_custom_title  = techbiz_opt('techbiz_product_details_custom_title');
                                }else{
                                    $techbiz_post_details_custom_title = __( 'Shop Details','techbiz' );
                                }

                                if( !empty( $techbiz_post_details_custom_title ) ) {
                                    echo techbiz_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $techbiz_page_title_tag ),
                                            "text"  => wp_kses( $techbiz_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title sec-title text-white'
                                        )
                                    );
                                }
                            }
                        }else{
                            $posttitle_position  = techbiz_opt('techbiz_post_details_title_position');
                            $postTitlePos = false;
                            if( is_single() ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }
                            if( is_singular( 'product' ) ){
                                $posttitle_position  = techbiz_opt('techbiz_product_details_title_position');
                                $postTitlePos = false;
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }

                            if( $postTitlePos != true ){
                                echo techbiz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $techbiz_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title sec-title text-white'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $techbiz_post_details_custom_title  = techbiz_opt('techbiz_post_details_custom_title');
                                }else{
                                    $techbiz_post_details_custom_title = __( 'Blog Details','techbiz' );
                                }

                                if( !empty( $techbiz_post_details_custom_title ) ) {
                                    echo techbiz_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $techbiz_page_title_tag ),
                                            "text"  => wp_kses( $techbiz_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title sec-title text-white'
                                        )
                                    );
                                }
                            }
                        }
                    }
                    if( class_exists('ReduxFramework') ) {
                        $techbiz_breadcrumb_switcher = techbiz_opt( 'techbiz_enable_breadcrumb' );
                    } else {
                        $techbiz_breadcrumb_switcher = '1';
                    }
                    if( $techbiz_breadcrumb_switcher == '1' ) {
                        techbiz_breadcrumbs(
                            array(
                                'breadcrumbs_classes' => 'nav',
                            )
                        );
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }