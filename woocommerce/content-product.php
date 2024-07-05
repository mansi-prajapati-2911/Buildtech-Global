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
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'psg-product-archive-list', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<div class="psg-archive-img-upper">
		
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	
	do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		
	<div class="psg-archive-icon">	

	<a href="#" id="sp-wqv-view-button" class="button sp-wqv-view-button after_add_to_cart" data-id="<?php echo $product->get_id(); ?>" data-effect="mfp-move-from-top" data-wqv="{&quot;close_button&quot;: 1, &quot;lightbox&quot;: 0,&quot;preloader&quot;: 1,&quot;preloader_label&quot;: &quot;Loading...&quot; } "><i class="fal fa-eye"></i></a>	
		
	    <?php
		
		$product_id_cart = get_product(get_the_ID());
		echo sprintf( '<a href="%s" data-quantity="1" class="%s" %s><i class="fal fa-cart-plus"></i></a>',
					 esc_url( $product_id_cart->add_to_cart_url() ),
					 esc_attr( implode( ' ', array_filter( array(
						 'button psg-custom-add-to-cart-btn', 'product_type_' . $product_id_cart->get_type(),
						 $product_id_cart->is_purchasable() && $product_id_cart->is_in_stock() ? 'add_to_cart_button' : '',
						 $product_id_cart->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
					 ) ) ) ),
					 wc_implode_html_attributes( array(
						 'data-product_id'  => $product_id_cart->get_id(),
						 'data-product_sku' => $product_id_cart->get_sku(),
						 'aria-label'       => $product_id_cart->add_to_cart_description(),
						 'rel'              => 'nofollow',
					 ) ),
					 esc_html( $product_id_cart->add_to_cart_text() )
					); ?>

		<?php	$user_id = get_current_user_id(); 
		$oldvalue = get_user_meta( $user_id, 'wishlist', true ); 
		$classs = "";
		if(!empty($oldvalue)){
			if(in_array(get_the_ID(),$oldvalue)){
				$classs="added";
			}
		}
		?>
	<a class="add_to_wishlist <?php echo $classs; ?> wishlist_<?php echo $product->get_id(); ?>" data-id="<?php echo $product->get_id(); ?>" ><i class="fal fa-heart"></i></a>
	
		</div>
				
	</div>		
	
	<div class="psg-product-archive-bottom">

		<p class="psg-product-archive-category"><?php echo wc_get_product_category_list( $product->get_id(), ' , ', ); ?></p>
		<?php

		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		?>

		<a href="<?php the_permalink(); ?>">
			<?php
			do_action( 'woocommerce_shop_loop_item_title' ); ?>

			<?php
			/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>

		</a>		 		 
	</div>
</li>