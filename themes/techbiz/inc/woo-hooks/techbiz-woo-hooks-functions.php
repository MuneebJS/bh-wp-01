<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Playrex
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

// techbiz gallery image size hook functions
add_filter('woocommerce_gallery_image_size','techbiz_woocommerce_gallery_image_size');
function techbiz_woocommerce_gallery_image_size( $imagesize ) {
    $imagesize = 'techbiz-shop-single';
    return $imagesize;
}

// techbiz shop main content hook functions
if( !function_exists('techbiz_shop_main_content_cb') ) {
    function techbiz_shop_main_content_cb( ) {
        $techbiz_shop_page_bg = techbiz_opt('techbiz_shop_page_bg');
        $techbiz_single_shop_page_bg = techbiz_opt('techbiz_single_shop_page_bg');
        
        if(!empty($techbiz_shop_page_bg['url'])){
          $shop_bg =   $techbiz_shop_page_bg['url'];
        }else{
          $shop_bg =   '';
        }

        if(!empty($techbiz_single_shop_page_bg['url'])){
          $single_shop_bg =   $techbiz_single_shop_page_bg['url'];
        }else{
          $single_shop_bg =   '';
        }
        
        

        if( is_shop() || is_product_category() || is_product_tag() ) {
            echo '<section class="space-top  space-extra-bottom background-image" style="background-image: url('. $shop_bg .')">';
            if( class_exists('ReduxFramework') ) {
                $techbiz_woo_product_col = techbiz_opt('techbiz_woo_product_col');
                if( $techbiz_woo_product_col == '2' ) {
                    echo '<div class="container">';
                } elseif( $techbiz_woo_product_col == '3' ) {
                    echo '<div class="container">';
                } elseif( $techbiz_woo_product_col == '4' ) {
                    echo '<div class="container">';
                } elseif( $techbiz_woo_product_col == '5' ) {
                    echo '<div class="techbiz-container">';
                } elseif( $techbiz_woo_product_col == '6' ) {
                    echo '<div class="techbiz-container">';
                }
            } else {
                echo '<div class="container">';
            }
        } else {
            echo '<section class="vs-product-wrapper product-details space-top space-extra-bottom background-image" style="background-image: url('. $single_shop_bg .')">';
                echo '<div class="container">';
        }
        echo '<div class="row justify-content-center">';
    }
}

// techbiz shop main content hook function
if( !function_exists('techbiz_shop_main_content_end_cb') ) {
    function techbiz_shop_main_content_end_cb( ) {
            echo '</div>';
        echo '</div>';
    echo '</section>';
    }
}

// shop column start hook function
if( !function_exists('techbiz_shop_col_start_cb') ) {
    function techbiz_shop_col_start_cb( ) {
        if( class_exists('ReduxFramework') ) {
            if( class_exists('woocommerce') && is_shop() ) {
                $techbiz_woo_shoppage_sidebar = techbiz_opt('techbiz_woo_shoppage_sidebar');
                if( $techbiz_woo_shoppage_sidebar == '2' && is_active_sidebar('techbiz-woo-sidebar') ) {
                    echo '<div class="col-lg-8 col-xl-8 order-last">';
                } elseif( $techbiz_woo_shoppage_sidebar == '3' && is_active_sidebar('techbiz-woo-sidebar') ) {
                    echo '<div class="col-lg-8 col-xl-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            } else {
                echo '<div class="col-lg-12">';
            }
        } else {
            if( class_exists('woocommerce') && is_shop() ) {
                if( is_active_sidebar('techbiz-woo-sidebar') ) {
                    echo '<div class="col-lg-8 col-xl-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            } else {
                echo '<div class="col-lg-12">';
            }
        }

    }
}

// shop column end hook function
if( !function_exists('techbiz_shop_col_end_cb') ) {
    function techbiz_shop_col_end_cb( ) {
        echo '</div>';
    }
}

// techbiz woocommerce pagination hook function
if( ! function_exists('techbiz_woocommerce_pagination') ) {
    function techbiz_woocommerce_pagination( ) {
        if( ! empty( techbiz_pagination() ) ) {
            echo '<div class="vs-pagination text-center mt-30">';
                echo '<ul>';
                    $prev 	= '<i class="fas fa-chevron-left"></i>';
                    $next 	= '<i class="fas fa-chevron-right"></i>';
                    // previous
                    if( get_previous_posts_link() ){
                        echo '<li>';
                        previous_posts_link( $prev );
                        echo '</li>';
                    }
                    echo techbiz_pagination();
                    // next
                    if( get_next_posts_link() ){
                        echo '<li>';
                        next_posts_link( $next );
                        echo '</li>';
                    }
                echo '</ul>';
            echo '</div>';
        }
    }
}


// woocommerce tab content wrapper start hook function
if( ! function_exists('techbiz_woocommerce_tab_content_wrapper_start') ) {
    function techbiz_woocommerce_tab_content_wrapper_start( ) {
        echo '<!-- Tab Content -->';
        echo '<div class="tab-content" id="nav-tabConten">';
    }
}

// woocommerce tab content wrapper start hook function
if( ! function_exists('techbiz_woocommerce_tab_content_wrapper_end') ) {
    function techbiz_woocommerce_tab_content_wrapper_end( ) {
        echo '</div>';
        echo '<!-- End Tab Content -->';
    }
}

// techbiz grid tab content hook function
if( !function_exists('techbiz_grid_tab_content_cb') ) {
    function techbiz_grid_tab_content_cb( ) {
        echo '<!-- Grid -->';
            woocommerce_product_loop_start();
                if( class_exists('ReduxFramework') ) {
                    $techbiz_woo_product_col = techbiz_opt('techbiz_woo_product_col');
                    if( $techbiz_woo_product_col == '2' ) {
                        $techbiz_woo_product_col_val = 'col-lg-6 col-sm-6';
                    } elseif( $techbiz_woo_product_col == '3' ) {
                        $techbiz_woo_product_col_val = 'col-xl-4 col-lg-4 col-sm-6';
                    } elseif( $techbiz_woo_product_col == '4' ) {
                        $techbiz_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6';
                    }elseif( $techbiz_woo_product_col == '5' ) {
                        $techbiz_woo_product_col_val = 'col-xl col-lg-4 col-sm-6';
                    } elseif( $techbiz_woo_product_col == '6' ) {
                        $techbiz_woo_product_col_val = 'col-lg-2 col-sm-6';
                    }
                } else {
                    $techbiz_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 ';
                }

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        echo '<div class="'.esc_attr( $techbiz_woo_product_col_val ).'">';
                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );

                        echo '</div>';
                    }
                    wp_reset_postdata();
                }

                woocommerce_product_loop_end();
        echo '<!-- End Grid -->';
    }
}

// techbiz list tab content hook function
if( !function_exists('techbiz_list_tab_content_cb') ) {
    function techbiz_list_tab_content_cb( ) {
        echo '<!-- List -->';
        echo '<div class="tab-pane" id="tab-list">';
            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();
                    
                }
                wp_reset_postdata();
            }

            woocommerce_product_loop_end();
        echo '</div>';
        echo '<!-- End List -->';
    }
}

// techbiz woocommerce get sidebar hook function
if( ! function_exists('techbiz_woocommerce_get_sidebar') ) {
    function techbiz_woocommerce_get_sidebar( ) {
        if( class_exists('ReduxFramework') ) {
            $techbiz_woo_shoppage_sidebar = techbiz_opt('techbiz_woo_shoppage_sidebar');
        } else {
            if( is_active_sidebar('techbiz-woo-sidebar') ) {
                $techbiz_woo_shoppage_sidebar = '2';
            } else {
                $techbiz_woo_shoppage_sidebar = '1';
            }
        }

        if( is_shop() ) {
            if( $techbiz_woo_shoppage_sidebar != '1' ) {
                get_sidebar('shop');
            }
        }
    }
}

// techbiz loop product thumbnail hook function
if( !function_exists('techbiz_loop_product_thumbnail') ) {
    function techbiz_loop_product_thumbnail( ) {
        global $product;

        if( $product->is_on_sale() && $product->get_type() == 'simple' ) {
            echo '<div class="onsale product-tag1">'.esc_html__( 'Sale', 'techbiz' ).'</div>';
        }
        if( $product->is_featured() ) {
            echo '<div class="featured woocommerce-badge product-tag1">'.esc_html__( 'Hot', 'techbiz' ).'</div>';
        }
        if( ! $product->is_in_stock() ) {
            echo '<div class="outofstock woocommerce-badge product-tag1">'.esc_html__( 'Stock Out', 'techbiz' ).'</div>';
        }

        echo '<div class="product-img">';
            echo '<a href="'.esc_url( get_permalink() ).'">';
                if( has_post_thumbnail() ){
                    echo '<img src="'.esc_url( get_the_post_thumbnail_url() ).'" alt="'.esc_attr( techbiz_img_default_alt(  get_the_post_thumbnail_url() )).'" >';
                }
                if( ! empty( techbiz_meta( 'product_swap_image', 'url' ) ) ){
                    echo techbiz_img_tag( array(
                        'url'   => esc_url( techbiz_meta( 'product_swap_image', 'url' ) ),
                        'class' => 'w-100 img_swap',
                    ) );
                }
            echo '</a>';

            echo '<div class="actions">';
                // Cart Button
                woocommerce_template_loop_add_to_cart();
            echo '</div>';
        echo '</div>';
    }
}

// shop loop product summary
if( ! function_exists('techbiz_loop_product_summary') ) {
    function techbiz_loop_product_summary( ) {
        global $product;
        echo '<div class="product-content">';
            // Product Title
            echo '<h3 class="product-name"><a class="text-inherit" href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title() ).'</a></h3>';
            // Product Price

            echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="product-category">' . _n( '', '', count( $product->get_category_ids() ), 'techbiz' ) . ' ', '</div>' );

            echo '<span class="product-price">';
                // Product Price
                echo woocommerce_template_loop_price();
            echo '</span>';
            // Product Rating
            

        echo '</div>';
    }
}

// shop loop horizontal product summary
if( ! function_exists( 'techbiz_horizontal_loop_product_summary' ) ) {
    function techbiz_horizontal_loop_product_summary() {
        global $product;
        echo '<div class="product-content d-xl-flex align-items-center">';
            echo '<div>';
                woocommerce_template_loop_rating();
                // Product Title
                echo '<h4 class="product-title h5 mb-1"><a href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title() ).'</a></h4>';
                // Product Price
                echo woocommerce_template_loop_price();
            echo '</div>';
        echo '</div>';
    }
}

// before single product summary hook
if( ! function_exists('techbiz_woocommerce_before_single_product_summary') ) {
    function techbiz_woocommerce_before_single_product_summary( ) {

        global $post,$product;

        $attachments = $product->get_gallery_image_ids();

        if( $attachments ){
            $slider_class = "product-big-img product-img-slide";
        }else{
            $slider_class = "product-big-img";
        }
        // woocommerce_show_product_images();
        echo '<div class="'.esc_attr( $slider_class ).'">';

            if( $attachments ){
                $x = 0;
                foreach( $attachments as $single_image ){
                    $image_url = wp_get_attachment_image_url( $single_image, 'techbiz-shop-single' );
                    echo '<div>';
                        echo techbiz_img_tag( array(
                            'url'   => esc_url( wp_get_attachment_image_url( $attachments[$x], 'techbiz-shop-single' ) ),
                            'class' => 'w-100',
                        ) );
                    echo '</div>';
                    $x++;
                }
            }elseif( has_post_thumbnail() ){
                the_post_thumbnail( 'techbiz-shop-single', [ 'class' => 'w-100', ] );
            }
        echo '</div>';
    }
}

// single product price rating hook function
if( !function_exists('techbiz_woocommerce_single_product_price_rating') ) {
    function techbiz_woocommerce_single_product_price_rating() {
        global $product;
        
        echo '<!-- Product Price -->';
        woocommerce_template_single_price();
        
    }
}

// single product title hook function
if( !function_exists('techbiz_woocommerce_single_product_title') ) {
    function techbiz_woocommerce_single_product_title( ) {
        
        global $product;
        
        echo '<div class="product-rating">';
            // Product Rating
            woocommerce_template_loop_rating();
            
            $average_rating = $product->get_average_rating();
            if( ! empty( $average_rating ) ){
                echo esc_html( $average_rating );
            }else{
                echo esc_html__( 'There Are no reviews yet.' );
            }
        echo '</div>';
        
        if( class_exists( 'ReduxFramework' ) ) {
            $producttitle_position = techbiz_opt('techbiz_product_details_title_position');
        } else {
            $producttitle_position = 'header';
        }

        if( $producttitle_position != 'header' ) {
            echo '<!-- Product Title -->';
            echo '<h3 class="product-title mb-1">'.esc_html( get_the_title() ).'</h3>';
            echo '<!-- End Product Title -->';
        }
    }
}

// single product title hook function
if( !function_exists('techbiz_woocommerce_quickview_single_product_title') ) {
    function techbiz_woocommerce_quickview_single_product_title( ) {
        echo '<!-- Product Title -->';
        echo '<h3 class="product-title mb-1">'.esc_html( get_the_title() ).'</h3>';
        echo '<!-- End Product Title -->';
    }
}

// single product excerpt hook function
if( !function_exists('techbiz_woocommerce_single_product_excerpt') ) {
    function techbiz_woocommerce_single_product_excerpt( ) {
        echo '<!-- Product Description -->';
        woocommerce_template_single_excerpt();
        echo '<!-- End Product Description -->';
    }
}

// single product availability hook function
if( !function_exists('techbiz_woocommerce_single_product_availability') ) {
    function techbiz_woocommerce_single_product_availability( ) {
        global $product;
        $availability = $product->get_availability();

        if( class_exists( 'ReduxFramework' ) ){
            $techbiz_stock_quantity = techbiz_opt( 'techbiz_woo_stock_quantity_show_hide' );
        }else{
            $techbiz_stock_quantity = 1;
        }

        if( $techbiz_stock_quantity ){
            if( $availability['class'] != 'out-of-stock' ) {
                echo '<!-- Product Availability -->';
                    echo '<div class="stock-product">';
                        echo '<strong class="stock-title">'.esc_html__( 'Availability:', 'techbiz' ).'</strong>';
                        if( $product->get_stock_quantity() ){
                            echo '<span class="stock in-stock"><i class="far fa-check-square"></i>'.esc_html( $product->get_stock_quantity() ).'</span>';
                        }else{
                            echo '<span class="stock in-stock"><i class="far fa-check-square"></i>'.esc_html__( 'In Stock', 'techbiz' ).'</span>';
                        }
                    echo '</div>';
                echo '<!--End Product Availability -->';
            } else {
                echo '<!-- Product Availability -->';
                echo '<div class="product-stock">';
                    echo '<strong class="stock-title">'.esc_html__( 'Availability:', 'techbiz' ).'</strong>';
                    echo '<span class="stock out-of-stock"><i class="far fa-check-square"></i>'.esc_html__( 'Out Of Stock', 'techbiz' ).'</span>';
                echo '</div>';
                echo '<!--End Product Availability -->';
            }
        }
    }
}

// single product add to cart fuunction
if( !function_exists('techbiz_woocommerce_single_add_to_cart_button') ) {
    function techbiz_woocommerce_single_add_to_cart_button( ) {
        woocommerce_template_single_add_to_cart();
    }
}

// single product ,eta hook function
if( !function_exists('techbiz_woocommerce_single_meta') ) {
    function techbiz_woocommerce_single_meta( ) {
        global $product;
        echo '<div class="product_meta">';
            if( ! empty( $product->get_sku() ) ){
                echo '<span class="sku_wrapper">'.esc_html__( 'SKU:', 'techbiz' ).'<span class="sku">'.$product->get_sku().'</span></span>';
            }
            echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'techbiz' ) . ' ', '</span>' );
        echo '</div>';
    }
}

// single produt sidebar hook function
if( !function_exists('techbiz_woocommerce_single_product_sidebar_cb') ) {
    function techbiz_woocommerce_single_product_sidebar_cb(){
        if( class_exists('ReduxFramework') ) {
            $techbiz_woo_singlepage_sidebar = techbiz_opt('techbiz_woo_singlepage_sidebar');
            if( ( $techbiz_woo_singlepage_sidebar == '2' || $techbiz_woo_singlepage_sidebar == '3' ) && is_active_sidebar('techbiz-woo-sidebar') ) {
                get_sidebar('shop');
            }
        } else {
            if( is_active_sidebar('techbiz-woo-sidebar') ) {
                get_sidebar('shop');
            }
        }
    }
}

// reviewer meta hook function
if( !function_exists('techbiz_woocommerce_reviewer_meta') ) {
    function techbiz_woocommerce_reviewer_meta( $comment ){
        $verified = wc_review_is_from_verified_owner( $comment->comment_ID );
        if ( '0' === $comment->comment_approved ) { ?>
            <em class="woocommerce-review__awaiting-approval">
                <?php esc_html_e( 'Your review is awaiting approval', 'techbiz' ); ?>
            </em>

        <?php } else { ?>
            <div class="comment-author">
                <h4 class="name h5"><?php echo ucwords( get_comment_author() ); ?> </h4>
                <span class="commented-on"><time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"> <?php printf( esc_html__('%1$s at %2$s', 'techbiz'), get_comment_date(wc_date_format()),  get_comment_time() ); ?> </time></span>
            </div>
                <?php
                if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                    echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'techbiz' ) . ')</em> ';
                }

                ?>
        <?php
        }

        woocommerce_review_display_rating();
    }
}

// woocommerce proceed to checkout hook function
if( !function_exists('techbiz_woocommerce_button_proceed_to_checkout') ) {
    function techbiz_woocommerce_button_proceed_to_checkout() {
        echo '<a href="'.esc_url( wc_get_checkout_url() ).'" class="checkout-button button alt wc-forward vs-btn">';
            esc_html_e( 'Proceed to checkout', 'techbiz' );
        echo '</a>';
    }
}

// techbiz woocommerce cross sell display hook function
if( !function_exists('techbiz_woocommerce_cross_sell_display') ) {
    function techbiz_woocommerce_cross_sell_display( ){
        woocommerce_cross_sell_display();
    }
}

// techbiz minicart view cart button hook function
if( !function_exists('techbiz_minicart_view_cart_button') ) {
    function techbiz_minicart_view_cart_button() {
        echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button checkout wc-forward vs-btn style1">' . esc_html__( 'View cart', 'techbiz' ) . '</a>';
    }
}

// techbiz minicart checkout button hook function
if( !function_exists('techbiz_minicart_checkout_button') ) {
    function techbiz_minicart_checkout_button() {
        echo '<a href="' .esc_url( wc_get_checkout_url() ) . '" class="button wc-forward vs-btn style1">' . esc_html__( 'Checkout', 'techbiz' ) . '</a>';
    }
}

// techbiz woocommerce before checkout form
if( !function_exists('techbiz_woocommerce_before_checkout_form') ) {
    function techbiz_woocommerce_before_checkout_form() {
        echo '<div class="row">';
            if ( ! is_user_logged_in() && 'yes' === get_option('woocommerce_enable_checkout_login_reminder') ) {
                echo '<div class="col-lg-12">';
                    woocommerce_checkout_login_form();
                echo '</div>';
            }

            echo '<div class="col-lg-12">';
                woocommerce_checkout_coupon_form();
            echo '</div>';
        echo '</div>';
    }
}

// add to cart button
function woocommerce_template_loop_add_to_cart( $args = array() ) {
    global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'vs-btn',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = wp_parse_args( $args, $defaults );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s %s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'vs-btn' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '<i class="far fa-shopping-cart"></i>',
            'Add To Cart'
        );
}

function woocommerce_template_loop_add_to_cart_class_change( $args = array() ) {
    global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'product-cart-btn',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = wp_parse_args( $args, $defaults );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'product-cart-btn' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '<i class="fal fa-cart-plus"></i>'
        );
}

// add to cart button two
function woocommerce_template_loop_add_to_cart_two( $args = array() ) {
    global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'vs-btn style4 cart-btn',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = wp_parse_args( $args, $defaults );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'vs-btn style4 cart-btn' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '<i class="fal fa-cart-plus"></i> Add To Cart'
        );
}

// add to cart button Three
function woocommerce_template_loop_add_to_cart_three( $args = array() ) {
    global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'product-cart-btn',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = wp_parse_args( $args, $defaults );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'product-cart-btn' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            'Add to Basket <i class="fal fa-cart-plus"></i> '
        );
}

// add to cart button Four
function woocommerce_template_loop_add_to_cart_four( $args = array() ) {
    global $product;

		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'product-cart-btn',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = wp_parse_args( $args, $defaults );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'product-cart-btn' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            'Add to Cart'
        );
}

// product searchform
add_filter( 'get_product_search_form' , 'techbiz_custom_product_searchform' );
function techbiz_custom_product_searchform( $form ) {

    $form = '<form class="search-form" role="search" method="get" action="' . esc_url( home_url( '/'  ) ) . '">
        <label class="screen-reader-text" for="s">' . __( 'Search for:', 'techbiz' ) . '</label>
        <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search', 'techbiz' ) . '" />
        <button class="submit-btn" type="submit"><i class="far fa-search"></i></button>
        <input type="hidden" name="post_type" value="product" />
    </form>';

    return $form;
}

// cart empty message
add_action('woocommerce_cart_is_empty','techbiz_wc_empty_cart_message',10);
function techbiz_wc_empty_cart_message( ) {
    echo '<h3 class="cart-empty d-none">'.esc_html__('Your cart is currently empty.','techbiz').'</h3>';
}