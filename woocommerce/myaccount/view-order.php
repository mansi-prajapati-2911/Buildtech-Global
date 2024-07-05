<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();

?>

<div class="psg-view-order-main-wrp">


<p class="psg-view-order-back-button"><a href="<?php echo wc_get_account_endpoint_url('orders'); ?>"><i class="fal fa-arrow-left" aria-hidden="true"></i><span>Back</span></a></p>

	
<div class="view-custom-order-container">
	
	<div class="psg-view-order-heading-wrp">
	   <div class="psg-view-order-heading">
		   <h2 class="view-order-number">Order No: <?php echo  $order->get_order_number();?></h2>
		   <p class="order-date">Placed order on <?php echo wc_format_datetime($order->get_date_created()); ?> </p>
		</div>
	   <div class="view-order-print-append"></div>
	</div>


<?php do_action( 'woocommerce_view_order', $order_id ); ?>
</div>
	
</div>	