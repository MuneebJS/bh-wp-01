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

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $techbiz_post_id = get_the_ID();

            // Get the page settings manager
            $techbiz_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $techbiz_page_settings_model = $techbiz_page_settings_manager->get_model( $techbiz_post_id );

            // Retrieve the color we added before
            $techbiz_header_style = $techbiz_page_settings_model->get_settings( 'techbiz_header_style' );
            $techbiz_header_builder_option = $techbiz_page_settings_model->get_settings( 'techbiz_header_builder_option' );

            if( $techbiz_header_style == 'header_builder'  ) {

                if( !empty( $techbiz_header_builder_option ) ) {
                    $techbizheader = get_post( $techbiz_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $techbizheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $techbiz_header_builder_trigger = techbiz_opt('techbiz_header_options');
                if( $techbiz_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $techbiz_global_header_select = get_post( techbiz_opt( 'techbiz_header_select_options' ) );
                    $header_post = get_post( $techbiz_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    techbiz_global_header_option();
                }
            }
        } else {
            $techbiz_header_options = techbiz_opt('techbiz_header_options');
            if( $techbiz_header_options == '1' ) {
                techbiz_global_header_option();
            } else {
                $techbiz_header_select_options = techbiz_opt('techbiz_header_select_options');
                $techbizheader = get_post( $techbiz_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $techbizheader->ID );
                echo '</header>';
            }
        }
    } else {
        techbiz_global_header_option();
    }