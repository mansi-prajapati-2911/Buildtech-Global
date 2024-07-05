<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php
		/**
		 * The woocommerce_review_before hook
		 *
		 * @hooked woocommerce_review_display_gravatar - 10
		 */
		//do_action( 'woocommerce_review_before', $comment );
		?>

		<div class="comment-text psg-custom-review-comment-wrp">
			<div class="psg-custom-review-comment-left-meta">
				
				<?php		

				$attachment_id = get_user_meta( $comment->user_id, 'image1', true );
				if ( !empty( $attachment_id ) ) {

					$original_image_url = wp_get_attachment_url( $attachment_id );


					// Display Image instead of URL
					echo wp_get_attachment_image( $attachment_id, 'full');
				?>

				<?php

				} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-683-10-my-account.jpg">

				<?php
					   } ?>
				
			</div>	
			<div class="psg-custom-review-comment-text">
				<?php
			/**
			 * The woocommerce_review_before_comment_meta hook.
			 *
			 * @hooked woocommerce_review_display_rating - 10
			 */

			/**
			 * The woocommerce_review_meta hook.
			 *
			 * @hooked woocommerce_review_display_meta - 10
			 */
			do_action( 'woocommerce_review_meta', $comment );
			
			do_action( 'woocommerce_review_before_comment_meta', $comment );

			do_action( 'woocommerce_review_before_comment_text', $comment );

			/**
			 * The woocommerce_review_comment_text hook
			 *
			 * @hooked woocommerce_review_display_comment_text - 10
			 */
			?>
			<?php
			do_action( 'woocommerce_review_comment_text', $comment );

			do_action( 'woocommerce_review_after_comment_text', $comment );
			?>
			</div>	

		</div>
	</div>
