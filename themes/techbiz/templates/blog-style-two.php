<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

echo '<!-- Single Post -->';
?>
<div <?php post_class(); ?> data-overlay="dark" data-opacity="7" data-bg-src="<?php echo get_the_post_thumbnail_url();?>" >
<?php

    // Blog Post Content
    do_action( 'techbiz_blog_post_content' );


    // Excerpt And Read More Button
    do_action( 'techbiz_blog_postexcerpt_read_content' );

echo '</div>';
echo '<!-- End Single Post -->';