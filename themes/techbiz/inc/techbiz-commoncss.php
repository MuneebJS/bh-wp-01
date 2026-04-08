<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

// enqueue css
function techbiz_common_custom_css(){
	wp_enqueue_style( 'techbiz-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = techbiz_opt( 'techbiz_css_editor' );
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";

    if( get_header_image() ){
        $techbiz_header_bg =  get_header_image();
    }else{
        if( techbiz_meta( 'page_breadcrumb_settings' ) == 'page' && is_page() ){
            if( ! empty( techbiz_meta( 'breadcumb_image' ) ) ){
                $techbiz_header_bg = techbiz_meta( 'breadcumb_image' );
            }
        }
    }

    if( !empty( $techbiz_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$techbiz_header_bg}')!important;
        }";
    }

	// theme color
	$techbizthemecolor = techbiz_opt('techbiz_theme_color');
	$preloadercolor    = techbiz_opt('techbiz_preloader_color');
	$preloadercolortwo = techbiz_opt('techbiz_preloader_color_two');

	if( !empty( $techbizthemecolor ) ) {
		$customcss .= ":root {
		  --theme-color: {$techbizthemecolor};
		}";
	}

	if( !empty( $preloadercolor ) ) {
		$customcss .= ".loader {
            --theme-color: {$preloadercolor};
		}";
	}

	if( !empty( $preloadercolortwo ) ) {
		$customcss .= ".loader {
            --title-color: {$preloadercolortwo};
		}";
	}

	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'techbiz-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'techbiz_common_custom_css', 100 );