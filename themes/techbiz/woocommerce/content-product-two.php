<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( array('vs-product','product-style1'), $product ); ?>>
	<?php
	
		if( has_post_thumbnail() ){
			echo '<div class="product-img">';
				echo '<a href="'.esc_url( get_the_permalink() ).'">';
					the_post_thumbnail( 'playrex-home-two-product-image' );
				echo '</a>';
			echo '</div>';
		}
		echo '<div class="product-content">';
			// product category
			echo '<div class="product-category">';
				echo wc_get_product_category_list( get_the_id() );
			echo '</div>';
			// product title
			if( get_the_title() ){
				echo '<h3 class="product-name"><a href="'.esc_url( get_the_permalink() ).'">'.esc_html( get_the_title() ).'</a></h3>';
			}
			// Product Price
			$rprice = $product->get_price_html();
			echo '<span class="product-price">'.$rprice.'</span>';
			// product rating
            woocommerce_template_loop_rating();
		echo '</div>';
	?>
</div>