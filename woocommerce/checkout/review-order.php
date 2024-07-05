<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-checkout-review-order-table">
	<div class="psg-checkout-review-order-table-wrp">	
		<table class="psg-checkout-review-order-table woocommerce-checkout-review-order-table">
			<thead>
				<tr>
					<th class="product-name"><?php esc_html_e( 'Product Item', 'woocommerce' ); ?></th>
<!-- 					<th class="product-total"><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?></th> -->
				</tr>
			</thead>
			<tbody>
				<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$product_meta_data = $cart_item['data']->get_meta_data();
					foreach ($product_meta_data as $meta) {
							if ($meta->key === 'product_type_ostendo') {
								$my_custom_field_value = $meta->value;
								break;
							}
  						}
					echo $my_custom_field_value;
					$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$item_image = $_product->get_image( array( '50', '50' ), array( 'class' => 'psg_item_img' ) );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-name">
						<div class="psg-checkout-orders">

							<?php if($item_image){ 
					echo '<div class="psg-checkout-orders-img">' . $item_image . '</div>';
				} ?>

							<div class="psg-checkout-orders-detail-wrp">
								<div class="psg-checkout-orders-title">
									<?php 
						echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name',$_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;';?>
						<div class="psg-checkout-orders-quantity">			
					<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="product-quantity">' . sprintf( 'X&nbsp;%s', $cart_item['quantity'] ) . '</span>', $cart_item, 						$cart_item_key );?>
						</div>
								</div>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
							</div>

						</div>

					</td>
								

					<td class="product-total">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
					</td>
				</tr>
				<?php
					}
				}
				do_action( 'woocommerce_review_order_after_cart_contents' );
				?>
			</tbody>

		</table>
	</div>
	
	<ul class="psg-checkout-bottom">
		<li class="psg-checkout-coupon-code-wrp">
			<?php  echo '<tr class="coupon-form"><th colspan="2">';

			wc_get_template(
				'checkout/form-coupon.php',
				array(
					'checkout' => WC()->checkout(),
				)
			);
			echo '</tr></th>'; ?>
		</li>
		<li class="cart-subtotal">
			<h4 class="psg-checkout-form-label"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></h4>
			<p class="psg-checkout-form-text"><?php wc_cart_totals_subtotal_html(); ?></p>
		</li>
		
		<li>
			<h4 class="psg-checkout-form-label"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></h4>
			<?php $cur_symbol = get_woocommerce_currency_symbol();
				  $shipping_cost = WC()->cart->get_shipping_total()	?>
				<?php //print_r($shipping_cost); ?>
			<p class="psg-checkout-form-text"><?php echo $cur_symbol. '' .$shipping_cost; ?></p>
		</li>	
		
		
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<li class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<h4 class="psg-checkout-form-label"><?php wc_cart_totals_coupon_label( $coupon ); ?></h4>
			<p class="psg-checkout-form-text"><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
		</li>
		<?php endforeach; ?>

		<?php /*if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; */?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<li class="fee">
			<h4 class="psg-checkout-form-label"><?php echo esc_html( $fee->name ); ?></h4>
			<p class="psg-checkout-form-text"><?php wc_cart_totals_fee_html( $fee ); ?></p>
		</li>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
		<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
		<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
		<li class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<h4 class="psg-checkout-form-label"><?php echo esc_html( $tax->label ); ?></h4>
			<p class="psg-checkout-form-text"><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
		</li>
		<?php endforeach; ?>
		<?php else : ?>
		<li class="tax-total">
			<h4 class="psg-checkout-form-label"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h4>
			<p class="psg-checkout-form-text"><?php wc_cart_totals_taxes_total_html(); ?></p>
		</li>
		<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<li class="order-total">
			<h4 class="psg-checkout-form-label"><?php esc_html_e( 'Total', 'woocommerce' ); ?></h4>
			<p class="psg-checkout-form-text"><?php wc_cart_totals_order_total_html(); ?></p>
		</li>

		
		<?php if ( is_plugin_active( 'loyalty-points-rewards/wp-loyalty-points-rewards.php' ) ) { ?>
		<li class="checkout-page-points-rewards-earn">
			<h4 class="psg-checkout-form-label"><?php esc_html_e( 'Points Earned', 'woocommerce' ); ?></h4>
			<div class="psg-checkout-form-point-wrp"><div class="wlpr_points_rewards_earn_message"></div></div>
		</li> 
		<?php } ?>

		
		
		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
		<li class="psg-pay-btn-wrp">
			<div class="psg-pay-btn" id="psg-pay-btn"><span>Proceed To Checkout</span><i class="fal fa-horizontal-rule"></i></div>
		</li>
	</ul>
</div>
