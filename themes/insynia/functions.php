<?php
/**
 * @Package     : Insynia
 * @Version    : 1.0.0
 * @Author     : Custom Theme
 * @Author URI : #
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define theme constants
 */
define( 'INSYNIA_VERSION', '1.0.0' );
define( 'INSYNIA_DIR_PATH', get_template_directory() );
define( 'INSYNIA_DIR_URI', get_template_directory_uri() );
define( 'INSYNIA_ASSETS_URI', INSYNIA_DIR_URI . '/assets' );
define( 'INSYNIA_CSS_URI', INSYNIA_ASSETS_URI . '/css' );
define( 'INSYNIA_JS_URI', INSYNIA_ASSETS_URI . '/js' );
define( 'INSYNIA_IMG_URI', INSYNIA_ASSETS_URI . '/img' );

/**
 * Theme setup function
 */
function insynia_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'insynia', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Enable support for HTML5 markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Set up the WordPress core custom background feature
    add_theme_support( 'custom-background', apply_filters( 'insynia_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'insynia' ),
        'footer'  => esc_html__( 'Footer Menu', 'insynia' ),
    ) );

    // Add image sizes
    add_image_size( 'insynia-blog-thumb', 400, 300, true );
    add_image_size( 'insynia-blog-large', 800, 500, true );
}
add_action( 'after_setup_theme', 'insynia_theme_setup' );

/**
 * Set the content width
 */
function insynia_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'insynia_content_width', 1200 );
}
add_action( 'after_setup_theme', 'insynia_content_width', 0 );

/**
 * Register widget area
 */
function insynia_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'insynia' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'insynia' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 1', 'insynia' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here for footer area 1.', 'insynia' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 2', 'insynia' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here for footer area 2.', 'insynia' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 3', 'insynia' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here for footer area 3.', 'insynia' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'insynia_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function insynia_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style( 'insynia-style', get_stylesheet_uri(), array(), INSYNIA_VERSION );

    // Enqueue custom CSS if it exists
    if ( file_exists( INSYNIA_DIR_PATH . '/assets/css/main.css' ) ) {
        wp_enqueue_style( 'insynia-main-css', INSYNIA_CSS_URI . '/main.css', array('insynia-style'), INSYNIA_VERSION );
    }

    // Enqueue navigation script
    wp_enqueue_script( 'insynia-navigation', INSYNIA_JS_URI . '/navigation.js', array(), INSYNIA_VERSION, true );

    // Enqueue main theme script
    if ( file_exists( INSYNIA_DIR_PATH . '/assets/js/main.js' ) ) {
        wp_enqueue_script( 'insynia-main-js', INSYNIA_JS_URI . '/main.js', array('jquery'), INSYNIA_VERSION, true );
    }

    // Enqueue comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'insynia_scripts' );

/**
 * Custom template tags for this theme
 */

/**
 * Display navigation to next/previous posts
 */
function insynia_post_navigation() {
    $next_post = get_next_post();
    $prev_post = get_previous_post();

    if ( $next_post || $prev_post ) {
        echo '<nav class="post-navigation">';

        if ( $prev_post ) {
            echo '<div class="nav-previous">';
            echo '<a href="' . get_permalink( $prev_post->ID ) . '">';
            echo '<span class="meta-nav">' . esc_html__( 'Previous Post', 'insynia' ) . '</span>';
            echo '<span class="post-title">' . get_the_title( $prev_post->ID ) . '</span>';
            echo '</a>';
            echo '</div>';
        }

        if ( $next_post ) {
            echo '<div class="nav-next">';
            echo '<a href="' . get_permalink( $next_post->ID ) . '">';
            echo '<span class="meta-nav">' . esc_html__( 'Next Post', 'insynia' ) . '</span>';
            echo '<span class="post-title">' . get_the_title( $next_post->ID ) . '</span>';
            echo '</a>';
            echo '</div>';
        }

        echo '</nav>';
    }
}

/**
 * Display posted on date
 */
function insynia_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x( 'Posted on %s', 'post date', 'insynia' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Display post author
 */
function insynia_posted_by() {
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x( 'by %s', 'post author', 'insynia' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Custom excerpt length
 */
function insynia_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'insynia_custom_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function insynia_excerpt_more( $more ) {
    return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'insynia' )
    );
}
add_filter( 'excerpt_more', 'insynia_excerpt_more' );

/**
 * Customizer additions
 */
function insynia_customize_register( $wp_customize ) {
    // Add CTA Section
    $wp_customize->add_section( 'insynia_cta_section', array(
        'title'    => __( 'Call to Action Buttons', 'insynia' ),
        'priority' => 30,
    ) );

    // Primary CTA Button Text
    $wp_customize->add_setting( 'insynia_primary_cta_text', array(
        'default'           => 'Start Free Trial',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'insynia_primary_cta_text', array(
        'label'   => __( 'Primary CTA Button Text', 'insynia' ),
        'section' => 'insynia_cta_section',
        'type'    => 'text',
    ) );

    // Primary CTA Button URL
    $wp_customize->add_setting( 'insynia_primary_cta_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'insynia_primary_cta_url', array(
        'label'   => __( 'Primary CTA Button URL', 'insynia' ),
        'section' => 'insynia_cta_section',
        'type'    => 'url',
    ) );

    // Secondary CTA Button Text
    $wp_customize->add_setting( 'insynia_secondary_cta_text', array(
        'default'           => 'Contact Sales',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'insynia_secondary_cta_text', array(
        'label'   => __( 'Secondary CTA Button Text', 'insynia' ),
        'section' => 'insynia_cta_section',
        'type'    => 'text',
    ) );

    // Secondary CTA Button URL
    $wp_customize->add_setting( 'insynia_secondary_cta_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'insynia_secondary_cta_url', array(
        'label'   => __( 'Secondary CTA Button URL', 'insynia' ),
        'section' => 'insynia_cta_section',
        'type'    => 'url',
    ) );
}
add_action( 'customize_register', 'insynia_customize_register' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}