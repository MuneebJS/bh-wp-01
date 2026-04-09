<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 * test changes
 */




    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $techbizerrortitle   = techbiz_opt( 'techbiz_fof_error_number' );
        $techbiz404title     = techbiz_opt( 'techbiz_fof_title' );
        $techbiz404subtitle  = techbiz_opt( 'techbiz_fof_subtitle' );
        $techbiz404btntext   = techbiz_opt( 'techbiz_fof_btn_text' );
    } else {
        $techbizerrortitle   = __( '404', 'techbiz' );
        $techbiz404title     = __( 'Ooops, Page Not Found', 'techbiz' );
        $techbiz404subtitle  = __( 'The page you\'ve requested is not available.', 'techbiz' );
        $techbiz404btntext   = __( 'Return To Home', 'techbiz' );
    }


    // get header
    get_header();

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
        'sup'       => array(),
        'sub'       => array(),
    );

    echo '<section class="vs-error-wrapper space">';
        echo '<div class="container">';
            echo '<div class="error-content text-center">';
                if( ! empty( $techbizerrortitle ) ){
                    echo '<h2 class="error-number">'.wp_kses( $techbizerrortitle, $allowhtml ).'</h2>';
                }
                if( ! empty( $techbiz404title ) ){
                    echo '<h3 class="error-title">'.esc_html( $techbiz404title ).'</h3>';
                }
                if( ! empty( $techbiz404subtitle ) ){
                    echo '<p class="error-text">'.esc_html( $techbiz404subtitle ).'</p>';
                }
                if( ! empty( $techbiz404btntext ) ){
                    echo '<a href="'.esc_url( home_url('/') ).'" class="vs-btn"><i class="fas fa-home ms-0 me-2"></i>'.esc_html( $techbiz404btntext ).'</a>';
                }
            echo '</div>';
        echo '</div>';
    echo '</section>';

    //footer
    get_footer();