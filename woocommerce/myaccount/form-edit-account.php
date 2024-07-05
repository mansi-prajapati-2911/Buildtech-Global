<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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

do_action( 'woocommerce_before_edit_account_form' );
$user_id = get_current_user_id();
$gender = get_the_author_meta( 'billing_gender', $user->ID);
$billing_full = get_user_meta( $user_id, 'billing_full_name', true );
$billing_address_1 = get_user_meta( $user_id, 'billing_address_1', true );
$billing_address_2 = get_user_meta( $user_id, 'billing_address_2', true );		
$billing_postcode = get_user_meta( $user_id, 'billing_postcode', true );
$billing_email = get_user_meta( $user_id, 'billing_email', true );
$billing_phone = get_user_meta( $user_id, 'billing_phone', true );


$shipping_address_1 = get_user_meta( $user_id, 'shipping_address_1', true );
$shipping_address_2 = get_user_meta( $user_id, 'shipping_address_2', true );	
$shipping_postcode = get_user_meta( $user_id, 'shipping_postcode', true );

$attachment_id = get_user_meta( $user_id, 'image1', true );
$original_image_url = wp_get_attachment_url( $attachment_id );
$original_image_name = basename($original_image_url);
$user = get_userdata( $user_id );

// Get all the user roles as an array.
$user_roles = $user->roles;
?>

<h3 class="psg-dashboard-main-heading">My Profile</h3>
<form class="psg-edit-profile-form-wrp woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
	
	<div class="psg-edit-profile-left-side">
		<div class="psg-edit-profile-image">
			<?php if($original_image_url){ ?>
				<img src="<?php echo $original_image_url; ?>" alt="Profile Image">
			<?php }else{ ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-683-10-my-account.jpg" alt="Profile Image">
			<?php } ?>
		</div>
		
		<div class="custom-file-upload">
			<input type="file" name="image1" class="input-file" value="<?php echo $attachment_id; ?>">
			<div class="psg-file-btn-group">
				<span class="psg-file-btn">
					<button class="upload-field btn btn-info psg-file-btn-info" type="button">
						Update Photo<i class="fal fa-horizontal-rule"></i>
					</button>
				</span>
			</div>
		</div>
	</div>
	
	<div class="psg-edit-profile-right-side">
	
		
	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-wide">
		<label for="account_first_name"><?php esc_html_e( 'Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" placeholder="Enter Full Name" autocomplete="given-name" value="<?php echo esc_attr( $user->display_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-wide account-gender-main">
		<label for="account_last_name"><?php esc_html_e( 'Gender', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <span class="edit-account-gender-wrap"><input type="radio"  id="billing_gender_Male" name="billing_gender" <?php if ($gender == 'Male' ) { ?>checked="checked"<?php }?> value="Male"><label for="billing_gender_Male" class="radio ">Male</label>
            <input type="radio" name="billing_gender" id="billing_gender_Female" <?php if ($gender == 'Female' ) { ?>checked="checked"<?php }?> value="Female"><label for="billing_gender_Female" class="radio ">Female</label>
	       </span> 
    </p>
	
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email Address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" placeholder="Enter your Email Address" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>
	
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-wide">
		<label for="account_phone"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" name="billing_phone" id="billing_phone" placeholder="Enter your Contact Number" autocomplete="phone" value="<?php echo $billing_phone; ?>" />
	</p>
		
	<div class="clear"></div>

<?php


$saved_methods = wc_get_customer_saved_methods_list( get_current_user_id() );
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();

?>

	<fieldset class="edit-change-password-info">
		<legend>
			<span class="psg-edit-change-password-heading"><?php esc_html_e( 'Change Password', 'woocommerce' ); ?> </span>
			<label class="psg_password_enable_wrp">
				<input type="checkbox" name="psg_password_enable" id="psg_password_enable">
				<span class="psg_password_enable"></span>
			</label>
			
		</legend>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-wide custom-edit-account-password-field1">
			<label for="password_current"><?php esc_html_e( 'Current Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" placeholder="Enter Current Password" autocomplete="off" disabled />
		</p>
		<div class="clear"></div>
		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-wide custom-edit-account-password-field2">
			<label for="password_1"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" placeholder="New Password" autocomplete="off" disabled />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-wide custom-edit-account-password-field3">
			<label for="password_2"><?php esc_html_e( 'Confirm Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" placeholder="Confirm Password" autocomplete="off" disabled />
		</p>
		<div class="clear"></div>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>
	<div class="edit-profile-bottom-main">
	<p class="edit-profile-btn-bottom">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> custom-edit-account-btn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><span><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></span><i class="fal fa-horizontal-rule"></i></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>
    </div>
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</div>
</form>



<?php do_action( 'woocommerce_after_edit_account_form' ); ?>