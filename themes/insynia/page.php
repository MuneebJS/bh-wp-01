<?php
/**
 * The template for displaying all pages
 *
 * @package Insynia
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page' ); ?>>

                    <?php if ( has_post_thumbnail() && ! is_front_page() ) : ?>
                    <div class="page-thumbnail">
                        <?php the_post_thumbnail( 'insynia-blog-large', array( 'alt' => get_the_title() ) ); ?>
                    </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'insynia' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div><!-- .entry-content -->

                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>

        </div><!-- .content-area -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();