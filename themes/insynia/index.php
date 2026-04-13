<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Insynia
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">

        <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="content-area">
            <div class="content-wrapper">

                <?php if ( have_posts() ) : ?>

                    <?php if ( is_home() && is_front_page() ) : ?>
                        <!-- Hero Section for Front Page -->
                        <section class="hero-section">
                            <div class="hero-content">
                                <h1 class="hero-title">
                                    <?php
                                    $site_title = get_bloginfo( 'name' );
                                    if ( $site_title ) {
                                        echo esc_html( $site_title );
                                    } else {
                                        echo esc_html__( 'Welcome to Insynia', 'insynia' );
                                    }
                                    ?>
                                </h1>
                                <p class="hero-description">
                                    <?php
                                    $site_description = get_bloginfo( 'description' );
                                    if ( $site_description ) {
                                        echo esc_html( $site_description );
                                    } else {
                                        echo esc_html__( 'A modern, minimalist SaaS-focused WordPress theme designed for businesses that want to make an impact.', 'insynia' );
                                    }
                                    ?>
                                </p>
                                <div class="hero-cta">
                                    <?php
                                    $primary_cta_text = get_theme_mod( 'insynia_primary_cta_text', 'Start Free Trial' );
                                    $primary_cta_url = get_theme_mod( 'insynia_primary_cta_url', '#' );
                                    $secondary_cta_text = get_theme_mod( 'insynia_secondary_cta_text', 'Contact Sales' );
                                    $secondary_cta_url = get_theme_mod( 'insynia_secondary_cta_url', '#' );
                                    ?>
                                    <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="btn btn-primary btn-large">
                                        <?php echo esc_html( $primary_cta_text ); ?>
                                    </a>
                                    <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="btn btn-secondary btn-large">
                                        <?php echo esc_html( $secondary_cta_text ); ?>
                                    </a>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Posts Loop -->
                    <?php if ( ! ( is_home() && is_front_page() ) || get_option( 'show_on_front' ) === 'posts' ) : ?>
                    <section class="posts-section">
                        <div class="posts-grid">
                            <?php
                            while ( have_posts() ) :
                                the_post();
                                ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'insynia-blog-thumb', array( 'alt' => get_the_title() ) ); ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>

                                    <div class="post-content">
                                        <header class="entry-header">
                                            <?php
                                            if ( is_singular() ) :
                                                the_title( '<h1 class="entry-title">', '</h1>' );
                                            else :
                                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                            endif;
                                            ?>

                                            <div class="entry-meta">
                                                <?php
                                                insynia_posted_on();
                                                insynia_posted_by();
                                                ?>
                                            </div><!-- .entry-meta -->
                                        </header><!-- .entry-header -->

                                        <div class="entry-content">
                                            <?php
                                            if ( is_singular() ) :
                                                the_content();
                                            else :
                                                the_excerpt();
                                            endif;
                                            ?>
                                        </div><!-- .entry-content -->

                                    </div><!-- .post-content -->

                                </article><!-- #post-<?php the_ID(); ?> -->

                                <?php
                            endwhile;
                            ?>
                        </div><!-- .posts-grid -->

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            <?php
                            the_posts_pagination( array(
                                'mid_size'  => 2,
                                'prev_text' => __( '&larr; Previous', 'insynia' ),
                                'next_text' => __( 'Next &rarr;', 'insynia' ),
                            ) );
                            ?>
                        </div>
                    </section>
                    <?php endif; ?>

                <?php else : ?>

                    <section class="no-results">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Nothing here', 'insynia' ); ?></h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                                <p>
                                    <?php
                                    printf(
                                        wp_kses(
                                            /* translators: 1: link to WP admin new post page. */
                                            __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'insynia' ),
                                            array(
                                                'a' => array(
                                                    'href' => array(),
                                                ),
                                            )
                                        ),
                                        esc_url( admin_url( 'post-new.php' ) )
                                    );
                                    ?>
                                </p>
                            <?php elseif ( is_search() ) : ?>
                                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'insynia' ); ?></p>
                                <?php get_search_form(); ?>
                            <?php else : ?>
                                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'insynia' ); ?></p>
                                <?php get_search_form(); ?>
                            <?php endif; ?>
                        </div><!-- .page-content -->
                    </section>

                <?php endif; ?>

            </div><!-- .content-wrapper -->

            <?php if ( is_active_sidebar( 'sidebar-1' ) && ! is_front_page() ) : ?>
            <aside id="secondary" class="widget-area">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </aside><!-- #secondary -->
            <?php endif; ?>

        </div><!-- .content-area -->

    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();