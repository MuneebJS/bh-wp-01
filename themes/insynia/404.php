<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Insynia
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'insynia' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'insynia' ); ?></p>

                <div class="error-404-content">
                    <div class="widget-area">
                        <div class="widget">
                            <h3><?php esc_html_e( 'Search the site', 'insynia' ); ?></h3>
                            <?php get_search_form(); ?>
                        </div>

                        <?php if ( insynia_categorized_blog() ) : ?>
                        <div class="widget">
                            <h3><?php esc_html_e( 'Most Used Categories', 'insynia' ); ?></h3>
                            <ul>
                                <?php
                                wp_list_categories( array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                ) );
                                ?>
                            </ul>
                        </div><!-- .widget -->
                        <?php endif; ?>

                        <div class="widget">
                            <h3><?php esc_html_e( 'Recent Posts', 'insynia' ); ?></h3>
                            <ul>
                                <?php
                                $recent_posts = wp_get_recent_posts( array(
                                    'numberposts' => 5,
                                    'post_status' => 'publish',
                                ) );
                                foreach ( $recent_posts as $post ) :
                                    ?>
                                    <li>
                                        <a href="<?php echo get_permalink( $post['ID'] ); ?>">
                                            <?php echo $post['post_title']; ?>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div><!-- .widget -->

                        <div class="widget">
                            <h3><?php esc_html_e( 'Archives', 'insynia' ); ?></h3>
                            <ul>
                                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                            </ul>
                        </div><!-- .widget -->

                        <div class="widget">
                            <h3><?php esc_html_e( 'Get in Touch', 'insynia' ); ?></h3>
                            <p><?php esc_html_e( 'If you\'re still having trouble finding what you\'re looking for, please don\'t hesitate to contact us.', 'insynia' ); ?></p>
                            <div class="cta-buttons">
                                <?php
                                $primary_cta_text = get_theme_mod( 'insynia_primary_cta_text', 'Start Free Trial' );
                                $primary_cta_url = get_theme_mod( 'insynia_primary_cta_url', '#' );
                                $secondary_cta_text = get_theme_mod( 'insynia_secondary_cta_text', 'Contact Sales' );
                                $secondary_cta_url = get_theme_mod( 'insynia_secondary_cta_url', '#' );
                                ?>
                                <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="btn btn-secondary">
                                    <?php echo esc_html( $secondary_cta_text ); ?>
                                </a>
                                <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="btn btn-primary">
                                    <?php echo esc_html( $primary_cta_text ); ?>
                                </a>
                            </div>
                        </div><!-- .widget -->

                    </div><!-- .widget-area -->
                </div><!-- .page-content -->
            </header><!-- .error-404 -->

    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();

/**
 * Returns true if a blog has more than 1 category.
 */
function insynia_categorized_blog() {
    $category_count = get_transient( 'insynia_categories' );

    if ( false === $category_count ) {
        // Create an array of all the categories that are attached to posts.
        $categories = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $category_count = count( $categories );

        set_transient( 'insynia_categories', $category_count );
    }

    return $category_count > 1;
}