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


    // preloader hook function
    if( ! function_exists( 'techbiz_preloader_wrap_cb' ) ) {
        function techbiz_preloader_wrap_cb() {
            $preloader_display              =  techbiz_opt('techbiz_display_preloader');

            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){
                    echo '<div class="preloader">';
                        echo '<button class="vs-btn preloaderCls">'.esc_html__( 'Cancel Preloader', 'techbiz' ).'</button>';
                        echo '<div class="preloader-inner">';
                            echo '<span class="loader"></span>';
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="preloader">';
                    echo '<button class="vs-btn preloaderCls">'.esc_html__( 'Cancel Preloader', 'techbiz' ).'</button>';
                    echo '<div class="preloader-inner">';
                        echo '<span class="loader"></span>';
                    echo '</div>';
                echo '</div>';
            }
        }
    }

    // Header Hook function
    if( !function_exists('techbiz_header_cb') ) {
        function techbiz_header_cb( ) {
            get_template_part('templates/header');
            get_template_part('templates/header-menu-bottom');
        }
    }

    // back top top hook function
    if( ! function_exists( 'techbiz_back_to_top_cb' ) ) {
        function techbiz_back_to_top_cb( ) {
            $backtotop_trigger = techbiz_opt('techbiz_display_bcktotop');
            $custom_bcktotop   = techbiz_opt('techbiz_custom_bcktotop');
            $custom_bcktotop_icon   = techbiz_opt('techbiz_custom_bcktotop_icon');
            if( class_exists( 'ReduxFramework' ) ) {
                if( $backtotop_trigger ) {
                    if( $custom_bcktotop ) {
                        echo '<!-- Back to Top Button -->';
                        echo '<a href="#" class="scrollToTop scroll-btn">';
                            echo '<i class="fa '.esc_attr( $custom_bcktotop_icon ).'"></i>';
                        echo '</a>';
                        echo '<!-- End of Back to Top Button -->';
                    } else {
                        echo '<!-- Back to Top Button -->';
                        echo '<a href="#" class="scrollToTop scroll-btn">';
                            echo '<i class="far fa-arrow-up"></i>';
                        echo '</a>';
                        echo '<!-- End of Back to Top Button -->';
                    }
                }
            }

        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('techbiz_blog_start_wrap_cb') ) {
        function techbiz_blog_start_wrap_cb() {
            echo '<section class="vs-blog-wrapper space-top space-extra-bottom arrow-wrap">';
                echo '<div class="container">';
                    if( is_active_sidebar( 'techbiz-blog-sidebar' ) ){
                        $techbiz_gutter_class = 'gx-40';
                    }else{
                        $techbiz_gutter_class = '';
                    }
                    echo '<div class="row '.esc_attr( $techbiz_gutter_class ).'">';
        }
    }

    // Blog End Wrapper Function
    if( !function_exists('techbiz_blog_end_wrap_cb') ) {
        function techbiz_blog_end_wrap_cb() {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('techbiz_blog_col_start_wrap_cb') ) {
        function techbiz_blog_col_start_wrap_cb() {
            if( class_exists('ReduxFramework') ) {
                $techbiz_blog_sidebar = techbiz_opt('techbiz_blog_sidebar');
                if( $techbiz_blog_sidebar == '2' && is_active_sidebar('techbiz-blog-sidebar') ) {
                    echo '<div class="col-lg-8 order-lg-last">';
                } elseif( $techbiz_blog_sidebar == '3' && is_active_sidebar('techbiz-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('techbiz-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('techbiz_blog_col_end_wrap_cb') ) {
        function techbiz_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('techbiz_blog_sidebar_cb') ) {
        function techbiz_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_blog_sidebar = techbiz_opt('techbiz_blog_sidebar');
            } else {
                $techbiz_blog_sidebar = 2;
            }
            if( $techbiz_blog_sidebar != 1 && is_active_sidebar('techbiz-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('techbiz_blog_details_sidebar_cb') ) {
        function techbiz_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_blog_single_sidebar = techbiz_opt('techbiz_blog_single_sidebar');
            } else {
                $techbiz_blog_single_sidebar = 4;
            }
            if( $techbiz_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('techbiz_blog_pagination_cb') ) {
        function techbiz_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('techbiz_blog_content_cb') ) {
        function techbiz_blog_content_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_blog_grid = techbiz_opt('techbiz_blog_grid');
            } else {
                $techbiz_blog_grid = '1';
            }

            if( $techbiz_blog_grid == '1' ) {
                $techbiz_blog_grid_class = 'col-lg-12';
            } elseif( $techbiz_blog_grid == '2' ) {
                $techbiz_blog_grid_class = 'col-sm-6';
            } else {
                $techbiz_blog_grid_class = 'col-lg-4 col-sm-6';
            }

            echo '<div class="row">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($techbiz_blog_grid_class).'">';
                            get_template_part('templates/content',get_post_format());
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    get_template_part('templates/content','none');
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('techbiz_footer_content_cb') ) {
        function techbiz_footer_content_cb( ) {

            if( class_exists('ReduxFramework') && did_action( 'elementor/loaded' )  ){
                if( is_page() || is_page_template('template-builder.php') ) {
                    $post_id = get_the_ID();

                    // Get the page settings manager
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

                    // Get the settings model for current post
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    // Retrieve the Footer Style
                    $footer_settings = $page_settings_model->get_settings( 'techbiz_footer_style' );

                    // Footer Local
                    $footer_local = $page_settings_model->get_settings( 'techbiz_footer_builder_option' );

                    // Footer Enable Disable
                    $footer_enable_disable = $page_settings_model->get_settings( 'techbiz_footer_choice' );

                    if( $footer_enable_disable == 'yes' ){
                        if( $footer_settings == 'footer_builder' ) {
                            // local options
                            $techbiz_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $techbiz_local_footer->ID );
                            echo '</footer>';
                        } else {
                            // global options
                            $techbiz_footer_builder_trigger = techbiz_opt('techbiz_footer_builder_trigger');
                            if( $techbiz_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $techbiz_global_footer_select = get_post( techbiz_opt( 'techbiz_footer_builder_select' ) );
                                $footer_post = get_post( $techbiz_global_footer_select );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                                echo '</footer>';
                            } else {
                                // wordpress widgets
                                techbiz_footer_global_option();
                            }
                        }
                    }
                } else {
                    // global options
                    $techbiz_footer_builder_trigger = techbiz_opt('techbiz_footer_builder_trigger');
                    if( $techbiz_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer>';
                        $techbiz_global_footer_select = get_post( techbiz_opt( 'techbiz_footer_builder_select' ) );
                        $footer_post = get_post( $techbiz_global_footer_select );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                        echo '</footer>';
                    } else {
                        // wordpress widgets
                        techbiz_footer_global_option();
                    }
                }
            } else {
                echo '<div class="footer-copyright text-center bg-black py-3 link-inherit z-index-common">';
                    echo '<div class="container">';
                        echo '<p class="mb-0 text-white">'.sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Techbiz.','techbiz' ),esc_url('#'),__( 'Vecuro', 'techbiz' ) ).'</p>';
                    echo '</div>';
                echo '</div>';
            }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('techbiz_blog_details_wrapper_start_cb') ) {
        function techbiz_blog_details_wrapper_start_cb( ) {
            echo '<section class="vs-blog-wrapper blog-details space-top space-extra-bottom">';
                echo '<div class="container">';
                    if( is_active_sidebar( 'techbiz-blog-sidebar' ) ){
                        $techbiz_gutter_class = 'gx-40';
                    }else{
                        $techbiz_gutter_class = '';
                    }
                    echo '<div class="row '.esc_attr( $techbiz_gutter_class ).'">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('techbiz_blog_details_col_start_cb') ) {
        function techbiz_blog_details_col_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_blog_single_sidebar = techbiz_opt('techbiz_blog_single_sidebar');
                if( $techbiz_blog_single_sidebar == '2' && is_active_sidebar('techbiz-blog-sidebar') ) {
                    echo '<div class="col-lg-8 order-last">';
                } elseif( $techbiz_blog_single_sidebar == '3' && is_active_sidebar('techbiz-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('techbiz-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }

    // blog details post meta hook function
    if( !function_exists('techbiz_blog_post_meta_cb') ) {
        function techbiz_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_display_post_date      =  techbiz_opt('techbiz_display_post_date');
                $techbiz_display_post_views     =  techbiz_opt('techbiz_display_post_views');
                $techbiz_display_post_comment   =  techbiz_opt('techbiz_display_post_comment');

            } else {
                $techbiz_display_post_date      = '1';
                $techbiz_display_post_views     = '';
                $techbiz_display_post_comment   = '1';
            }

            echo '<!-- Blog Meta -->';
            echo '<div class="blog-meta">';
                if( $techbiz_display_post_views ){
                    echo '<span><i class="fal fa-eye"></i> ';
                    echo techbiz_getPostViews( get_the_ID() );
                    echo esc_html__( ' Views', 'techbiz' );
                    echo '</span>';
                }
                if( $techbiz_display_post_comment ){
                    if( get_comments_number() == 1 ){
                        $comment_text = __( ' Comment', 'techbiz' );
                    }else{
                        $comment_text = __( ' Comments', 'techbiz' );
                    }
                    echo '<span><a href="'.esc_url( get_comments_link( get_the_ID() ) ).'"><i class="fal fa-comments"></i>'.esc_html( get_comments_number() ).''.$comment_text.'</a></span>';
                }
                if( $techbiz_display_post_date ){
                    echo '<span><a href="'.esc_url( techbiz_blog_date_permalink() ).'"><i class="fal fa-calendar-minus"></i>';
                        echo '<time datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time>';
                    echo '</a></span>';
                }

            echo '</div>';

        }
    }

    // blog details share options hook function
    if( !function_exists('techbiz_blog_details_share_options_cb') ) {
        function techbiz_blog_details_share_options_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_post_details_share_options = techbiz_opt('techbiz_post_details_share_options');
            } else {
                $techbiz_post_details_share_options = false;
            }
            if( function_exists( 'techbiz_social_sharing_buttons' ) && $techbiz_post_details_share_options ) {
                echo '<div class="col-md-7 d-sm-flex justify-content-md-end align-items-center">';
                    echo '<span class="share-links-title">'.esc_html__( 'Social Network:', 'techbiz' ).'</span>';
                    echo '<ul class="social-links">';
                        echo techbiz_social_sharing_buttons();
                    echo '</ul>';
                    echo '<!-- End Social Share -->';
                echo '</div>';
            }
        }
    }

    // blog details post navigation hook function
    if( !function_exists('techbiz_blog_details_post_navigation_cb') ) {
        function techbiz_blog_details_post_navigation_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_post_details_post_navigation = techbiz_opt('techbiz_post_details_post_navigation');
            } else {
                $techbiz_post_details_post_navigation = true;
            }

            $prevpost = get_previous_post();
            $nextpost = get_next_post();

            if( $techbiz_post_details_post_navigation && ! empty( $prevpost ) || !empty( $nextpost ) ) {
                echo '<!-- Post Navigation -->';
                echo '<div class="post-pagination">';
                    echo '<div class="row justify-content-between align-items-center">';
                        if( ! empty( $prevpost ) ) {
                            echo '<!-- Nav Previous -->';
                            echo '<div class="col-6">';
                                echo '<div class="post-pagi-box prev">';
                                    if( ! empty( get_the_post_thumbnail_url( $prevpost->ID ) ) ){
                                        echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'">';
                                            echo techbiz_img_tag( array(
                                                'url'   => esc_url( get_the_post_thumbnail_url( $prevpost->ID ) )
                                            ) );
                                        echo '</a>';
                                    }
                                    echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'">'.esc_html__( 'Previous Post', 'techbiz' ).'</a>';
                                echo '</div>';
                            echo '</div>';
                            echo '<!-- End Nav Previous -->';
                        }

                        if( !empty( $nextpost ) ) {
                            echo '<div class="col-6">';
                                echo '<div class="post-pagi-box next">';
                                    if( ! empty( get_the_post_thumbnail_url( $nextpost->ID ) ) ){
                                        echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'">';
                                            echo techbiz_img_tag( array(
                                                'url'   => esc_url( get_the_post_thumbnail_url( $nextpost->ID ) )
                                            ) );
                                        echo '</a>';
                                    }
                                    echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'">'.esc_html__( 'Next Post', 'techbiz' ).'</a>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
                echo '<!-- End Post Navigation -->';
            }
        }
    }
    // blog details author bio hook function
    if( !function_exists('techbiz_blog_details_author_bio_cb') ) {
        function techbiz_blog_details_author_bio_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $postauthorbox =  techbiz_opt( 'techbiz_post_details_author_desc_trigger' );
            } else {
                $postauthorbox = '1';
            }
            if( !empty( get_the_author_meta('description')  ) && $postauthorbox == '1' ) {
                echo '<!-- Post Author -->';
                echo '<div class="blog-author">';
                    echo '<!-- Author Thumb -->';
                    echo '<div class="media-img">';
                        echo techbiz_img_tag( array(
                            "url"   => esc_url( get_avatar_url( get_the_author_meta('ID'), array(
                            "size"  => 189
                            ) ) ),
                        ) );
                    echo '</div>';
                    echo '<!-- End of Author Thumb -->';
                    echo '<div class="media-body">';
                        echo techbiz_heading_tag( array(
                            "tag"   => "h3",
                            "text"  => techbiz_anchor_tag( array(
                                "text"  => esc_html( ucwords( get_the_author() ) ),
                                "url"   => esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
                                'class' => 'text-reset',
                            ) ),
                            'class' => 'author-name h4',
                        ) );
                        if( function_exists( 'techbiz_get_user_role_name' ) ){
                            echo '<p class="author-degi">'.esc_html( techbiz_get_user_role_name( get_the_author_meta('ID') ) ).'</p>';
                        }
                        if( ! empty( get_the_author_meta('description') ) ) {
                            echo '<p class="author-text">';
                                echo esc_html( get_the_author_meta('description') );
                            echo '</p>';
                        }
                    echo '</div>';
                echo '</div>';
                echo '<!-- End of Post Author -->';
            }

        }
    }

    // Blog Details Comments hook function
    if( !function_exists('techbiz_blog_details_comments_cb') ) {
        function techbiz_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo techbiz_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'techbiz' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Related Post hook function
    if( !function_exists('techbiz_blog_details_related_post_cb') ) {
        function techbiz_blog_details_related_post_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_excerpt_length = '4';
                $techbiz_post_details_related_post = techbiz_opt('techbiz_post_details_related_post');
            } else {
                $techbiz_excerpt_length = '4';
                $techbiz_post_details_related_post = false;
            }
            $relatedpost = new WP_Query( array(
                "post_type"         => "post",
                "posts_per_page"    => "3",
                "category__in"      => wp_get_post_categories(get_the_ID()),
                "post__not_in"      =>  array( get_the_ID() )
            ) );
            if( $relatedpost->have_posts() && $techbiz_post_details_related_post ) {
                echo '<!-- Related Post -->';
                echo '<div class="related-post-wrapper pt-40">';
                    echo '<h2 class="inner-title1 h1">'.esc_html__( 'Relatetd', 'techbiz' ).' <span class="text-theme">'.esc_html__( 'Post', 'techbiz' ).'</span></h2>';
                    echo '<div class="row text-center">';
                        while( $relatedpost->have_posts() ) {
                            $relatedpost->the_post();
                            echo '<div class="col-lg-4">';
                                echo '<!-- Single Post -->';
                                echo '<div class="vs-blog blog-grid">';
                                    if( has_post_thumbnail(  ) ){
                                        the_post_thumbnail( 'techbiz-related-post-size', [ 'class'  => 'w-100' ] );
                                    }
                                    echo '<div class="blog-content">';
                                        if( get_the_title() ){
                                            echo '<!-- Post Title -->';
                                            echo '<h4 class="blog-title fw-semibold"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title(), '3', '' ) ).'</a></h4>';
                                            echo '<!-- End Post Title -->';
                                        }
                                        echo '<span><a href="'.esc_url( techbiz_blog_date_permalink() ).'">';
                                            echo '<time datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time>';
                                        echo '</a></span>';
                                        echo '<span>';
                                            echo techbiz_getPostViews( get_the_ID() );
                                            echo esc_html__( ' Views', 'techbiz' );
                                        echo '</span>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<!-- End Single Post -->';
                            echo '</div>';
                        }
                        wp_reset_postdata();
                    echo '</div>';
                echo '</div>';
                echo '<!-- End Related Post -->';
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('techbiz_blog_details_col_end_cb') ) {
        function techbiz_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('techbiz_blog_details_wrapper_end_cb') ) {
        function techbiz_blog_details_wrapper_end_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('techbiz_page_start_wrap_cb') ) {
        function techbiz_page_start_wrap_cb( ) {
            if( is_page( 'cart' ) ){
                $section_class = "vs-cart-wrapper space-top space-md-bottom";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "vs-checkout-wrapper space-top space-md-bottom";
            }else{
                $section_class = "space-top space-md-bottom";
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('techbiz_page_end_wrap_cb') ) {
        function techbiz_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('techbiz_page_col_start_wrap_cb') ) {
        function techbiz_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_page_sidebar = techbiz_opt('techbiz_page_sidebar');
            }else {
                $techbiz_page_sidebar = '1';
            }
            if( $techbiz_page_sidebar == '2' && is_active_sidebar('techbiz-page-sidebar') ) {
                echo '<div class="col-lg-8 order-last">';
            } elseif( $techbiz_page_sidebar == '3' && is_active_sidebar('techbiz-page-sidebar') ) {
                echo '<div class="col-lg-8">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('techbiz_page_col_end_wrap_cb') ) {
        function techbiz_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('techbiz_page_sidebar_cb') ) {
        function techbiz_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $techbiz_page_sidebar = techbiz_opt('techbiz_page_sidebar');
            }else {
                $techbiz_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $techbiz_page_layoutopt = techbiz_opt('techbiz_page_layoutopt');
            }else {
                $techbiz_page_layoutopt = '3';
            }

            if( $techbiz_page_layoutopt == '1' && $techbiz_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $techbiz_page_layoutopt == '2' && $techbiz_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('techbiz_page_content_cb') ) {
        function techbiz_page_content_cb( ) {
            if(  class_exists('woocommerce') && ( is_woocommerce() || is_cart() || is_checkout() || is_page('wishlist') || is_account_page() )  ) {
                echo '<div class="woocommerce--content">';
            } else {
                echo '<div class="page--content clearfix">';
            }

                the_content();

                // Link Pages
                techbiz_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }

    if( !function_exists('techbiz_blog_post_thumb_cb') ) {
        function techbiz_blog_post_thumb_cb( ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $techbiz_post_slider_thumbnail = techbiz_meta( 'post_format_slider' );

            if( !empty( $techbiz_post_slider_thumbnail ) ){
                echo '<div class="blog-img-slider slick-carousel blog-img">';
                    foreach( $techbiz_post_slider_thumbnail as $single_image ){
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                        echo techbiz_img_tag( array(
                            'url'   => esc_url( $single_image )
                        ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    }
                echo '</div>';
            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                echo '<!-- Post Thumbnail -->';
                echo '<div class="blog-img">';
                    if( ! is_single() ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                    }
                        the_post_thumbnail();
                    if( ! is_single() ){
                        echo '</a>';
                    }
                echo '</div>';
                echo '<!-- End Post Thumbnail -->';
            }elseif( $format == 'video' ){
                if( has_post_thumbnail() && !empty ( techbiz_meta( 'post_format_video' ) ) ){
                    echo '<div class="blog-video blog-img">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            the_post_thumbnail();
                        if( ! is_single() ){
                            echo '</a>';
                        }
                        echo '<a href="'.esc_url( techbiz_meta( 'post_format_video' ) ).'" class="play-btn popup-video">';
                          echo '<i class="fas fa-play"></i>';
                        echo '</a>';
                    echo '</div>';
                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            echo techbiz_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $techbiz_audio = techbiz_meta( 'post_format_audio' );
                if( !empty( $techbiz_audio ) ){
                    echo '<div class="blog-audio blog-image">';
                            echo wp_oembed_get( $techbiz_audio );
                    echo '</div>';
                }elseif( !is_single() ){
                    echo '<div class="blog-audio blog-image">';
                            echo techbiz_embedded_media( array( 'audio', 'iframe' ) );
                    echo '</div>';
                }
            }

        }
    }

    if( !function_exists( 'techbiz_blog_post_content_cb' ) ) {
        function techbiz_blog_post_content_cb( ) {
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
                'sup'       => array(),
                'sub'       => array(),
            );

            echo '<!-- blog-content -->';
            echo '<div class="blog-content">';
                // Blog Post Meta
                do_action( 'techbiz_blog_post_meta' );

                if( ! is_single() ){
                    echo '<!-- Post Title -->';
                    echo '<h2 class="blog-title h3"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title(), $allowhtml ).'</a></h2>';
                    echo '<!-- End Post Title -->';
                }

                // Excerpt And Read More Button
                do_action( 'techbiz_blog_postexcerpt_read_content' );

            echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }

    // Home page team members section hook function
    if ( ! function_exists( 'techbiz_home_team_members_cb' ) ) {
        function techbiz_home_team_members_cb() {
            if ( ! is_home() && ! is_front_page() ) {
                return;
            }

            $techbiz_team_members = array(
                array(
                    'name' => 'Hafiz Umer Sheikh',
                    'role' => 'CEO',
                    'icon' => 'fas fa-user-tie',
                ),
                array(
                    'name' => 'Muneeb Khan',
                    'role' => 'CTO',
                    'icon' => 'fas fa-user-cog',
                ),
                array(
                    'name' => 'Sana Khan',
                    'role' => 'COO',
                    'icon' => 'fas fa-user-circle',
                ),
            );

            echo '<!-- Home Team Members Section -->';
            echo '<section class="vs-team-wrapper space-top space-extra-bottom">';
                echo '<div class="container">';
                    echo '<div class="vs-teams-wrapper">';
                        echo '<div class="row justify-content-center">';
                            foreach ( $techbiz_team_members as $member ) {
                                echo '<div class="col-lg-4 col-sm-6">';
                                    echo '<!-- Single Team Member -->';
                                    echo '<div class="team-style1 text-center">';
                                        echo '<div class="team-img">';
                                            echo '<i class="' . esc_attr( $member['icon'] ) . '" style="font-size: 80px; color: #6c757d;"></i>';
                                        echo '</div>';
                                        echo '<div class="team-content">';
                                            echo '<h4 class="team-title">' . esc_html( $member['name'] ) . '</h4>';
                                            echo '<p class="team-degi">' . esc_html( $member['role'] ) . '</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<!-- End Single Team Member -->';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            echo '<!-- End Home Team Members Section -->';
        }
    }

    if( ! function_exists( 'techbiz_blog_postexcerpt_read_content_cb') ) {
        function techbiz_blog_postexcerpt_read_content_cb( ) {
            if( class_exists( 'ReduxFramework' ) ) {
                $techbiz_excerpt_length = techbiz_opt('techbiz_blog_postExcerpt');
            } else {
                $techbiz_excerpt_length = '24';
            }
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );

            if( class_exists( 'ReduxFramework' ) ) {
                $techbiz_blog_admin = techbiz_opt( 'techbiz_blog_post_author' );
                $techbiz_blog_readmore_setting_val = techbiz_opt('techbiz_blog_readmore_setting');
                if( $techbiz_blog_readmore_setting_val == 'custom' ) {
                    $techbiz_blog_readmore_setting = techbiz_opt('techbiz_blog_custom_readmore');
                } else {
                    $techbiz_blog_readmore_setting = __( 'Read More', 'techbiz' );
                }
            } else {
                $techbiz_blog_readmore_setting = __( 'Read More', 'techbiz' );
                $techbiz_blog_admin = true;
            }

            echo '<!-- Post Summary -->';
                echo techbiz_paragraph_tag( array(
                    "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $techbiz_excerpt_length, '' ), $allowhtml ),
                    "class" => 'blog-text',
                ) );
            echo '<!-- End Post Summary -->';

            if( $techbiz_blog_admin || !empty( $techbiz_blog_readmore_setting ) ){
                if( !empty( $techbiz_blog_readmore_setting ) ){
                    echo '<!-- Button -->';
                        echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn">'.esc_html( $techbiz_blog_readmore_setting ).' <i class="fal fa-long-arrow-right"></i></a>';
                    echo '<!-- End Button -->';
                }
            }
        }
    }