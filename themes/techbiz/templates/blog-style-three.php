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

echo '<!-- Single Post -->';
?>
<div <?php post_class(); ?> >
<?php

    if( class_exists('ReduxFramework') ) {
        $techbiz_display_post_date      =  techbiz_opt( 'techbiz_display_post_date' );
        $techbiz_display_post_views     =  techbiz_opt( 'techbiz_display_post_views' );
    } else {
        $techbiz_display_post_date      = '1';
        $techbiz_display_post_views     = '';
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

    // Blog Post Thumbnail
    do_action( 'techbiz_blog_post_thumb' );

    echo '<div class="blog-content">';

        if( ! is_single() ){
            echo '<!-- Post Title -->';
            echo '<h4 class="blog-title fw-semibold"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title(), $allowhtml ).'</a></h4>';
            echo '<!-- End Post Title -->';
        }

        echo '<div class="blog-meta">';
            if( $techbiz_display_post_date ){
                echo '<span class="pr-15"><a href="'.esc_url( techbiz_blog_date_permalink() ).'">';
                    echo '<time datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time>';
                echo '</a></span>';
            }
            if( $techbiz_display_post_views ){
                echo '<span class="pr-15">';
                echo techbiz_getPostViews( get_the_ID() );
                echo esc_html__( ' Views', 'techbiz' );
                echo '</span>';
            }
        echo '</div>';

    echo '</div>';
echo '</div>';
echo '<!-- End Single Post -->';