<?php
/**
 * The template for displaying search results pages
 *
 * @package Insynia
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">

        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query. */
                    esc_html__( 'Search Results for: %s', 'insynia' ),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>

            <div class="content-area">
                <div class="posts-section">
                    <div class="posts-grid">

                        <?php while ( have_posts() ) : the_post(); ?>

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
                                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                                        <div class="entry-meta">
                                            <?php
                                            insynia_posted_on();
                                            insynia_posted_by();
                                            ?>
                                        </div><!-- .entry-meta -->
                                    </header><!-- .entry-header -->

                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div><!-- .entry-content -->
                                </div><!-- .post-content -->

                            </article><!-- #post-<?php the_ID(); ?> -->

                        <?php endwhile; ?>

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

                </div><!-- .posts-section -->
            </div><!-- .content-area -->

        <?php else : ?>

            <section class="no-results">
                <div class="page-content">
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'insynia' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </section>

        <?php endif; ?>

    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();