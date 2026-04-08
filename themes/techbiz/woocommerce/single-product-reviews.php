<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div class="woocommerce-Reviews">
	<div class="vs-comments-wrap" id="comments">

		<?php if ( have_comments() ) : ?>
			<ul class="comment-list ">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ul>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'techbiz' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div class="vs-comment-form comment-form-layout1">
			<div class="review-form" id="review_form">
				<?php
                $commenter    = wp_get_current_commenter();
                $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
                $aria_req = ( $req ? "required='required'" : '' );
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'techbiz' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'techbiz' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'techbiz' ),
					'title_reply_before'  => '<h3 class="form-title">',
					'title_reply_after'   => '</h3>',
					'comment_notes_after' => '',
					'class_submit'        => 'vs-btn',
					'submit_field'        => '<div class="form-group">%1$s %2$s</div>',
					'submit_button'       => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">'.esc_html__('Post Review','techbiz').'</button>',
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$comment_form['fields'] = array();
				$comment_form['fields']['author'] = '<div class="row"><div class="col-md-6 form-group"><input class="form-control" type="text" name="author" placeholder="'. esc_attr__( 'Your Name', 'techbiz' ) .'" value="'. esc_attr( $commenter['comment_author'] ).'" '.wp_kses_post( $aria_req ).'></div>';
				$comment_form['fields']['email'] = '<div class="col-md-6 form-group"><input class="form-control" type="email" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" placeholder="'. esc_attr__( 'Your E-mail', 'techbiz' ) .'" '.wp_kses_post( $aria_req ).'></div></div>';

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'techbiz' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}
				if ( wc_review_ratings_enabled() && !is_user_logged_in() ) {
					$comment_form['comment_field'] = '<div class="rating-select"><label for="rating">' . esc_html__( 'Your Rating', 'techbiz' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'techbiz' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'techbiz' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'techbiz' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'techbiz' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'techbiz' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'techbiz' ) . '</option>
					</select></div>';
				}
				if ( wc_review_ratings_enabled() && is_user_logged_in() ) {
					$comment_form['comment_field'] = '<div class="rating-select"><label for="rating">' . esc_html__( 'Your Rating', 'techbiz' ) . '</label><select name="rating" id="rating" required>
                    <option value="">' . esc_html__( 'Rate&hellip;', 'techbiz' ) . '</option>
                    <option value="5">' . esc_html__( 'Perfect', 'techbiz' ) . '</option>
                    <option value="4">' . esc_html__( 'Good', 'techbiz' ) . '</option>
                    <option value="3">' . esc_html__( 'Average', 'techbiz' ) . '</option>
                    <option value="2">' . esc_html__( 'Not that bad', 'techbiz' ) . '</option>
                    <option value="1">' . esc_html__( 'Very poor', 'techbiz' ) . '</option>
                </select></div>';
				}
				$comment_form['comment_field'] .= '<div class="form-group"><textarea placeholder="'.esc_attr__('Write your review','techbiz').'" class="form-control" id="comment" name="comment" required></textarea></div>';
				$comment_form['fields']['cookies']  = '<div class="custom-checkbox"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . wp_kses_post( $consent ) . ' /><label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.','techbiz' ) . '<span class="checkmark"></span></label></div>';
				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'techbiz' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>