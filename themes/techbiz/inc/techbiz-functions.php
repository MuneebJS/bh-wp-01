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
    exit;
}

 // theme option callback
function techbiz_opt( $id = null, $url = null ){
    global $techbiz_opt;

    if( $id && $url ){

        if( isset( $techbiz_opt[$id][$url] ) && $techbiz_opt[$id][$url] ){
            return $techbiz_opt[$id][$url];
        }
    }else{
        if( isset( $techbiz_opt[$id] )  && $techbiz_opt[$id] ){
            return $techbiz_opt[$id];
        }
    }
}


// theme logo
function techbiz_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= techbiz_img_tag( array(
            "class" => "img-fluid logo-img",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !techbiz_opt('techbiz_text_title') && techbiz_opt('techbiz_site_logo', 'url' )  ){

        $siteLogo = '<img class="img-fluid logo-img" src="'.esc_url( techbiz_opt('techbiz_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'techbiz' ).'" />';
        return '<a class="logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';


    }elseif( techbiz_opt('techbiz_text_title') ){
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( techbiz_opt('techbiz_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// Techbiz Coming Soon Logo
function techbiz_coming_soon_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    // site logo
    if( techbiz_opt( 'techbiz_coming_logo', 'url' )  ){

        $siteLogo = '<img src="'.esc_url( techbiz_opt('techbiz_coming_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'techbiz' ).'" />';

        return '<a class="logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';

    }elseif( techbiz_opt('techbiz_coming_site_title') ){
        return '<h2 class="mb-0"><a class="text-logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( techbiz_opt('techbiz_coming_site_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="text-logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// custom meta id callback
function techbiz_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_techbiz_'.$id, true );
    return $value;
}


// Blog Date Permalink
function techbiz_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function techbiz_iframe_match() {
    $audio_content = techbiz_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function techbiz_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function techbiz_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'techbiz' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'techbiz' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


// Data Background image attr
function techbiz_data_bg_attr( $imgUrl = '' ){
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
}

// image alt tag
function techbiz_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function techbiz_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function techbiz_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'techbiz_pingback_header' );


// Excerpt More
function techbiz_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'techbiz_excerpt_more' );


// techbiz comment template callback
function techbiz_comment_callback( $comment, $args, $depth ) {
        $add_below = 'comment';
    ?>
    <li <?php comment_class( array('vs-comment') ); ?>>
        <div id="comment-<?php comment_ID() ?>" class="vs-post-comment">
            <?php
                if( get_avatar( $comment, 110 )  ) :
            ?>
            <!-- Author Image -->
            <div class="comment-avater">
                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, 110 );
                    }
                ?>
            </div>
            <!-- Author Image -->
            <?php
                endif;
            ?>
            <!-- Comment Content -->
            <div class="comment-content">
                <span class="commented-on"> <?php printf( esc_html__('%1$s', 'techbiz'), get_comment_date() ); ?> </span>
                <h4 class="name h5"><?php echo esc_html( ucwords( get_comment_author() ) ); ?></h4>
                <?php comment_text(); ?>
                <div class="reply_and_edit">
                    <?php
                        comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => '<i class="fas fa-reply"></i>Reply' ) ) );
                    ?>
                    <span class="comment-edit-link pl-10"><?php edit_comment_link( '<i class="fas fa-pencil"></i>'.esc_html__( 'Edit', 'techbiz' ), '  ', '' ); ?></span>
                </div>

                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'techbiz' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Comment Content -->
<?php
}

//body class
add_filter( 'body_class', 'techbiz_body_class' );
function techbiz_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $techbiz_blog_single_sidebar = techbiz_opt('techbiz_blog_single_sidebar');
        if( ($techbiz_blog_single_sidebar != '2' && $techbiz_blog_single_sidebar != '3' ) || ! is_active_sidebar('techbiz-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    } else {
        if( !is_active_sidebar('techbiz-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    }
    return $classes;
}


function techbiz_footer_global_option(){

    // Techbiz Footer Bottom Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $techbiz_footer_bottom_active = techbiz_opt( 'techbiz_disable_footer_bottom' );
    }else{
        $techbiz_footer_bottom_active = '1';
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
    );

    if( $techbiz_footer_bottom_active == '1' ){
        echo '<!-- Footer -->';
        echo '<footer class="footer-wrapper footer-layout1">';

            if( $techbiz_footer_bottom_active == '1' ){
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
                echo '<div class="copyright-wrap">';
                    echo '<div class="container">';
                        echo '<div class="row align-items-center">';
                            if( ! empty( techbiz_opt( 'techbiz_copyright_text' ) ) ){
                                echo '<p class="copyright-text">'.wp_kses( techbiz_opt( 'techbiz_copyright_text' ), $allowhtml ).'</p>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        echo '</footer>';
        echo '<!-- End Footer -->';
    }
}

function techbiz_social_icon(){
    $techbiz_social_icon = techbiz_opt( 'techbiz_social_links' );
    if( ! empty( $techbiz_social_icon ) && isset( $techbiz_social_icon ) ){
        foreach( $techbiz_social_icon as $social_icon ){
            if( ! empty( $social_icon['title'] ) ){
                echo '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i>'.esc_html( $social_icon['description'] ).'</a>';
            }
        }
    }
}

// global header
function techbiz_global_header_option() {
    techbiz_global_header();
    echo '<header class="vs-header header-layout1 header-default">';
        echo '<div class="sticky-active py-3 py-lg-0">';
            echo '<div class="container position-relative">';
                echo '<div class="row align-items-center justify-content-between">';
                    echo '<div class="col-auto align-self-center">';
                        echo '<div class="header-logo">';
                            echo techbiz_theme_logo();
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-auto">';
                        if( has_nav_menu( 'primary-menu' ) ){
                            echo '<nav class="main-menu menu-style1 d-none d-lg-block">';
                                wp_nav_menu( array(
                                    "theme_location"    => 'primary-menu',
                                    "container"         => '',
                                    "menu_class"        => ''
                                ) );
                            echo '</nav>';
                        }
                        echo '<!-- Mobile Menu Toggler -->';
                        echo '<button class="vs-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>';
                    echo '</div>';
                    echo '<div class="col-auto">';
                        echo '<form action="'.esc_url( home_url() ).'" class="header-search">';
                            echo '<input name="s" required type="text" placeholder="'.esc_attr__( 'Search here...','techbiz' ).'">';
                            echo '<button type="submit" aria-label="search-button"><i class="far fa-search"></i></button>';
                        echo '</form>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        if( ! empty( techbiz_opt( 'techbiz_notice_text' ) ) ){
            echo '<div class="header-notice d-none d-md-block">';
                echo '<div class="container">';
                    echo '<p class="mb-0 fs-xs text-title">'.esc_html( techbiz_opt( 'techbiz_notice_text' ) ).'</p>';
                echo '</div>';
            echo '</div>';
        }
    echo '</header>';

}

// Techbiz Default Header
if( ! function_exists( 'techbiz_global_header' ) ){
    function techbiz_global_header(){
        // Mobile Menu
        echo '<div class="vs-menu-wrapper">';
            echo '<div class="vs-menu-area">';
                echo '<button class="vs-menu-toggle"><i class="fal fa-times"></i></button>';
                echo '<div class="mobile-logo">';
                    echo techbiz_theme_logo();
                echo '</div>';
                if( has_nav_menu( 'mobile-menu' ) ){
                    echo '<div class="vs-mobile-menu link-inherit">';
                        wp_nav_menu( array(
                            "theme_location"    => 'mobile-menu',
                            "container"         => '',
                            "menu_class"        => ''
                        ) );
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';
    }
}

// techbiz woocommerce breadcrumb
function techbiz_woo_breadcrumb( $args ) {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcumb-menu text-white pt-1">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'techbiz' ),
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'techbiz_woo_breadcrumb' );

function techbiz_custom_search_form( $class ) {
    echo '<!-- Search Form -->';
    echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'" class="'.esc_attr( $class ).'">';
        echo '<label class="searchIcon">';
            echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'techbiz').'">';
        echo '</label>';
    echo '</form>';
    echo '<!-- End Search Form -->';
}



//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'techbiz_remove_tagcloud_inline_style',10,1 );
function techbiz_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

// password protected form
add_filter('the_password_form','techbiz_password_form',10,1);
function techbiz_password_form( $output ) {
    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post"><div class="theme-input-group">
        <input name="post_password" type="password" class="theme-input-style" placeholder="'.esc_attr__( 'Enter Password','techbiz' ).'">
        <button type="submit" class="submit-btn btn-fill">'.esc_html__( 'Enter','techbiz' ).'</button></div></form>';
    return $output;
}

function techbiz_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function techbiz_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'techbiz' );
    }
    return $count;
}


/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'techbiz_cat_count_span' );
function techbiz_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'techbiz_archive_count_span' );
function techbiz_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">(', $links);
    $links = str_replace(')', ')</span>', $links);
	return $links;
}


if( ! function_exists( 'techbiz_blog_category' ) ){
    function techbiz_blog_category(){
        if( class_exists( 'ReduxFramework' ) ){
            $techbiz_display_post_category =  techbiz_opt('techbiz_display_post_category');
        }else{
            $techbiz_display_post_category = '1';
        }

        if( $techbiz_display_post_category ){
            $techbiz_post_categories = get_the_category();
            if( is_array( $techbiz_post_categories ) && ! empty( $techbiz_post_categories ) ){
                if( techbiz_opt( 'techbiz_blog_style' ) == '2' ){
                    $padding_class = 'mb-20';
                }else{
                    $padding_class = '';
                }
                echo '<div class="blog-category '.esc_attr( $padding_class ).'">';
                    echo ' <a href="'.esc_url( get_term_link( $techbiz_post_categories[0]->term_id ) ).'">'.esc_html( $techbiz_post_categories[0]->name ).'</a> ';
                echo '</div>';
            }
        }
    }
}

// Add Extra Class On Comment Reply Button
function techbiz_custom_comment_reply_link( $content ) {
    $extra_classes = 'replay-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'techbiz_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function techbiz_custom_edit_comment_link( $content ) {
    $extra_classes = 'replay-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'techbiz_custom_edit_comment_link', 99);


function techbiz_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        if( ! is_single() ){
            if( techbiz_opt( 'techbiz_blog_style' ) == '3' ){
                $classes[] = "vs-blog blog-grid grid-wide";
            }else{
                $classes[] = "vs-blog blog-single";
            }
        }else{
            $classes[] = "vs-blog blog-single";
        }
    }elseif( get_post_type() === 'product' ){
        // Return Class
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }

    return $classes;
}
add_filter( 'post_class', 'techbiz_post_classes', 10, 3 );


function techbiz_megamenu_add_theme_techbiz_1751547629($themes) {
    $themes["techbiz_1751547629"] = array(
        'title' => 'Techbiz',
        'container_background_from' => 'rgb(255,255,255)',
        'container_background_to' => 'rgb(255,255,255)',
        'arrow_up' => 'dash-f343',
        'arrow_down' => 'dash-f347',
        'arrow_left' => 'dash-f341',
        'arrow_right' => 'dash-f345',
        'close_icon_color' => 'rgb(255,255,255)',
        'menu_item_background_from' => 'transparent',
        'menu_item_background_to' => 'transparent',
        'menu_item_background_hover_from' => 'rgb(255,255,255)',
        'menu_item_background_hover_to' => 'rgb(255,255,255)',
        'menu_item_link_font_size' => '16px',
        'menu_item_link_height' => '110px',
        'menu_item_link_color' => 'rgb(0,0,0)',
        'menu_item_link_weight' => 'inherit',
        'menu_item_link_color_hover' => 'rgb(0,116,255)',
        'menu_item_link_weight_hover' => 'inherit',
        'menu_item_link_padding_left' => '15px',
        'menu_item_link_padding_right' => '15px',
        'menu_item_border_color' => 'rgb(255,255,255)',
        'menu_item_border_color_hover' => 'rgb(255,255,255)',
        'menu_item_highlight_current' => 'off',
        'menu_item_divider_color' => 'rgba(0,0,0,0.1)',
        'panel_background_from' => 'rgb(255,255,255)',
        'panel_background_to' => 'rgb(255,255,255)',
        'panel_width' => '',
        'panel_inner_width' => '',
        'panel_border_color' => 'rgb(221,221,221)',
        'panel_border_radius_bottom_left' => '5px',
        'panel_border_radius_bottom_right' => '5px',
        'panel_header_color' => 'rgb(0,116,255)',
        'panel_header_border_color' => 'rgb(0,116,255)',
        'panel_header_border_color_hover' => 'transparent',
        'panel_header_border_right' => '5px',
        'panel_header_border_bottom' => '1px',
        'panel_widget_padding_left' => '20px',
        'panel_widget_padding_right' => '20px',
        'panel_widget_padding_top' => '20px',
        'panel_widget_padding_bottom' => '20px',
        'panel_font_size' => '16px',
        'panel_font_color' => 'rgb(255,255,255)',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => 'rgb(0,116,255)',
        'panel_second_level_font_color_hover' => 'rgb(0,116,255)',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'inherit',
        'panel_second_level_font_weight_hover' => 'inherit',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_background_hover_from' => 'transparent',
        'panel_second_level_background_hover_to' => 'transparent',
        'panel_second_level_padding_bottom' => '10px',
        'panel_second_level_margin_bottom' => '15px',
        'panel_second_level_border_color' => 'rgb(0,116,255)',
        'panel_second_level_border_color_hover' => 'rgb(0,116,255)',
        'panel_second_level_border_bottom' => '1px',
        'panel_third_level_font_color' => 'rgb(0,0,0)',
        'panel_third_level_font_color_hover' => 'rgb(0,116,255)',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '16px',
        'panel_third_level_font_weight' => 'inherit',
        'panel_third_level_font_weight_hover' => 'inherit',
        'panel_third_level_background_hover_from' => 'transparent',
        'panel_third_level_background_hover_to' => 'transparent',
        'panel_third_level_padding_top' => '4px',
        'panel_third_level_padding_bottom' => '3px',
        'panel_third_level_border_color' => 'transparent',
        'panel_third_level_border_color_hover' => 'transparent',
        'flyout_width' => '200px',
        'flyout_menu_background_from' => 'rgb(255,255,255)',
        'flyout_menu_background_to' => 'rgb(255,255,255)',
        'flyout_border_color' => 'rgb(255,255,255)',
        'flyout_border_radius_bottom_left' => '5px',
        'flyout_border_radius_bottom_right' => '5px',
        'flyout_menu_item_divider_color' => 'rgba(255,255,255,0.1)',
        'flyout_padding_top' => '9px',
        'flyout_padding_right' => '7px',
        'flyout_padding_bottom' => '9px',
        'flyout_padding_left' => '7px',
        'flyout_link_padding_left' => '9px',
        'flyout_link_padding_right' => '9px',
        'flyout_link_padding_top' => '2px',
        'flyout_link_padding_bottom' => '2px',
        'flyout_link_weight' => 'inherit',
        'flyout_link_weight_hover' => 'inherit',
        'flyout_link_height' => '26px',
        'flyout_background_from' => 'rgb(255,255,255)',
        'flyout_background_to' => 'rgb(255,255,255)',
        'flyout_background_hover_from' => 'rgb(255,255,255)',
        'flyout_background_hover_to' => 'rgb(255,255,255)',
        'flyout_link_size' => '16px',
        'flyout_link_color' => 'rgb(0,0,0)',
        'flyout_link_color_hover' => 'rgb(0,116,255)',
        'flyout_link_family' => 'inherit',
        'responsive_breakpoint' => '991px',
        'line_height' => '26px',
        'z_index' => '9999',
        'shadow' => 'on',
        'shadow_vertical' => '5px',
        'shadow_blur' => '10px',
        'shadow_color' => 'rgba(0,0,0,0.1)',
        'transitions' => 'on',
        'keyboard_highlight_color' => 'rgb(16,156,222)',
        'toggle_background_from' => 'rgb(34,34,34)',
        'toggle_background_to' => 'rgb(34,34,34)',
        'mobile_background_from' => 'rgb(34,34,34)',
        'mobile_background_to' => 'rgb(34,34,34)',
        'mobile_menu_item_link_font_size' => '14px',
        'mobile_menu_item_link_color' => 'rgb(255,255,255)',
        'mobile_menu_item_link_text_align' => 'left',
        'mobile_menu_item_link_color_hover' => 'rgb(255,255,255)',
        'mobile_menu_item_background_hover_from' => 'rgb(51,51,51)',
        'mobile_menu_item_background_hover_to' => 'rgb(51,51,51)',
        'disable_mobile_toggle' => 'on',
        'custom_css' => '/** Push menu onto new line **/
#{$wrap} {
    clear: both;
	z-index:99;
	font-family:\"Exo\";
	font-weight:600;
}
#{$wrap} #mega-menu-primary-menu li.mega-menu-item-has-children > a.mega-menu-link > span.mega-indicator  {
	margin:0px!important
}
.rtl {
    #{$wrap} #{$menu} {
		>li.mega-menu-megamenu>ul.mega-sub-menu>li.mega-menu-item,
		>li.mega-menu-megamenu>ul.mega-sub-menu li.mega-menu-column>ul.mega-sub-menu>li.mega-menu-item {
		  float: right;
		}
		>li.mega-menu-megamenu>ul.mega-sub-menu>li.mega-menu-item>a.mega-menu-link,
		>li.mega-menu-megamenu>ul.mega-sub-menu li.mega-menu-column>ul.mega-sub-menu>li.mega-menu-item>a.mega-menu-link,
		>li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
		>li.mega-menu-megamenu>ul.mega-sub-menu>li.mega-menu-item li.mega-menu-item>a.mega-menu-link,
		>li.mega-menu-megamenu>ul.mega-sub-menu li.mega-menu-column>ul.mega-sub-menu>li.mega-menu-item li.mega-menu-item>a.mega-menu-link {
		  text-align: right;
		}
    }
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "techbiz_megamenu_add_theme_techbiz_1751547629");