    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="container">

                <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="footer-widgets">
                    <div class="footer-widget-row">

                        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <div class="footer-widget-col">
                            <?php dynamic_sidebar( 'footer-1' ); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div class="footer-widget-col">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <div class="footer-widget-col">
                            <?php dynamic_sidebar( 'footer-3' ); ?>
                        </div>
                        <?php endif; ?>

                    </div><!-- .footer-widget-row -->
                </div><!-- .footer-widgets -->
                <?php endif; ?>

                <div class="footer-bottom">
                    <div class="footer-info">
                        <div class="copyright">
                            <p>&copy; <?php echo date( 'Y' ); ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <?php bloginfo( 'name' ); ?>
                                </a>.
                                <?php esc_html_e( 'All rights reserved.', 'insynia' ); ?>
                            </p>
                        </div><!-- .copyright -->

                        <?php if ( has_nav_menu( 'footer' ) ) : ?>
                        <nav class="footer-navigation">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer',
                                    'menu_id'        => 'footer-menu',
                                    'menu_class'     => 'footer-menu',
                                    'container'      => false,
                                    'depth'          => 1,
                                    'fallback_cb'    => false,
                                )
                            );
                            ?>
                        </nav><!-- .footer-navigation -->
                        <?php endif; ?>

                    </div><!-- .footer-info -->
                </div><!-- .footer-bottom -->

            </div><!-- .container -->
        </div><!-- .footer-container -->
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>