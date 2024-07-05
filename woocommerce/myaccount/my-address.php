<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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

defined( 'ABSPATH' ) || exit;


//************************************// 
//**** Custom PSG Multipleaddress ****//
//************************************// 
// Billing Address
?>
<div class="psg-address-book-wrp">
	<h3 class="psg-dashboard-main-heading">Address Book</h3>
	<div class="psg-address-book-top">
		<h3 class="psg-ab-heading">Billing Address</h3>
		<div class="psg-ab-add-new-btn" id="add_new_billing_address" data-form="billing"><span>Add new</span><i class="fal fa-horizontal-rule"></i></div>
	</div>
<?php
    $user_id = get_current_user_id();
    
	$billing_name = get_user_meta( $user_id, 'billing_full_name', true );	// default meta value name
	$billing_address = get_user_meta( $user_id, 'billing_address_1', true ); // default meta value address
	$billing_unitno = get_user_meta( $user_id, 'billing_address_2', true ); // default meta value unit no
	$billing_postal = get_user_meta( $user_id, 'billing_postcode', true );  // default meta value postal code
	$billing_phone = get_user_meta($user_id, 'billing_phone', true );  // default meta value phone no
	$billing_email = get_user_meta( $user_id, 'billing_email', true );  // default meta value email
	$billing_country = get_user_meta( $user_id, 'billing_country', true );
	$billing_country_name = WC()->countries->countries[ $billing_country ];
    $psg_billing_address = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true ); // Custom meta value billing Data
	
	$psg_set_default_address = get_user_meta( $user_id, 'set_default_address_billing', true );
	
	/* Woocommerce default billing data start */

	if(!empty($billing_name) && !empty($billing_address) && !empty($billing_unitno) && !empty($billing_postal) && !empty($billing_phone) && !empty($billing_email) ){
	?>
	<div class="psg-custom-address-book-main" id="psg_custom_address_billing_default">
		<div class="psg-custom-address-book-inner">
			<div class="psg-ab-address">
				<h5 class="psg-name"><?php echo $billing_name; ?></h5>
				<p class="pcd-address-row">
					<span class="psg-email"><?php echo $billing_email; ?></span>
					<span class="psg-ab-seprator">|</span>
					<span class="psg-phone-no"><?php echo $billing_phone; ?></span>
				</p> 
				
				<p class="psd-street-address"><?php echo $billing_country_name; ?>, <?php echo $billing_address;?>, <?php echo $billing_unitno; ?>, <?php echo $billing_postal; ?></p>
			</div>
			<div class="psg-custom-address-book-action">
				<div class="psg-custom-address-button">
				<span class="psg_set_defult_address_main_wrp">
					<input type="radio" class="psg_set_defult_address" name="psg_default_address" id="psg_default_address_billing" data-userid="<?php echo $user_id; ?>" data-addressid="billing" <?php echo ($psg_set_default_address == 'billing') ? 'checked' : "" ;?>/>
					<label for="psg_default_address_billing">Set Default Address</label>
				</span>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button">
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing' ) ); ?>" class="edit"><i class="fal fa-pencil-alt"></i><span>Edit</span></a>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button psg-custom-address-button-delete">
				<button id="psg_default_address_del" name="psg_default_address_del_button" data-userid="<?php echo $user_id; ?>" data-addressid="billing"  class="btn psg_defu_address_delete_button" type="submit" >
					<i class="fal fa-trash-alt"></i> <span>Delete</span>
				</button>
				</div>
				
			</div>
		</div>
	</div>
	<?php
	}
	/* Woocommerce default billing data End */
    $psg_billing_address = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
    if(!empty($psg_billing_address)){
    ?>
	
	
    <div class="psg-custom-billing-address">
        <?php
		   $i = 1;
           foreach($psg_billing_address as $psg_billing_address_key => $psg_billing_value ){ 
			   $billing_country_name1 = WC()->countries->countries[ $psg_billing_value[7] ];
		?>
		<div class="psg_custom_address_book_main" id="psg_custom_address_billing_main">
			<div class="psg-custom-address-book-inner">
				<div class="psg-ab-address">
					<h5 class="psg-name"><?php echo $psg_billing_value[1]; ?></h5>
					<p class="pcd-address-row">
						<span class="psg-email"><?php echo $psg_billing_value[5]; ?></span>
						<span class="psg-ab-seprator">|</span>
						<span class="psg-phone-no"><?php echo $psg_billing_value[6]; ?></span>
					</p> 
					<p class="psd-street-address"><?php echo $billing_country_name1;?>, <?php echo $psg_billing_value[2];?>, <?php echo $psg_billing_value[3]; ?>, <?php echo $psg_billing_value[4]; ?></p> 
				</div>
				<div class="psg-custom-address-book-action">
					<div class="psg-custom-address-button">
					<span class="psg_set_defult_address_main_wrp">
						<input type="radio" class="psg_set_defult_address" name="psg_default_address" id="psg_default_address_<?php echo $i; ?>" data-userid="<?php echo $user_id; ?>" data-addressid="<?php echo $psg_billing_address_key; ?>" <?php echo ($psg_set_default_address != 'billing' && $psg_set_default_address == $psg_billing_address_key) ? 'checked' : "" ;?>/>
						<label for="psg_default_address_<?php echo $i; ?>">Set Default Address</label>
					</span>
					</div>
					<span class="psg-btn-seprator"></span>
					<div class="psg-custom-address-button">
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'psg_billing' ) ); ?>?address_id=<?php echo $psg_billing_address_key ?>" class="edit"><i class="fal fa-pencil-alt"></i> <span>Edit</span></a>
					</div>
					<span class="psg-btn-seprator"></span>
					<div class="psg-custom-address-button psg-custom-address-button-delete">
					<button id="psg_mul_add_delete_button" name="psg_mul_add_delete_button" data-userid="<?php echo $psg_billing_value[0]; ?>" data-addressid="<?php echo $psg_billing_address_key; ?>"  class="psg_mul_address_delete_button_billing" type="submit" >
						<i class="fal fa-trash-alt"></i> <span>Delete</span>
					</button>
					</div>
				</div>
			</div>
		</div>
           <?php
			   $i++;
           }
        ?>
    </div>
    <?php }
    
    
    
    
// Shippiing Addres

    $shipping_name = get_user_meta( $user_id, 'shipping_full_name', true );	// default meta value name
	$shipping_address = get_user_meta( $user_id, 'shipping_address_1', true ); // default meta value address
	$shipping_unitno = get_user_meta( $user_id, 'shipping_address_2', true ); // default meta value unit no
	$shipping_postal = get_user_meta( $user_id, 'shipping_postcode', true );  // default meta value postal code
	$shipping_phone = get_user_meta($user_id, 'shipping_phone', true );  // default meta value phone no
	$shipping_country = get_user_meta($user_id, 'shipping_country', true ); 
	$shipping_country_name = WC()->countries->countries[ $shipping_country ];
    $psg_set_default_address_shipping = get_user_meta( $user_id, 'set_default_address_shiiping', true );
 
	$psg_shipping_address = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true ); // Get Shipping Data
	?>
	<div class="psg-address-book-top psg_shipping_address">
		<h3 class="psg-ab-heading">Shipping Address</h3>
		<div class="psg-ab-add-new-btn" data-form="shipping" id="add_new_shipping_address"><span>Add new</span><i class="fal fa-horizontal-rule"></i></div>
	</div>
	<?php
	/* Woocommerce default shipping data start */
	if(!empty($shipping_name) && !empty($shipping_address) && !empty($shipping_unitno) && !empty($shipping_postal) && !empty($shipping_phone)){
	?>
	<div class="psg-custom-address-book-main" id="psg_custom_address_shipping_default">
		<div class="psg-custom-address-book-inner">
			<div class="psg-ab-address">
				<h5 class="psg-name"><?php echo $shipping_name; ?></h5>
				<p class="psg-phone-no"><?php echo $shipping_phone; ?></p>
				<p class="psg-street-address"><?php echo $shipping_country_name; ?>, <?php echo $shipping_address;?>, <?php echo $shipping_unitno; ?>, <?php echo $shipping_postal; ?></p>
			</div> 
			<div class="psg-custom-address-book-action">
				<div class="psg-custom-address-button">
				<span class="psg_set_defult_address_main_wrp">
					<input type="radio" class="psg_set_defult_address_shipping" name="psg_default_address_shipping" id="psg_default_address_shipping" data-userid="<?php echo $user_id; ?>" data-addressid="shipping" <?php echo ($psg_set_default_address_shipping == 'shipping') ? 'checked' : "" ;?>/>
					<label for="psg_default_address_shipping">Set Default Address</label>
				</span>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button">
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping' ) ); ?>" class="edit"><i class="fal fa-pencil-alt"></i><span>Edit</span></a>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button psg-custom-address-button-delete">
				<button id="psg_default_address_del" name="psg_default_address_del_button" data-userid="<?php echo $user_id; ?>" data-addressid="shipping"  class="btn psg_defu_address_delete_button" type="submit" >
					<i class="fal fa-trash-alt"></i> <span>Delete</span>
				</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	/* Woocommerce default shipping data end */
	
	/* Woocommerce Custom shipping data Start */
	if(!empty($psg_shipping_address)){
	?>
	<div class="psg-custom-shipping-address">
		<div class="psg-custom-address-book-main" id="psg_custom_address_ship_main">
			<?php 
		$i = 1;
		foreach($psg_shipping_address as $psg_shipping_address_key => $psg_ship_value ){
			$address = wc_get_account_formatted_address( $psg_shipping_address_key );
			echo $address;
			$shipping_country_name1 = WC()->countries->countries[ $psg_ship_value[6] ];
			?>

			<div class="psg-custom-address-book-inner">
				<div class="psg-ab-address">
					<h5 class="psg-name"><?php echo $psg_ship_value[1]; ?></h5>
					<p class="psg-phone-no"><?php echo $psg_ship_value[5]; ?></p>
					<p class="psg-street-address"><?php echo $shipping_country_name1;?>, <?php echo $psg_ship_value[2];?>, <?php echo $psg_ship_value[3]; ?>, <?php echo $psg_ship_value[4]; ?></p>
				</div> 
				
				<div class="psg-custom-address-book-action">
					<div class="psg-custom-address-button">
					<span class="psg_set_defult_address_main_wrp">
						<input type="radio" class="psg_set_defult_address_shipping" name="psg_default_address_shipping" id="psg_default_address_shipping_<?php echo $i; ?>" data-userid="<?php echo $user_id; ?>" data-addressid="<?php echo $psg_shipping_address_key; ?>" <?php echo ($psg_set_default_address_shipping != 'billing' && $psg_set_default_address_shipping == $psg_shipping_address_key) ? 'checked' : "" ;?>/>
						<label for="psg_default_address_shipping_<?php echo $i; ?>">Set Default Address</label>
					</span>
					</div>
					<span class="psg-btn-seprator"></span>
					<div class="psg-custom-address-button">
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'psg_shipping' ) ); ?>?address_id=<?php echo $psg_shipping_address_key ?>" class="edit"><i class="fal fa-pencil-alt"></i></i> <span>Edit</span></a>
					</div>
					<span class="psg-btn-seprator"></span>
					<div class="psg-custom-address-button psg-custom-address-button-delete">
					<button id="psg_mul_add_delete_button" name="psg_mul_add_delete_button" data-userid="<?php echo $psg_ship_value[0]; ?>" data-addressid="<?php echo $psg_shipping_address_key; ?>"  class="psg-mul-address-delete-button" type="submit" >
						<i class="fal fa-trash-alt"></i> <span>Delete</span>
					</button>
					</div>
				</div>
				
			</div>

			<?php
			$i++;
		}
			?>
		</div>
	</div>
	<?php } 
?>
	
</div>
	
<?php /********* Add New Billing Address *********/ ?>

<?php 
 $checkout_popup = $_GET['checkout_popup'];

// $billing_popup = $_GET['billing-error'];
?>

<div class="psg-ma-add-new-popup <?php if($checkout_popup == 'billing'){ echo "open"; }?>" id="add_new_billing_address_popup">
	<div class="psg-ma-add-new-popup-overlay"></div>
	<div class="psg-ma-add-new-popup-content">
		<div class="psg-ma-add-new-popup-inner">
			<h3>Billing Details</h3>
			<form method="POST" id="psg_multiple_address_billing_form" action="">
				<?php                    
				// show any error messages after form submission
				multipleaddress_billing_error_messages(); 
				?>
				<div class="psg_multiple_address_custom_filed_main">
					<div class="psg_multiple_address_filed">
						<label for="sender_name_billing">Recipient Name <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="sender_name_billing" name="sender_name_billing" value="" placeholder="Please enter your recipient name" required />
					</div>

					<div class="psg_multiple_address_filed half_width">
						<label for="email_billing">Email Address <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="email_billing" name="email_billing" value="" placeholder="Please enter Email Address" required />
					</div>

					<div class="psg_multiple_address_filed half_width">
						<label for="phone_no_billing">Phone No. <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="phone_no_billing" name="phone_no_billing" value="" placeholder="Please enter your phone no." required />
					</div>

					<div class="psg_multiple_address_filed" id="<?php echo $load_address;?>_country_field">
						<?php
						wp_enqueue_script('wc-country-select');
						woocommerce_form_field('billing_country',array(
							'type'        => 'country',
							'class'       => array('chzn-drop'),
							'label'       => __('Country / Region'),
							'placeholder' => __('Please select'),
							'required'    => true,
							'clear'       => true,
							'default'     => $country,
						));
						?>
					</div>				

					<div class="psg_multiple_address_filed">
						<label for="street_address_billing">Street Address <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="street_address_billing" name="street_address_billing" value="" placeholder="Please enter your street address" required />
					</div>
					<div class="psg_multiple_address_filed half_width">
						<label for="unit_no_billing">Unit Number <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="unit_no_billing" name="unit_no_billing" value="" placeholder="Please enter your unit no." required>
					</div>
					<div class="psg_multiple_address_filed half_width">
						<label for="postal_code_billing">Postal Code <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="postal_code_billing" name="postal_code_billing" value="" minlength="6" maxlength="6" placeholder="Please enter your postal code" required />
					</div>
				</div>
				<input type="hidden" name="psg_multiple_billing_address_nonce" value="<?php echo wp_create_nonce('psg_multiple_billing_address_nonce'); ?>"/>
				<span class="psg-address-cancel-button">Cancel</span>
				<input id="psg_multiple_billing_address_button" name="psg_multiple_billing_address_button" class="btn btn--big btn--icon psg_multiple_billing_address_button" type="submit" value="Save"/>
			</form>
		</div>
	</div>
</div>	

<?php /********* Add New Shipping Address *********/ ?>
<div class="psg-ma-add-new-popup <?php if($checkout_popup == 'shipping'){ echo "open"; }?>" id="add_new_shipping_address_popup">
	<div class="psg-ma-add-new-popup-overlay"></div>
	<div class="psg-ma-add-new-popup-content">
		<div class="psg-ma-add-new-popup-inner">
			<h3>Shipping Details</h3>
			<form method="POST" id="psg_multiple_address_shipping_form" action="" >
				<?php                    
				// show any error messages after form submission
				multipleaddress_shipping_error_messages(); 
				?>
				<div class="psg_multiple_address_custom_filed_main">
					<div class="psg_multiple_address_filed">
						<label for="recipient_name_ship">Recipient Name <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="recipient_name_ship" name="recipient_name_ship" value="" placeholder="Please enter your Recipient Name" required />
					</div>
					<div class="psg_multiple_address_filed half_width" id="<?php echo $load_address;?>_country_field">
						<?php
						wp_enqueue_script('wc-country-select');
						woocommerce_form_field('shipping_country',array(
							'type'        => 'country',
							'class'       => array('chzn-drop'),
							'label'       => __('Country / Region'),
							'placeholder' => __('Please select'),
							'required'    => true,
							'clear'       => true,
							'default'     => $country
						));
						?>
					</div>

					<div class="psg_multiple_address_filed half_width">
						<label for="phone_no_ship">Phone No.<span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="phone_no_ship" name="phone_no_ship" value="" placeholder="Please enter your phone no." required />
					</div>
					<div class="psg_multiple_address_filed">
						<label for="street_address_ship">Street Address <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="street_address_ship" name="street_address_ship" value="" placeholder="Please enter your street address" required />
					</div>
					<div class="psg_multiple_address_filed half_width">
						<label for="unit_no_ship">Unit Number <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="unit_no_ship" name="unit_no_ship" value="" placeholder="Please enter your unit no.">
					</div>
					<div class="psg_multiple_address_filed half_width">
						<label for="postal_code_ship">Postal Code <span class="psg_required">*</span></label>
						<input type="text" class="psg_edit_input" id="postal_code_ship" name="postal_code_ship" value="" minlength="6" maxlength="6" placeholder="Please enter your postal code" required />
					</div>
				</div>
				<input type="hidden" name="psg_multiple_shipping_address_nonce" value="<?php echo wp_create_nonce('psg_multiple_shipping_address_nonce'); ?>"/>
				<span class="psg-address-cancel-button">Cancel</span>
				<input id="psg_multiple_shipping_address_button" name="psg_multiple_shipping_address_button" class="btn btn--big btn--icon psg_multiple_shipping_address_button" type="submit" value="Save"/>
			</form>
		</div>
	</div>
</div>

