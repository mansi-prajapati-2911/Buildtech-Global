<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="psg-thank-you-page-main-wrp">

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
	
	<div class="thank-you-icon">
		<lottie-player src="<?php echo get_template_directory_uri(); ?>/assets/lottie/green-check.json"  background="transparent"  speed="1" autoplay></lottie-player>
	</div>
	
	
            <div class="psg-thankyou-page-custom">
				
				<?php if($order->has_status( 'processing' ) || $order->has_status( 'completed' )) { ?>
				<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">Your payment is successful!</p>
				<?php } else { ?>
						<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">Your order is pending for payment!</p>	
				<?php } ?>		
			    
				<p class="psg-thankyou-page-text">Thanks so much for your order! I hope you enjoy your new purchase! Please reach out to us at <a href="tel:+62827890"> 6282 7890</a> if you require any assistance.</p>
				
				<div class="psg-thankyou-page-btn-main-wrp">	
	<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="psg-thankyou-view-order-btn"><i class="far fa-eye"></i>View Order</a>
 				</div>
				
				<div class="thankyou-order-table-wrp">
				<table class="thankyou-order-table woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number ?>">Order Number</th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-date">Date</th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-total">Total</th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header-payment-method">Payment method</th>
			</tr>
		</thead>

		<tbody class="psg-account-order-body">
			<?php
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row order">
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order Number">
		
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
									<?php echo esc_html($order->get_order_number() ); ?>
								</a>
						</td>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-date" data-title="Date">
		
									<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
						</td>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-total" data-title="Total">
			<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s', '%1$s', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								?>
						</td>
					
					<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-payment-method" data-title="Payment Method">
							<?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
						</td>
					
					   

				</tr>
		</tbody>
	</table>
				</div>
				
            <div class="psg-thankyou-page-btn-main">                				
				<a href="<?php echo wc_get_page_permalink( 'home' ); ?>" class="psg-thankyou-page-btn psg-thank-you-home-btn"><span>Back to Home</span><i class="fal fa-horizontal-rule"></i></a>
				<a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="psg-thankyou-page-btn psg-thank-you-shop-btn"><span>Continue Shopping</span><i class="fal fa-horizontal-rule"></i></a>						
            </div>
        </div>    

		

		<?php endif; ?>



	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you For Your Order!', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
	
</div>	