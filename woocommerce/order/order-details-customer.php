<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
$order_data = $order->get_data();
// Billing Data
$billing_first_name = $order_data['billing']['first_name'];
$billing_address_1 = $order_data['billing']['address_1'];
$billing_address_2 = $order_data['billing']['address_2'];
$billing_postcode = $order_data['billing']['postcode'];
$billing_country = $order_data['billing']['country'];
$billing_email = $order_data['billing']['email'];
$billing_phone = $order_data['billing']['phone'];

// Shipping Data

$shipping_first_name = $order_data['shipping']['first_name'];
$shipping_address_1 = $order_data['shipping']['address_1'];
$shipping_address_2 = $order_data['shipping']['address_2'];
$shipping_postcode = $order_data['shipping']['postcode'];
$shipping_country = $order_data['shipping']['country'];
$shipping_phone = $order_data['shipping']['phone'];


//$shipping_payment_method = $order_data['shipping']['payment_method'];
//$shipping_payment_method_title = $order_data['shipping']['payment_method_title'];

// echo '<pre>';
// print_r($order_data);
// echo '</pre>';

?>
<section class="psg-wc-details">

	<section class="psg-address-wrp woocommerce-columns--addresses">

		<div class="psg-billing-address woocommerce-column--billing-address ">
			<div class="psg-bs-arrow">
				<h2 class="psg-address-title"><?php esc_html_e( 'Billing Info', 'woocommerce' ); ?></h2>
			</div>	
			<div class="psg-view-order-address">
				<?php 
				//echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
				<?php if ( $billing_first_name ) : ?>
				<p class="view-order-full-name"><?php echo $billing_first_name; ?></p>
				<?php endif; ?>

				<?php if ( $billing_address_1 || $billing_address_2 ){ ?>
				<p> <?php if ($billing_address_1){ echo $billing_address_1 . ' '; }
																	  if ($billing_address_2){ echo $billing_address_2; } ?>
				</p>
				<?php }?>

				<?php if ( $billing_country || $billing_postcode ){ ?>
				<p><?php  if ( $billing_country){ echo $billing_country . ' '; }
																   if ( $billing_postcode){ echo $billing_postcode; } ?>
				</p>
				<?php } ?>

				<?php if ( $billing_phone ) : ?>
				<p class="psg-phone-number"><?php echo $billing_phone; ?></p>
				<?php endif; ?>

			</div>
		</div>

		<div class="psg-shipping-address woocommerce-column--shipping-address">
			<div class="psg-bs-arrow">
				<h2 class="psg-address-title"><?php esc_html_e( 'Shipping Info', 'woocommerce' ); ?></h2>
			</div>	
			<div class="psg-view-order-address">
				<?php 
				//echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
				<?php if ( $shipping_first_name ) : ?>
				<p class="view-order-full-name"><?php echo $shipping_first_name; ?></p>				
				<?php endif; ?>	

				<?php if ( $shipping_address_1 || $shipping_address_2 ){ ?>
				<p> <?php  if ( $shipping_address_1 ){ echo $shipping_address_1 . ' '; }
																		if ( $shipping_address_2 ){ echo $shipping_address_2; } ?>
				</p>
				<?php } ?>

				<?php if ( $shipping_country || $shipping_postcode ){ ?>
				<p> <?php  if ( $shipping_country ){ echo $shipping_country . ' '; }
																	 if ( $shipping_postcode ){ echo $shipping_postcode; } ?>
				</p>
				<?php } ?>

				<?php if ( $shipping_phone ) : ?>
				<p class="psg-phone-number"><?php echo $shipping_phone; ?></p>
				<?php endif; ?>	

			</div>
		</div>

	</section>


	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>


<?php
// Iterating through order shipping items
foreach( $order->get_items( 'shipping' ) as $item_id => $shipping_item_obj ){
    $order_item_name             = $shipping_item_obj->get_name();
    $order_item_type             = $shipping_item_obj->get_type();
    $shipping_method_title       = $shipping_item_obj->get_method_title();
    $shipping_method_id          = $shipping_item_obj->get_method_id(); // The method ID
    $shipping_method_instance_id = $shipping_item_obj->get_instance_id(); // The instance ID
  
    $shipping_method_total_tax   = $shipping_item_obj->get_total_tax();
    $shipping_method_taxes       = $shipping_item_obj->get_taxes();
	
	$shipping_method_total = $shipping_item_obj->get_total();
	//print_r($shipping_method_total);
}
	
	
?>

<div class="custom-view-order-details-main">

	<div class="custom-view-order-details-wrapper">

		<div class="custom-order-details-inner custom-order-delivery-method">
			<h5>Delivery Method</h5>
			<p><?php echo $order->get_shipping_method(); ?>
				<span class="custom-shipping-method-value">
					<span class="woocommerce-Price-currencySymbol">(<?php echo get_woocommerce_currency_symbol();?></span><?php echo $shipping_method_total;?>)
				</span>
			</p>
		</div>
		
		<div class="custom-order-details-inner custom-order-status-inner <?php echo $order->get_status(); ?>">
			<h5>Status</h5>
			<p><?php echo $order->get_status(); ?></p>
		</div>	

		<div class="custom-order-details-inner custom-order-payment-method">
			<h5>Payment Method</h5>
			<p><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></p>
		</div>	

	</div>
	
	
<div class="custom-view-order-details-right-wrapper">
   
<?php if($order->get_customer_note()){ ?>
<div class="view-order-details-notes-main">
   <div class="view-order-details-notes-inner">
    	<h5>Order notes</h5>
    	<p><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></p>
    </div>
</div>
<?php } ?> 
   
</div>

</div>