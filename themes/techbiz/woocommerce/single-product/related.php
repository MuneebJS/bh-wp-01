<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     10.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$techbiz_woo_relproduct_display = techbiz_opt('techbiz_woo_relproduct_display');

if ( $related_products && $techbiz_woo_relproduct_display) : ?>

	<section class="related-products-wrap">
		<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related products', 'techbiz' ) );

			if ( $heading ) :
		?>
			<h3 class="related-products-title">
				<?php echo esc_html( $heading ); ?>
			</h3>
		<?php endif;?>
		<div class="row related-product-slider" >
	        <?php
	            if( class_exists('ReduxFramework') ) {
	                $techbiz_woo_related_product_col = techbiz_opt('techbiz_woo_related_product_col');
	            } else{
	                $techbiz_woo_related_product_col = '4';
	            }
	        ?>

			<?php foreach ( $related_products as $related_product ) : ?>
                <div class="col-md-6 col-lg-4">
                    <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product' );
                    ?>
                </div>
			<?php endforeach; ?>
		</div>
	</section>

<?php endif;

wp_reset_postdata();