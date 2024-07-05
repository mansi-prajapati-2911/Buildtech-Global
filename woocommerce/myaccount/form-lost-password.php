<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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


?>

<div class="psg-woocommrece-login-wrp">
<div class="psg-woocommrece-login psg-woocommrece-password-reset">
	<?php do_action( 'woocommerce_before_lost_password_form' ); ?>
		<div class="psg-woocommrece-login-inner">
		<form method="post" class="woocommerce-ResetPassword lost_reset_password">
		<div class="psg-woocommrece-login-heading">
			<h2><?php esc_html_e( 'Forgot Password', 'woocommerce' ); ?></h2>
				<p class="psg-woo-login-subtext"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Please enter your email and we will send you a password reset link', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
		</div>


	<p class="woocommerce-form-row woocommerce-form-row--first form-row">
		<label for="user_login"><?php esc_html_e( 'Email Address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Enter your Email Address" type="text" name="user_login" id="user_login" autocomplete="username" required="required" />
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row psg-forgot-password-submit-wrp">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><span><?php esc_html_e( 'Send Request', 'woocommerce' ); ?></span><i class="fal fa-horizontal-rule"></i></button>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
	</div>
</div>
</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );
