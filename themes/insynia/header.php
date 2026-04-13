<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'insynia' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="container">
                <div class="header-inner">

                    <!-- Logo/Site Branding -->
                    <div class="site-branding">
                        <?php
                        the_custom_logo();
                        if ( is_front_page() && is_home() ) :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php
                        else :
                            ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                            <?php
                        endif;
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) :
                            ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->

                    <!-- Primary Navigation -->
                    <nav id="site-navigation" class="main-navigation">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <span class="hamburger"></span>
                            <span class="hamburger"></span>
                            <span class="hamburger"></span>
                            <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'insynia' ); ?></span>
                        </button>

                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'primary-menu',
                                'fallback_cb'    => 'insynia_fallback_menu',
                            )
                        );
                        ?>
                    </nav><!-- #site-navigation -->

                    <!-- Call to Action Buttons -->
                    <div class="header-cta">
                        <?php
                        // Get customizer options for CTA buttons
                        $primary_cta_text = get_theme_mod( 'insynia_primary_cta_text', 'Start Free Trial' );
                        $primary_cta_url = get_theme_mod( 'insynia_primary_cta_url', '#' );
                        $secondary_cta_text = get_theme_mod( 'insynia_secondary_cta_text', 'Contact Sales' );
                        $secondary_cta_url = get_theme_mod( 'insynia_secondary_cta_url', '#' );
                        ?>

                        <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="btn btn-secondary cta-secondary">
                            <?php echo esc_html( $secondary_cta_text ); ?>
                        </a>
                        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="btn btn-primary cta-primary">
                            <?php echo esc_html( $primary_cta_text ); ?>
                        </a>
                    </div><!-- .header-cta -->

                </div><!-- .header-inner -->
            </div><!-- .container -->
        </div><!-- .header-container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">

<?php
/**
 * Fallback menu if no menu is assigned
 */
function insynia_fallback_menu() {
    echo '<ul id="primary-menu" class="primary-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'insynia' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'About', 'insynia' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/pricing' ) ) . '">' . esc_html__( 'Pricing', 'insynia' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/blog' ) ) . '">' . esc_html__( 'Blog', 'insynia' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">' . esc_html__( 'Contact', 'insynia' ) . '</a></li>';
    echo '</ul>';
}