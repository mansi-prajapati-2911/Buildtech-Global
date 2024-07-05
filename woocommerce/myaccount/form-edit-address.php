<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing Details', 'woocommerce' ) : esc_html__( 'Shipping Details', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); 
$user_id = get_current_user_id();
?>
	
<?php if ( ! $load_address ) {
	 wc_get_template( 'myaccount/my-address.php' );
}
/******************************/
/*** PSG billing edit form ***/
/******************************/

elseif($load_address == 'psg_billing'){
	$psg_billing_address = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true ); // Get Shipping Data
	$address_id = $_GET['address_id'];
	foreach($psg_billing_address as $psg_address_key => $psg_address_value){
		if(array_key_exists($address_id ,$psg_billing_address )){
			$psg_update_address_data = $psg_billing_address[$address_id];
			//print_r($psg_update_address_data);
		}
	}
	?>
	<div class="psg-edit-address-back-button" onclick="parent.history.back()">
		<i class="fal fa-arrow-left" aria-hidden="true"></i><span>Back</span>
	</div>
	<div class="psg-edit-address-box-wrp">
		<h3 class="psg-edit-address-heading">Billing Details</h3>
		<form method="POST" id="psg_multiple_address_billing_update_form" action="">
			<div class="psg_multiple_address_custom_filed_main">
				<?php 
	//multipleaddress_billing_update_error_messages();
				?>
				<div class="psg_multiple_address_filed">
					<label for="recipient_name_ship">Sender Name <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="recipient_name_ship" name="recipient_name_billing" placeholder="Please enter your Sender Name" value="<?php if(!empty($psg_update_address_data[1]) && isset($psg_update_address_data[1])){ echo $psg_update_address_data[1];} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed">
					<label for="street_address_ship">Street Address <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="street_address_ship" name="street_address_billing" placeholder="Please enter your Street Address" value="<?php if(!empty($psg_update_address_data[2]) && isset($psg_update_address_data[2])){ echo $psg_update_address_data[2];} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed half_width">
					<label for="unit_no_ship">Unit No. <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="unit_no_ship" name="unit_no_billing" placeholder="Please enter your Unit No." value="<?php if(!empty($psg_update_address_data[3]) && isset($psg_update_address_data[3])){ echo $psg_update_address_data[3];} ?>" required>
				</div>
				<div class="psg_multiple_address_filed half_width">
					<label for="postal_code_ship">Postal Code <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="postal_code_ship" name="postal_code_billing" placeholder="Please enter your Postal Code" value="<?php if(!empty($psg_update_address_data[4]) && isset($psg_update_address_data[4])){ echo $psg_update_address_data[4];} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed half_width">
					<label for="email_billing">Email Address <span class="psg_required">*</span></label>
					<input type="email" class="psg_edit_input" id="email_billing" name="email_billing" placeholder="Please enter your Email Address" value="<?php if(!empty($psg_update_address_data[5]) && isset($psg_update_address_data[5])){ echo $psg_update_address_data[5];} ?>" required>
				</div>				
				<div class="psg_multiple_address_filed half_width">
					<label for="phone_no_ship">Phone No. <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" name="phone_no_billing" id="phone_no_billing" placeholder="Please enter your Phone No." value="<?php if(!empty($psg_update_address_data[6]) && isset($psg_update_address_data[6])){ echo $psg_update_address_data[6];} ?>" required>
				</div>
												
			</div>
			<input type="hidden" name="psg_multiple_billing_add_update_nonce" value="<?php echo wp_create_nonce('psg_multiple_billing_add_update_nonce'); ?>"/>
			<input type="hidden" name="psg_update_addressid" value="<?php echo $address_id; ?>"/>
			<span class="psg-edit-address-cancel-button" onclick="parent.history.back()">Cancel</span>
			<input id="psg_multiple_billing_add_update_button" name="psg_multiple_billing_add_update_button" class="btn btn--big btn--icon psg_multiple_billing_add_update_button" type="submit" value="Save"/>
			
		</form>
	</div>
<?php
}


/******************************/
/*** PSG shipping edit form ***/
/******************************/
elseif($load_address == 'psg_shipping'){
	$user_id = get_current_user_id();
	$psg_shipping_address = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true ); // Get Shipping Data
	$address_id = $_GET['address_id'];
	foreach($psg_shipping_address as $psg_address_key => $psg_address_value){
		if(array_key_exists($address_id ,$psg_shipping_address )){
			$psg_update_address_data = $psg_shipping_address[$address_id];
			//print_r($psg_update_address_data);
		}
	}
	
	?>
	<div class="psg-edit-address-back-button" onclick="parent.history.back()">
		<i class="fal fa-arrow-left" aria-hidden="true"></i><span>Back</span>
	</div>
	<div class="psg-edit-address-box-wrp">
		<h3 class="psg-edit-address-heading">Shipping Details</h3>
		<form method="POST" id="psg_multiple_address_shipping_update_form" action="">
			<div class="psg_multiple_address_custom_filed_main">
				<div class="psg_multiple_address_filed">
					<label for="recipient_name_ship">Recipient Name <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="recipient_name_ship" name="recipient_name_ship" placeholder="Please enter your Recipient Name" value="<?php if(!empty($psg_update_address_data[1]) && isset($psg_update_address_data[1])){ echo $psg_update_address_data[1];} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed">
					<label for="street_address_ship">Street Address <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="street_address_ship" name="street_address_ship" placeholder="Please enter your Street Address" value="<?php if(!empty($psg_update_address_data[2]) && isset($psg_update_address_data[2])){ echo $psg_update_address_data[2];} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed half_width">
					<label for="unit_no_ship">Unit No. <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="unit_no_ship" name="unit_no_ship" placeholder="Please enter your Unit No." value="<?php if(!empty($psg_update_address_data[3]) && isset($psg_update_address_data[3])){ echo $psg_update_address_data[3];} ?>" required>
				</div>
				<div class="psg_multiple_address_filed half_width">
					<label for="postal_code_ship">Postal Code <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" id="postal_code_ship" name="postal_code_ship" placeholder="Please enter your Postal Code" value="<?php if(!empty($psg_update_address_data[4]) && isset($psg_update_address_data[4])){ echo $psg_update_address_data[4];} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed half_width">
					<label for="phone_no_ship">Phone No. <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" name="phone_no_ship" id="phone_no_ship" placeholder="Please enter your Phone No." value="<?php if(!empty($psg_update_address_data[5]) && isset($psg_update_address_data[5])){ echo $psg_update_address_data[5];} ?>" required>
				</div>												
			</div>
			<input type="hidden" name="psg_multiple_ship_add_update_nonce" value="<?php echo wp_create_nonce('psg_multiple_ship_add_update_nonce'); ?>"/>
			<input type="hidden" name="psg_update_addressid" value="<?php echo $address_id; ?>"/>
			<span class="psg-edit-address-cancel-button" onclick="parent.history.back()">Cancel</span>
			
			<input id="psg_multiple_ship_add_update_button" name="psg_multiple_ship_add_update_button" class="btn btn--big btn--icon psg_multiple_ship_add_update_button" type="submit" value="Save"/>
		</form>
	</div>	
<?php
}
/* PSG Default Form Start */
else { 
	$name = get_user_meta( $user_id, $load_address.'_full_name', true );	
	$street_address = get_user_meta( $user_id, $load_address.'_address_1', true );
	$unitno = get_user_meta( $user_id, $load_address.'_address_2', true ); 
	$postal_code = get_user_meta( $user_id, $load_address.'_postcode', true );
	$phone_no = get_user_meta($user_id, $load_address.'_phone', true );
	$email = get_user_meta( $user_id, $load_address.'_email', true );

?>
	<div class="psg-edit-address-back-button" onclick="parent.history.back()">
		<i class="fal fa-arrow-left" aria-hidden="true"></i><span>Back</span>
	</div>
<div class="psg-edit-address-box-wrp">
	<h3 class="psg-edit-address-heading"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3><?php // @codingStandardsIgnoreLine ?>
	<form method="post" class="psg_edit_address_form pag_edit_address_<?php echo $load_address; ?>">
		<div class="woocommerce-address-fields">
			<div class="psg_multiple_address_custom_filed_main">
				
				<div class="psg_multiple_address_filed" id="<?php echo $load_address;?>_name_field">
					<label for="<?php echo $load_address;?>_name">Sender Name <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" name="<?php echo $load_address;?>_name" id="<?php echo $load_address;?>_name" placeholder="Please enter your Sender Name" value="<?php if(!empty($name)){ echo $name;} ?>" required>
				</div>
				
				<div class="psg_multiple_address_filed" id="<?php echo $load_address;?>_street_address_field">
					<label for="<?php echo $load_address;?>_street_address">Street Address <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" name="<?php echo $load_address;?>_street_address" id="<?php echo $load_address;?>_street_address" placeholder="Please Enter your Street Address" value="<?php if(!empty($street_address)){ echo $street_address;}?>" required>
				</div>
				
				<div class="psg_multiple_address_filed half_width" id="<?php echo $load_address;?>_unit_no_field">
					<label for="<?php echo $load_address;?>_unit_no" class="">Unit No. <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input " name="<?php echo $load_address;?>_unit_no" id="<?php echo $load_address;?>_unit_no" placeholder="Please enter your Unit No." value="<?php if(!empty($unitno)){ echo $unitno;}?>"required>
				</div>				
				<div class="psg_multiple_address_filed half_width" id="<?php echo $load_address;?>_postal_code_field">
					<label for="<?php echo $load_address;?>_postal_code" class="">Postal Code <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" name="<?php echo $load_address;?>_postal_code" id="<?php echo $load_address;?>_postal_code" placeholder="Please enter your Postal Code" value="<?php if(!empty($postal_code)){ echo $postal_code;}?>" required>
				</div>
				
				<?php if($load_address != 'shipping'){ ?>
				<div class="psg_multiple_address_filed half_width" id="<?php echo $load_address;?>_email_field">
					<label for="<?php echo $load_address;?>_email" class="">Email Address <span class="psg_required">*</span></label>
					<input type="email" class="psg_edit_input" name="<?php echo $load_address;?>_email" id="<?php echo $load_address;?>_email" placeholder="Please enter your Email Address" value="<?php if(!empty($email)){ echo $email;}?>" required>
				</div>
				<?php } ?>
				
				<div class="psg_multiple_address_filed half_width" id="<?php echo $load_address;?>_phone_no_field">
					<label for="<?php echo $load_address;?>_phone_no">Phone No. <span class="psg_required">*</span></label>
					<input type="text" class="psg_edit_input" name="<?php echo $load_address;?>_phone_no" id="<?php echo $load_address;?>_phone_no" placeholder="Please enter your Phone No." value="<?php if(!empty($phone_no)){ echo $phone_no;}?>" required>
				</div>							
				
				<p class="psg_edit_address_button">
					<span class="psg-edit-address-cancel-button" onclick="parent.history.back()">Cancel</span>
					<input type="hidden" name="psg_default_form_update_nonce" value="<?php echo wp_create_nonce('psg_default_form_update_nonce'); ?>"/>
					<input type="hidden" name="psg_default_form_name" value="<?php echo $load_address ;?>"/>
					<button type="submit" class="button save_address" name="default_form_save_address" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
				</p>
			</div>
		</div>
	</form>
</div>
<?php } ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

