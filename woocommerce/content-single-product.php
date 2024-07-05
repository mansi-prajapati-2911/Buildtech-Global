<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce , $product;

$tags = wp_get_post_terms( get_the_id(), 'product_tag' );
$meta = get_post_meta( get_the_id(), 'video_fields', true ); 
?>
<div class="psg-single-product-top">
	
<div class="woocommerce-breadcrumbs">
	<?php the_breadcrumb(); ?>
</div>

<?php
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>
	<div class="psg-single-product-main-section">
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-custom-wrap', $product ); ?>>

			<?php
			/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary psg-single-product-main">


				<?php
				/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
				do_action( 'woocommerce_single_product_summary' );
				?>	

				<input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>">
				<div class="single-product-upper">

					<div class="psg-socials-sharing-wrapper">
						<span class="psg-single-product-share-label">Share:</span>	
						<div class="psg-socials-sharing-list">
							<a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink())); ?>" class="social icon-facebook" target="_blank">
								<i class="fab fa-facebook-f"></i>
							</a>
							<a href="<?php echo esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.urlencode(get_permalink())); ?>" class="social icon-twitter" target="_blank">
								<i class="fab fa-twitter"></i>
							</a>
							<a href="<?php echo esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title())); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" class="social icon-linkedin" target="_blank">
								<i class="fab fa-linkedin-in"></i>
							</a>
							<a href="<?php echo esc_url('http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title())); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" class="social icon-pinterest" target="_blank">
								<i class="fab fa-pinterest-p"></i>
							</a>
							<a href="<?php echo esc_url('https://api.whatsapp.com/send?text='.urlencode(get_permalink())); ?>" class="social icon-twitter" target="_blank">
								<i class="fab fa-whatsapp"></i>
							</a>

							<p class="custom-social-link-copy" id="p1"><?php the_permalink(); ?></p>
							<button class="custom-social-link-btn single-product-social-link-btn" onclick="copyToClipboard('#p1')"><i class="fal fa-link"></i>
								<span class="hover-tooltip">
									<a href="#" data-toggle="tooltip" data-placement="right" title="Copied">
									</a></span>
							</button>
						</div>

						<?php 
						// 			$user_id = get_current_user_id(); 
						// 			$oldvalue = get_user_meta( $user_id, 'wishlist', true ); 
						// 			$values = array_values($oldvalue);
						//$valueString = implode(',', $values);

						$classs = "";
						if(!empty($oldvalue)){
							if(in_array(get_the_ID(),$oldvalue)){
								$classs="added";
							}
						}

						?>	

						<input type="hidden" id="wishlist_old_val" value="<?php echo $valueString; ?>">
						<div id="wishlist-icon-main" class="wishlist-icon-main"> 
							<button id="whislist_single_icon_wrp" class="wishlist-icon <?php echo $classs; ?> wishlist_<?php echo get_the_ID(); ?>" data-id="<?php echo get_the_ID(); ?>"><i class="fal fa-heart"></i></button>
						</div>	

					</div>		

					<div class="psg-sp-category-wrp">
						<span class="psg-sp-cat-label"><?php esc_html_e( 'Categories:', 'woocommerce' ); ?></span>	
						<span class="psg-sp-cat-list">
							<?php echo wc_get_product_category_list( $product->get_id() , "  "); ?>
						</span>
					</div>

					<?php if($tags){ ?>
					<div class="psg-sp-category-wrp">
						<span class="psg-sp-cat-label"><?php esc_html_e( 'Tags:', 'woocommerce' ); ?></span>	
						<span class="psg-sp-cat-list">
							<?php
									foreach ( $tags as $tag ) {
										$tag_link = get_tag_link( $tag->term_id);
										echo '<a href="'. $tag_link .'">' . $tag->name .'</a>';
									}
							?>
						</span>
					</div>
					<?php } ?>

				</div>

				<?php
				/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
				do_action( 'woocommerce_after_single_product_summary' );
				?>
			</div>

			<?php 

			if(isset($meta['video_members_button_url']) && !empty($meta['video_members_button_url'])){ 
				$porduct_video = $meta['video_members_button_url'];
			?>

			<div class="psg-video-section-wrp">
				<?php 
				$args = ['width' => 1170];
				$embed = wp_oembed_get( $porduct_video, $args );
				if ( ! $embed ) {
					$embed = $GLOBALS['wp_embed']->shortcode( $args, $porduct_video );
				}else{
					echo $embed;
				} 
				?>
			</div>
			<?php } ?>

		</div>
	</div>	
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<?php echo do_shortcode( '[elementor-template id="388"]' ); ?>