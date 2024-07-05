<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="psg-checkout-page-main-wrp">
	<?php /************* Start  Left Side *************/ ?>
	
	<div class="psg-checkout-page-left-wrp">
		<div class="psg-checkout-back-btn">
			<a href="javascript:history.back()"><i class="fal fa-arrow-left"></i> <span>Back</span></a>
		</div>
		
		<div class="psg-checkout-progress-bar-wrp">
			<div class="psg-checkout-progress-bar">
				<div class="psg-checkout-progress-bar-inner"></div>
			</div>
			<div class="psg-checkout-progress-bar-text"></div>
		</div>
		
		<div class="psg-checkout-notification-main-wrp">
			<?php

			do_action( 'woocommerce_before_checkout_form', $checkout );

			// If checkout registration is disabled and not logged in, the user cannot checkout.
			if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
				echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
				return;
			}

			?>
		</div>
		<form id="psg_checkout_form" name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<div class="psg-checkout-address-wrp <?php echo $defult_form_css; ?>" id="customer_details">
				<div class="psg-checkout-billing-address">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<div class="psg-checkout-shipping-address">		
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>
			<?php 
			//***************************************//      
			//**** PSG Custom Address Data Start ****//
			//***************************************//
			if(is_user_logged_in()){
				$user_id = get_current_user_id();
				$user = get_userdata( $user_id );
				if(!empty($user_id)){
					$psg_checkout_ship_data  = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true );
					$psg_checkout_billing_data  = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
					$user_email = $user->user_email;
					// Defualt billing Custom meta value 
					$billing_name = get_user_meta( $user_id, 'billing_full_name', true );	
					$billing_address = get_user_meta( $user_id, 'billing_address_1', true );
					$billing_unitno = get_user_meta( $user_id, 'billing_address_2', true ); 
					$billing_postal = get_user_meta( $user_id, 'billing_postcode', true );
					$billing_phone = get_user_meta($user_id, 'billing_phone', true );
					$billing_email = get_user_meta( $user_id, 'billing_email', true );

					// Defualt shipping Custom meta value 
					$shipping_name = get_user_meta( $user_id, 'shipping_full_name', true );
					$shipping_address = get_user_meta( $user_id, 'shipping_address_1', true );
					$shipping_unitno = get_user_meta( $user_id, 'shipping_address_2', true ); 
					$shipping_postal = get_user_meta( $user_id, 'shipping_postcode', true );
					$shipping_phone = get_user_meta($user_id, 'shipping_phone', true );
				}
				
				if( (!empty($psg_checkout_billing_data) && !empty($psg_checkout_ship_data)) || (!empty($billing_name) && !empty($billing_address) && !empty($billing_unitno) && !empty($billing_postal) && !empty($billing_phone) && !empty($billing_email)) || (!empty($shipping_name) && !empty($shipping_address) && !empty($shipping_unitno) && !empty($shipping_postal) && !empty($shipping_phone)) ){ 
			?>
					<script>
						jQuery( document ).ready(function() {
						jQuery(".psg-checkout-address-wrp").addClass("check_out_form_display_none");
						});
					</script>
				<?php }
				
				elseif(empty($psg_checkout_billing_data) && (empty($billing_name) && empty($billing_address) && empty($billing_unitno) && empty($billing_postal) && empty($billing_phone) && empty($billing_email)) && !empty($psg_checkout_ship_data) || (!empty($shipping_name) && !empty($shipping_address) && !empty($shipping_unitno) && !empty($shipping_postal) && !empty($shipping_phone)) ){ 
			?>
					<script>
						jQuery( document ).ready(function() {
						jQuery(".psg-checkout-address-wrp ").addClass("check_out_form_billingdispaly");
						});
					</script>
				<?php }
				elseif( (empty($psg_checkout_billing_data) && empty($psg_checkout_ship_data)) && (empty($billing_name) && empty($billing_address) && empty($billing_unitno) && empty($billing_postal) && empty($billing_phone) && empty($billing_email)) && (empty($shipping_name) && empty($shipping_address) && empty($shipping_unitno) && empty($shipping_postal) && empty($shipping_phone))){ 
			?>
					<script>
						jQuery( document ).ready(function() {
						jQuery(".psg-checkout-address-wrp ").removeClass("check_out_form_display_none");
						});
					</script>
				<?php }
				elseif(!empty($psg_checkout_billing_data) || !(empty($billing_name) && !empty($billing_address) && !empty($billing_unitno) && !empty($billing_postal) && !empty($billing_phone) && !empty($billing_email))){ ?>
					<script>
						jQuery( document ).ready(function() {
						jQuery(".psg-checkout-address-wrp ").addClass("check_out_form_display_none");
						});
					</script>
				<?php }
				
				
				
				
				
				if( (!empty($psg_checkout_billing_data) || !empty($psg_checkout_ship_data)) || (!empty($billing_name) && !empty($billing_address) && !empty($billing_unitno) && !empty($billing_postal) && !empty($billing_phone) && !empty($billing_email)) || (!empty($shipping_name) && !empty($shipping_address) && !empty($shipping_unitno) && !empty($shipping_postal) && !empty($shipping_phone)) ){ 
				?>
				<div class="psg_checkout_address_custom_filed_main">
                   <?php 
					 if(!empty($psg_checkout_billing_data) || !empty($billing_name) || !empty($billing_address) || !empty($billing_unitno) || !empty($billing_postal) || !empty($billing_phone) || !empty($billing_email)){
						 $psg_set_default_address = get_user_meta( $user_id, 'set_default_address_billing', true );
						 ?>
					<div class="psg_checkout_ship_address_custom_filed">
						<div class="psg_checkout_address_top">
							<h3 clas="psg-address-title">Billing Details</h3>
							<a href="<?php echo wc_get_account_endpoint_url('edit-address');?>?checkout_popup=billing" class="psg_checkout_addnew_btn" id="add_new_billing_address">Add new</a>
						</div>
						<div class="psg_checkout_address_filed">
							<?php 
						 if(!empty($billing_name) || !empty($billing_address) || !empty($billing_unitno) || !empty($billing_postal) || !empty($billing_phone) || !empty($billing_email)){
							?>
							<div class="psg_checkout_address_inner_filed">
								<input type="radio" class="checkout_radio_btn" id="billing_defult" data-form_name="billing"  name="billing_radio_group" value="defult_billing" <?php echo ($psg_set_default_address == 'billing') ? 'checked' : "" ;?>/>
								<label for="billing_defult">
									<h5 class="psg-name"><?php echo $billing_name; ?></h5> 
									<p class="psg-address-row">
										<span class="psg-email">
											<?php if(!empty($billing_email)) {
								echo $billing_email;
							} else {
								echo $user_email;
							} ?>
										</span>
										<?php if(!empty($billing_phone)) { ?>
										<span class="psg-ab-seprator">|</span>
										<?php } ?>
										<span class="psg-phone-no"><?php echo $billing_phone; ?></span>
									</p>
									<p class="psg-street-address">
										<?php echo $billing_address;?>,
										<?php if(!empty($billing_unitno)){echo $billing_unitno .',';} ?>
										<?php echo $billing_postal; ?>
									</p> 
								</label>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ;?>edit-address/billing/" class="edit"><span>Edit</span><i class="fal fa-horizontal-rule"></i></a>
							</div>
							<?php
						 }
						 if(!empty($psg_checkout_billing_data)){
							 foreach($psg_checkout_billing_data as $psg_checkout_billing_key => $psg_checkout_billing_value ){
							?>
							<div class="psg_checkout_address_inner_filed">

								<input type="radio" id="billing_<?php echo $psg_checkout_billing_key ?>" data-form_name="billing" data-userid="<?php echo $psg_checkout_billing_value[0]; ?>" class="checkout_radio_btn" name="billing_radio_group" value="<?php echo $psg_checkout_billing_key; ?>" <?php echo ($psg_set_default_address != 'billing' && $psg_set_default_address == $psg_checkout_billing_key) ? 'checked' : "" ;?>/>
								<label for="billing_<?php echo $psg_checkout_billing_key; ?>">

									<h5 class="psg-name"><?php echo $psg_checkout_billing_value[1]; ?></h5> 
									<p class="psg-address-row">
										<span class="psg-email"><?php echo $psg_checkout_billing_value[5]; ?></span>
										<span class="psg-ab-seprator">|</span>
										<span class="psg-phone-no"><?php echo $psg_checkout_billing_value[6]; ?></span>
									</p>
									<p class="psg-street-address">
										<?php echo $psg_checkout_billing_value[2];?>,
										<?php if(!empty($psg_checkout_billing_value[3])){
								echo $psg_checkout_billing_value[3] .',';
							} ?>
										<?php echo $psg_checkout_billing_value[4]; ?>
									</p>
								</label>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ;?>edit-address/psg_billing/?address_id=<?php echo $psg_checkout_billing_key; ?>" class="edit"><span>Edit</span><i class="fal fa-horizontal-rule"></i></a>
							</div>
							<?php 
							 }
						 }	
							?>
						</div>
					</div>
						 <?php
					 }
					?>
					<div class="woocommerce-shipping-fields">
						<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

						<h3 id="ship-to-different-address" class="custom-ship-to-different-address">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
								<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?></span>
							</label>
						</h3>
						<?php endif;
						//***********************************//      
						//**** PSG Shipping Data Start *****//
						//**********************************//  ?>
						<div class="psg_checkout_ship_address_custom_filed shipping_address">
							<div class="psg_checkout_address_top">
								<h3 clas="psg-address-title">Shipping Details</h3>
								<a href="<?php echo wc_get_account_endpoint_url('edit-address');?>?checkout_popup=shipping" class="psg_checkout_addnew_btn" id="add_new_shipping_address">Add new</a>
							</div>
						<?php
						if(!empty($psg_checkout_ship_data) || !empty($shipping_name) || !empty($shipping_address) || !empty($shipping_unitno) || !empty($shipping_postal) || !empty($shipping_phone)){
							$psg_set_default_address_shipping = get_user_meta( $user_id, 'set_default_address_shiiping', true );
						?>
						
							<div class="psg_checkout_address_filed">
								<?php 
								if(!empty($shipping_name) || !empty($shipping_address) || !empty($shipping_unitno) || !empty($shipping_postal) || !empty($shipping_phone)){
									?>
									<div class="psg_checkout_address_inner_filed">
										<input type="radio" id="shipping_<?php echo $psg_checkout_ship_key ?>" data-form_name="shipping" class="checkout_radio_btn" value="defult_shipping" name="shipping_radio_group" <?php echo ($psg_set_default_address_shipping == 'shipping') ? 'checked' : "" ;?>>
										<label for="shipping_<?php echo $psg_checkout_ship_key; ?>">
											<h5 class="psg-name"><?php echo $shipping_name; ?></h5>
											<p class="psg-phone-no"><?php echo $shipping_phone; ?></p>
											<p class="psg-street-address">
												<?php echo $shipping_address;?>,
												<?php if(!empty($shipping_unitno)){
													echo $shipping_unitno . ",";
												}
												?>
												<?php echo $shipping_postal; ?>
											</p> 
										</label>
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ;?>edit-address/shipping/" class="edit"><span>Edit</span><i class="fal fa-horizontal-rule"></i></a>
									</div>
									<?php
								}
								if(!empty($psg_checkout_ship_data)){
								foreach($psg_checkout_ship_data as $psg_checkout_ship_key => $psg_checkout_ship_value ){
								?>
									<div class="psg_checkout_address_inner_filed">
										<input type="radio" id="shipping_<?php echo $psg_checkout_ship_key ?>" data-form_name="shipping" data-userid="<?php echo $psg_checkout_ship_value[0]; ?>" value="<?php echo $psg_checkout_ship_key; ?>" class="checkout_radio_btn" name="shipping_radio_group" <?php echo ($psg_set_default_address_shipping != 'shipping' && $psg_set_default_address_shipping == $psg_checkout_ship_key) ? 'checked' : "" ;?>>
										<label for="shipping_<?php echo $psg_checkout_ship_key; ?>">
											<h5 class="psg-name"><?php echo $psg_checkout_ship_value[1]; ?></h5>
											<p class="psg-phone-no"><?php echo $psg_checkout_ship_value[5]; ?></p>
											<p class="psg-street-address">
												<?php echo $psg_checkout_ship_value[2];?>,
												<?php if(!empty($psg_checkout_ship_value[3])){ 
													echo $psg_checkout_ship_value[3] . ',';
												} ?>
												<?php echo $psg_checkout_ship_value[4]; ?>
											</p> 
										</label>
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ;?>edit-address/psg_shipping/?address_id=<?php echo $psg_checkout_ship_key; ?>" class="edit"><span>Edit</span><i class="fal fa-horizontal-rule"></i></a>
									</div>
								<?php 
									}
								}
								?>
							</div>
							<?php 
						   }
						?>
						</div>
					</div>	
				</div>
				<?php
				
				}
			}

			/*				Shipping Method				*/ ?>
			
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) { ?>
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
			<div class="psg-checkout-shipping-method-wrp">
				<h3 class="psg-shipping-method-heading">Shipping Method</h3>
				<?php wc_cart_totals_shipping_html(); ?>
				<p class="psg-shipping-method-text"> Delivery will be 3-5 working days after payment received. </p>
			</div>
			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
			<?php } ?>
	
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			
			<?php 
			/*				Order Notes				*/ 
			?>
			<div class="psg-checkout-order-notes-wrp">
				<div class="woocommerce-additional-fields">
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

					<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>


					<?php endif; ?>

					<div class="woocommerce-additional-fields__field-wrapper">
						<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
						<?php endforeach; ?>
					</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
				</div>
			</div>			

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
			
			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

			
		</form>
		
	</div>
	<?php /************* End  Left Side *************/ ?>
	
	<?php /************* Start right Side *************/ ?>
	<div class="psg-checkout-right-wrp">
		<div class="psg-checkout-mobile-toggle-btn">
			<i class="fal fa-chevron-up"></i>
		</div>
		<h3 id="order_review_heading">
			<?php esc_html_e( 'Cart Summary', 'woocommerce' ); ?>
			<a class="psg-edit-cart-link" href="<?php echo wc_get_cart_url(); ?>">
				<i class="fal fa-pencil-alt"></i><span>Edit Cart</span>
			</a>
		</h3>
		<div id="order_review" class="woocommerce-checkout-review-order psg_order_review_wrapper">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
	</div>
	<!-- Start Mobile Cart Summery --->
	<div class="psg-checkout-mobile-wrp ">
		<div class="psg-checkout-mobile-toggle-btn">
			<i class="fal fa-chevron-down"></i>
		</div>
		<h3 id="order_review_heading">
			<?php esc_html_e( 'Cart Summary', 'woocommerce' ); ?>
			<a class="psg-edit-cart-link" href="<?php echo wc_get_cart_url(); ?>">
				<i class="fal fa-pen"></i><span>EDIT CART</span>
			</a>
		</h3>
		<div id="order_review_mobile" class="woocommerce-checkout-review-order psg_order_review_wrapper_mobile">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
	</div>
	<!-- End Mobile Cart Summery --->
	<?php /************* End right Side *************/ ?>
	


</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>