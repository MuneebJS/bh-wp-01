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

    techbiz_setPostViews( get_the_ID() );

    ?>
    <div <?php post_class(); ?> >
    <?php
        if( class_exists('ReduxFramework') ) {
            $techbiz_post_details_title_position = techbiz_opt('techbiz_post_details_title_position');
        } else {
            $techbiz_post_details_title_position = 'header';
        }

        $allowhtml = array(
            'p'         => array(
                'class'     => array()
            ),
            'span'      => array(),
            'a'         => array(
                'href'      => array(),
                'title'     => array(),
                'class'     => array(),
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'b'         => array(),
        );

        // Blog Post Thumbnail
        do_action( 'techbiz_blog_post_thumb' );

        echo '<div class="blog-content">';
            if( $techbiz_post_details_title_position != 'header' ) {
                echo '<h2 class="blog-title h1">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
            }
            // Blog Post Meta
            do_action( 'techbiz_blog_post_meta' );

            // Blog COntent
            the_content();
            // Link Pages
            techbiz_link_pages();

        echo '</div>';



        $techbiz_post_tag = get_the_tags();

        if( class_exists('ReduxFramework') ) {
            $techbiz_post_details_share_options = techbiz_opt('techbiz_post_details_share_options');
        } else {
            $techbiz_post_details_share_options = false;
        }

        if( ! empty( $techbiz_post_tag ) || ( function_exists( 'techbiz_social_sharing_buttons' ) && $techbiz_post_details_share_options ) ){
            echo '<!-- Share Links Area -->';
            echo '<div class="share-links clearfix">';
                echo '<div class="row align-items-xl-center">';
                    if( function_exists( 'techbiz_social_sharing_buttons' ) && $techbiz_post_details_share_options ){
                        $techbiz_tag_col = "col-md-5 d-sm-flex align-items-center";
                    }else{
                        $techbiz_tag_col = "col-sm-12 d-sm-flex align-items-center";
                    }
                    if( is_array( $techbiz_post_tag ) && ! empty( $techbiz_post_tag ) ){
                        echo '<div class="'.esc_attr( $techbiz_tag_col ).'">';
                            if( count( $techbiz_post_tag ) > 1 ){
                                $tag_text = __( 'Tags:', 'techbiz' );
                            }else{
                                $tag_text = __( 'Tag:', 'techbiz' );
                            }
                            echo '<span class="share-links-title">'.$tag_text.'</span>';
                            echo '<div class="tagcloud">';
                                foreach( $techbiz_post_tag as $tags ){
                                    echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    }
                    /**
                    *
                    * Hook for Blog Details Share Options
                    *
                    * Hook techbiz_blog_details_share_options
                    *
                    * @Hooked techbiz_blog_details_share_options_cb 10
                    *
                    */
                    do_action( 'techbiz_blog_details_share_options' );

                    echo '<!-- Share Links Area end -->';
                echo '</div>';
            echo '</div>';
        }
    echo '</div>';

    /**
    *
    * Hook for Blog Details Post Navigation Options
    *
    * Hook techbiz_blog_details_post_navigation
    *
    * @Hooked techbiz_blog_details_post_navigation_cb 10
    *
    */
    do_action( 'techbiz_blog_details_post_navigation' );

    /**
    *
    * Hook for Blog Details Author Bio
    *
    * Hook techbiz_blog_details_author_bio
    *
    * @Hooked techbiz_blog_details_author_bio_cb 10
    *
    */
    do_action( 'techbiz_blog_details_author_bio' );

    /**
    *
    * Hook for Blog Details Related Post
    *
    * Hook techbiz_blog_details_related_post
    *
    * @Hooked techbiz_blog_details_related_post_cb 10
    *
    */
    do_action( 'techbiz_blog_details_related_post' );

    /**
    *
    * Hook for Blog Details Comments
    *
    * Hook techbiz_blog_details_comments
    *
    * @Hooked techbiz_blog_details_comments_cb 10
    *
    */
    do_action( 'techbiz_blog_details_comments' );