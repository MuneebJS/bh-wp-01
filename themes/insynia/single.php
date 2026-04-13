<?php
/**
 * The template for displaying all single posts
 *
 * @package Insynia
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail-single">
                        <?php the_post_thumbnail( 'insynia-blog-large', array( 'alt' => get_the_title() ) ); ?>
                    </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                        <div class="entry-meta">
                            <?php
                            insynia_posted_on();
                            insynia_posted_by();
                            ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content( sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'insynia' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ) );

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'insynia' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php
                        $categories_list = get_the_category_list( esc_html__( ', ', 'insynia' ) );
                        if ( $categories_list ) {
                            printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'insynia' ) . '</span>', $categories_list );
                        }

                        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'insynia' ) );
                        if ( $tags_list ) {
                            printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'insynia' ) . '</span>', $tags_list );
                        }
                        ?>
                    </footer><!-- .entry-footer -->

                </article><!-- #post-<?php the_ID(); ?> -->

                <?php insynia_post_navigation(); ?>

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