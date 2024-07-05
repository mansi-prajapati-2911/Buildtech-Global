<?php 
add_shortcode( 'psg_custom_register_sc', 'bbloomer_separate_registration_form' );
    
function bbloomer_separate_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) {
        wp_redirect( wc_get_account_endpoint_url('edit-account') ); // Redirect to the edit account page
        exit;
   }
    ob_start();
 
   // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
   // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
 
   ?>

<div class="psg-woocommrece-login-wrp ">
	<div class="psg-woocommrece-login psg-woocommrece-register ">
		<div class="psg-register-form-error-wrp">  
			<?php  do_action( 'woocommerce_before_customer_login_form' ); ?>
		</div>
		<div class="psg-woocommrece-login-inner">
			<div class="psg-woocommrece-login-heading">
				<h2><?php esc_html_e( 'Signup', 'woocommerce' ); ?></h2>

				<p class="psg-woo-login-subtext">Please fill in the following to create an account</p>
			</div>
			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> enctype="multipart/form-data">

				<?php do_action( 'woocommerce_register_form_start' ); ?>


				<?php  //if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
				<!-- 			  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php //echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Username"/> -->
				<?php  //endif; ?>


				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email Address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Enter your Email Address" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>


				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<span class="password-input">
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Enter your Password" name="password" id="reg_password" autocomplete="new-password"/>
					</span>
				<div id="password-strength-meter"></div>
				<span class="password-strength-meter-hint">Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).</span>
				</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<span class="password-input">
					<input type="password" class="input-text" name="password2" id="reg_password2" placeholder="Confirm Password" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
				</span>
			</p>

			<p class="form-row terms wc-terms-and-conditions">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" /> <span class="psg-register-terms"><?php printf( __( 'I agree with <a href="%s" target="_blank" class="woocommerce-terms-and-conditions-link">terms and conditions *</a>', 'woocommerce' ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?></span>
				</label>
				<input type="hidden" name="terms-field" value="1" />
			</p>


			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<button type="submit" id="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Sign Up', 'woocommerce' ); ?>"><span><?php esc_html_e( 'Sign Up', 'woocommerce' ); ?></span><i class="fal fa-horizontal-rule"></i></button>

			<p class="psg-login-bottom-text">Already have an account? <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">Log in here</a></p>

			<div class="clear"></div>


			<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
	</div>
</div>
</div>
   <?php
     
   return ob_get_clean();
}

?>