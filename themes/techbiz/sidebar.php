<?php

/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */


// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}

if ( ! is_active_sidebar( 'techbiz-blog-sidebar' ) ) {
    return;
}
?>

<div class="col-lg-4">
    <div class="sidebar-area sticky-sidebar mt-50 mt-lg-0">
    <?php dynamic_sidebar( 'techbiz-blog-sidebar' ); ?>
    </div>
</div>