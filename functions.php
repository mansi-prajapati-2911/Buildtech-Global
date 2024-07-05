<?php
include_once 'custom-elementor.php';
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */




if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '2.3.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_load_textdomain', [ true ], '2.0', 'hello_elementor_load_textdomain' );
		if ( apply_filters( 'hello_elementor_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-elementor', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_menus', [ true ], '2.0', 'hello_elementor_register_menus' );
		if ( apply_filters( 'hello_elementor_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-1' => __( 'Primary', 'hello-elementor' ) ) );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_theme_support', [ true ], '2.0', 'hello_elementor_add_theme_support' );
		if ( apply_filters( 'hello_elementor_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'editor-style.css' );
			
			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_elementor_add_woocommerce_support' );
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				remove_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
				
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

require_once( get_template_directory() . '/custom-register.php' );
require_once( get_template_directory() . '/theme-functions.php' );
require_once( get_template_directory() . '/woocommerce-functions.php' );
require_once( get_template_directory() . '/psg-post-functions.php' );

/**
 * Enqueue styles.
 */
add_action( 'elementor/frontend/after_register_styles', function () {
	foreach ( [ 'solid', 'regular', 'brands' ] as $style ) {
		wp_deregister_style( 'elementor-icons-fa-' . $style );
		wp_deregister_style( 'font-awesome-5-all-css' );
		wp_deregister_style( 'font-awesome' );
	}
}, 20 );



add_action('wp_enqueue_scripts', 'insignia_basic_enqueue_scripts');
function insignia_basic_enqueue_scripts() {
	
	wp_deregister_style( 'font-awesome' );
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css'); 
	wp_enqueue_style('line-awesome', get_template_directory_uri() . '/assets/css/line-awesome.css');
	wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/css/slick.css'); 
	wp_enqueue_style('bootstrap-min-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css'); 
	
	//wp_enqueue_style('custom-woocommerce', get_template_directory_uri() . '/assets/css/custom-woocommerce.css'); 
	wp_enqueue_style('custom-woocommerce', get_template_directory_uri() . '/assets/css/custom-woocommerce.css', array(), filemtime(get_template_directory() . '/assets/css/custom-woocommerce.css'), false);
	
	//wp_enqueue_style('psg', get_template_directory_uri() . '/assets/css/psg.css');
	wp_enqueue_style('psg', get_template_directory_uri() . '/assets/css/psg.css', array(), filemtime(get_template_directory() . '/assets/css/psg.css'), false);
	
	//wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom.css');	
	wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom.css', array(), filemtime(get_template_directory() . '/assets/css/custom.css'), false);
	
	//wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper.min.css');
		
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'));
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'));
	wp_enqueue_script('bootstrap-min-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('swiper-bundle', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'));
	wp_enqueue_script('magnific-js', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'));
	wp_enqueue_script('lottie-player', get_template_directory_uri() . '/assets/js/lottie-player.js', array('jquery'));
	
}


/** Start PSG css and js **/

add_action('get_footer', 'insignia_add_footer_styles');
function insignia_add_footer_styles() {
	//wp_enqueue_style('psg-media', get_template_directory_uri() . '/assets/css/psg-media.css');
	wp_enqueue_style('psg-media', get_template_directory_uri() . '/assets/css/psg-media.css', array(), filemtime(get_template_directory() . '/assets/css/psg-media.css'), false);
	wp_enqueue_script('psg-custom-pagination-js', get_template_directory_uri() . '/assets/js/psg-custom-pagination.js', array('jquery'));
}

/** End PSG css and js **/


if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
    /**
     * Theme Scripts & Styles.
     *
     * @return void
     */
    function hello_elementor_scripts_styles() {
        $enqueue_basic_style = apply_filters_deprecated( 'elementor_hello_theme_enqueue_style', [ true ], '2.0', 'hello_elementor_enqueue_style' );
        $min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        if ( apply_filters( 'hello_elementor_enqueue_style', $enqueue_basic_style ) ) {
            wp_enqueue_style(
                'hello-elementor',
                get_template_directory_uri() . '/style' . $min_suffix . '.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
        }

        if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
            wp_enqueue_style(
                'hello-elementor-theme-style',
                get_template_directory_uri() . '/theme' . $min_suffix . '.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
    /**
     * Register Elementor Locations.
     *
     * @param ElementorPro\Modules\ThemeBuilder\Classeget_posts_from_cats\Locations_Manager $elementor_theme_manager theme manager.
     *
     * @return void
     */
    function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
        $hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_elementor_locations', [ true ], '2.0', 'hello_elementor_register_elementor_locations' );
        if ( apply_filters( 'hello_elementor_register_elementor_locations', $hook_result ) ) {
            $elementor_theme_manager->register_all_core_location();
        }
    }
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
    /**
     * Set default content width.
     *
     * @return void
     */
    function hello_elementor_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
    }
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );


if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
    /**
     * Check hide title.
    *
     * @param bool $val default value.
     *
     * @return bool
     */
    function hello_elementor_check_hide_title( $val ) {
        if ( defined( 'ELEMENTOR_VERSION' ) ) {
            $current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
            if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
                $val = false;
            }
        }
        return $val;
    }
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
    function hello_elementor_body_open() {
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        } else {
            do_action( 'wp_body_open' );
        }

}
}

//************************************************//
//**** PSG Custom Multiaddress Error Message ****//
//**********************************************//

//Shipping Error Message Function 
function psg_shipping_custom_errors(){
	static $wp_error; // Will hold global variable safely
	return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}
add_action('init', 'psg_shipping_custom_errors');

function multipleaddress_shipping_error_messages() {
	if($codes = psg_shipping_custom_errors()->get_error_codes()) {
		echo '<div class="customer_errors">';
		// Loop error codes and display errors
		foreach($codes as $code){
			$message = psg_shipping_custom_errors()->get_error_message($code);
			echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		}
		echo '</div>';
	}
}
function multipleaddress_shipping_update_error_messages() {
	if($codes = psg_shipping_custom_errors()->get_error_codes()) {
		echo '<div class="customer_errors">';
		// Loop error codes and display errors
		foreach($codes as $code){
			$message = psg_shipping_custom_errors()->get_error_message($code);
			echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		}
		echo '</div>';
	}
}

// Billing Error Message Function 
function psg_billing_custom_errors(){
	static $wp_error; // Will hold global variable safely
	return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}
add_action('init', 'psg_billing_custom_errors');
function multipleaddress_billing_error_messages() {
	if($codes = psg_billing_custom_errors()->get_error_codes()) {
		echo '<div class="customer_errors">';
		// Loop error codes and display errors
		foreach($codes as $code){
			$message = psg_billing_custom_errors()->get_error_message($code);
			echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		}
		echo '</div>';
	}
}
function multipleaddress_billing_update_error_messages() {
	if($codes = psg_billing_custom_errors()->get_error_codes()) {
		echo '<div class="customer_errors">';
		// Loop error codes and display errors
		foreach($codes as $code){
			$message = psg_billing_custom_errors()->get_error_message($code);
			echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		}
		echo '</div>';
	}
}

//********************************************************//
//**** PSG Custom Multiaddress Insert & Update Action ****//
//********************************************************//

function psg_multiple_address(){
// Shipping Address Insert Data
if(isset($_POST['psg_multiple_shipping_address_button']) && wp_verify_nonce($_POST['psg_multiple_shipping_address_nonce'], 'psg_multiple_shipping_address_nonce')) {
        $user_id = get_current_user_id();
        $recip_name = $_POST['recipient_name_ship'];
        $street_address = $_POST['street_address_ship'];
        $unit_no = $_POST['unit_no_ship'];
        $postal_code = $_POST['postal_code_ship'];
        $phone_no = $_POST['phone_no_ship'];
        
		if(empty($recip_name)){
			psg_shipping_custom_errors()->add('name_empty', __('Please Enter Recipient Name'));
		}
		if(empty($street_address)){
			psg_shipping_custom_errors()->add('address_empty', __('Please Enter Address'));
		}
		if(empty($unit_no)){
			psg_shipping_custom_errors()->add('unitno_empty', __('Please Enter Unit No.'));
		}
		if(empty($postal_code)){
			psg_shipping_custom_errors()->add('postalcode_empty', __('Please Enter Postal Code'));
		}
		if(empty($phone_no)){
			psg_shipping_custom_errors()->add('phoneno_empty', __('Please Enter Phone No.'));
		}
	    
	    $errors = psg_shipping_custom_errors()->get_error_messages();
		if(empty($errors)){
			$psg_old_address = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true );

			if(!empty($psg_old_address)){
				$addresses = $psg_old_address;
				array_push($addresses,array($user_id,$recip_name,$street_address,$unit_no,$postal_code,$phone_no));
			}
			else{
				$addresses = array(array($user_id,$recip_name,$street_address,$unit_no,$postal_code,$phone_no));
			}

			update_user_meta( $user_id, 'psg_custom_multiaddress_data', $addresses );
			wp_redirect(wc_get_account_endpoint_url('edit-address'));
			exit();
		}	  
}

// Billing Address Insert Data
if(isset($_POST['psg_multiple_billing_address_button']) && wp_verify_nonce($_POST['psg_multiple_billing_address_nonce'], 'psg_multiple_billing_address_nonce')) {
        $user_id = get_current_user_id();
        $sender_name = $_POST['sender_name_billing'];
        $street_address = $_POST['street_address_billing'];
        $unit_no = $_POST['unit_no_billing'];
        $postal_code = $_POST['postal_code_billing'];
        $email = $_POST['email_billing'];
        $phone_no = $_POST['phone_no_billing'];	
        $psg_old_address = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
       
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			psg_billing_custom_errors()->add('email_valid', __('Please Enter Valid Email Address.'));
// 			wp_redirect(wc_get_account_endpoint_url('edit-address') . "?billing-error='1'");
		}
		if(empty($sender_name)){
			psg_billing_custom_errors()->add('name_empty', __('Please Enter Sender Name.'));
		}
		if(empty($street_address)){
			psg_billing_custom_errors()->add('address_empty', __('Please Enter Street Address.'));
		}
		if(empty($postal_code)){
			psg_billing_custom_errors()->add('postalcode_empty', __('Please Enter Postal Code.'));
		}
		if(empty($phone_no)){
			psg_billing_custom_errors()->add('phone_empty', __('Please Enter Phone No.'));
		}

	    $errors = psg_billing_custom_errors()->get_error_messages();
	    if(empty($errors)){
			if(!empty($psg_old_address)){   
				$addresses = $psg_old_address;
				array_push($addresses,array($user_id,$sender_name,$street_address,$unit_no,$postal_code,$email,$phone_no));
			}
			else{
				$addresses = array(array($user_id,$sender_name,$street_address,$unit_no,$postal_code,$email,$phone_no));
			}
			update_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', $addresses );
			wp_redirect(wc_get_account_endpoint_url('edit-address'));
			exit();
		}
       
}
	
// Billing Address Update Data	
if(isset($_POST['psg_multiple_billing_add_update_button']) && wp_verify_nonce($_POST['psg_multiple_billing_add_update_nonce'], 'psg_multiple_billing_add_update_nonce')) {
        $user_id = get_current_user_id();
        $recip_name = $_POST['recipient_name_billing'];
        $street_address = $_POST['street_address_billing'];
        $unit_no = $_POST['unit_no_billing'];
        $postal_code = $_POST['postal_code_billing'];
	    $email = $_POST['email_billing'];
        $phone_no = $_POST['phone_no_billing'];
	    $address_id = $_POST['psg_update_addressid'];
	   
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			psg_billing_custom_errors()->add('email_valid', __('Please Enter Valid Email Address.'));
		}
		if(empty($recip_name)){
			psg_billing_custom_errors()->add('name_empty', __('Please Enter Sender Name.'));
		}
		if(empty($street_address)){
			psg_billing_custom_errors()->add('address_empty', __('Please Enter Street Address.'));
		}
		if(empty($unit_no)){
			psg_billing_custom_errors()->add('unitno_empty', __('Please Enter Unit No.'));
		}
		if(empty($postal_code)){
			psg_billing_custom_errors()->add('postalcode_empty', __('Please Enter Postal Code.'));
		}
		if(empty($phone_no)){
			psg_billing_custom_errors()->add('phone_empty', __('Please Enter Phone No.'));
		}

	    $errors = psg_billing_custom_errors()->get_error_messages();
	    if(empty($errors)){
			$psg_update_address = array($user_id,$recip_name,$street_address,$unit_no,$postal_code,$email,$phone_no);
			$get_address_data = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
			foreach($get_address_data as $get_address_data_key => $get_address_data_value){
				if(array_key_exists($address_id ,$get_address_data )){
					$psg_match_address_data = $get_address_data[$address_id];
					$updated_data =  array_replace($psg_match_address_data,$psg_update_address);
					$get_address_data[$address_id] = $updated_data;
					break;
				}
			}
			update_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', $get_address_data );
			wp_redirect(wc_get_account_endpoint_url('edit-address'));
			exit();
		}
	   
}	
	
	
// Shipping Address Update Data	
if(isset($_POST['psg_multiple_ship_add_update_button']) && wp_verify_nonce($_POST['psg_multiple_ship_add_update_nonce'], 'psg_multiple_ship_add_update_nonce')) {
        $user_id = get_current_user_id();
        $recip_name = $_POST['recipient_name_ship'];
        $street_address = $_POST['street_address_ship'];
        $unit_no = $_POST['unit_no_ship'];
        $postal_code = $_POST['postal_code_ship'];
        $phone_no = $_POST['phone_no_ship'];
	    $address_id = $_POST['psg_update_addressid'];
	
		if(empty($recip_name)){
			psg_shipping_custom_errors()->add('name_empty', __('Please Enter Recipient Name'));
		}
		if(empty($street_address)){
			psg_shipping_custom_errors()->add('address_empty', __('Please Enter Address'));
		}
		if(empty($unit_no)){
			psg_shipping_custom_errors()->add('unitno_empty', __('Please Enter Unit No.'));
		}
		if(empty($postal_code)){
			psg_shipping_custom_errors()->add('postalcode_empty', __('Please Enter Postal Code'));
		}
		if(empty($phone_no)){
			psg_shipping_custom_errors()->add('phoneno_empty', __('Please Enter Phone No.'));
		}
	
	     $errors = psg_shipping_custom_errors()->get_error_messages();
	
	    if(empty($errors)){
			$psg_update_address = array($user_id,$recip_name,$street_address,$unit_no,$postal_code,$phone_no);
			$get_address_data = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true );
			foreach($get_address_data as $get_address_data_key => $get_address_data_value){
				if(array_key_exists($address_id ,$get_address_data )){
					$psg_match_address_data = $get_address_data[$address_id];
					$updated_data =  array_replace($psg_match_address_data,$psg_update_address);
					$get_address_data[$address_id] = $updated_data;
					break;
				}
			}
			update_user_meta( $user_id, 'psg_custom_multiaddress_data', $get_address_data );
			wp_redirect(wc_get_account_endpoint_url('edit-address'));
			exit();
		}	   
}
	
// Woocommerce default Form Update 	
if(isset($_POST['default_form_save_address']) && wp_verify_nonce($_POST['psg_default_form_update_nonce'], 'psg_default_form_update_nonce')) {
	$user_id = get_current_user_id();
	$form_name = $_POST['psg_default_form_name'];
	$full_name = $_POST[$form_name.'_name'];
	$street_address = $_POST[$form_name.'_street_address'];
	$unit_no = $_POST[$form_name.'_unit_no'];
	$postal_code = $_POST[$form_name.'_postal_code'];
	$email = $_POST[$form_name.'_email'];
	$phone_no = $_POST[$form_name.'_phone_no'];

	update_user_meta( $user_id, $form_name.'_full_name', $full_name );
	update_user_meta( $user_id, $form_name.'_first_name', $full_name );
	update_user_meta( $user_id, $form_name.'_address_1', $street_address );
	update_user_meta( $user_id,  $form_name.'_address_2', $unit_no );
	update_user_meta( $user_id, $form_name.'_postcode', $postal_code );
	update_user_meta( $user_id, $form_name.'_phone', $phone_no );
	if($form_name != 'shipping'){
		update_user_meta( $user_id, $form_name.'_email', $email );
	}
	 wp_redirect(wc_get_account_endpoint_url('edit-address'));
	exit();
}		
}
add_action('init', 'psg_multiple_address');



//***********************************************//
//**** PSG Custom Multiaddress Delete Action ****//
//***********************************************//
add_action( 'wp_ajax_psg_multi_address_delete', 'psg_multi_address_delete_callback' );
add_action( 'wp_ajax_nopriv_psg_multi_address_delete', 'psg_multi_address_delete_callback' );
function psg_multi_address_delete_callback(){
	$user_id = $_POST['user_id']; // get user id
	$adrress_id = $_POST['address_ids']; // get address id (array key)
	$psg_data = $_POST['psg_data']; // get billing and shipping data delete
	$user_ids = get_current_user_id();
	if($psg_data == 'billing_data'){
		$get_billing_adderss = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
		if(array_key_exists($adrress_id,$get_billing_adderss)){
			unset($get_billing_adderss[ $adrress_id ]);
			update_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', $get_billing_adderss );
		}
		$psg_set_default_address = get_user_meta( $user_id, 'set_default_address_billing', true );
		$ajax_address_data = get_user_meta( $user_ids, 'psg_custom_multiaddress_billing_data', true );
		$i = 1;
		foreach($ajax_address_data as $ajax_add_data_key => $ajax_add_data_value ){
		?>
		<div class="psg-custom-address-book-inner">
			<div class="psg-ab-address">
				<h5 class="psg-name"><?php echo $ajax_add_data_value[1]; ?></h5>
				<p class="pcd-address-row">
					<span class="psg-email"><?php echo $ajax_add_data_value[5]; ?></span>
					<span class="psg-ab-seprator">|</span>
					<span class="psg-phone-no"><?php echo $ajax_add_data_value[6]; ?></span>
				</p> 
				<p class="psd-street-address">
					<?php echo $ajax_add_data_value[2];?>, 
					<?php if(!empty($ajax_add_data_value[3])){ echo $ajax_add_data_value[3] . ","; } ?> 
					<?php echo $ajax_add_data_value[4]; ?>
				</p>
			</div> 

			<div class="psg-custom-address-book-action">
				<div class="psg-custom-address-button">
					<span class="psg_set_defult_address_main_wrp">
						<input type="radio" class="psg_set_defult_address_shipping" name="psg_default_address_shipping" id="psg_default_address_shipping_<?php echo $i; ?>" data-userid="<?php echo $user_id; ?>" data-addressid="<?php echo $ajax_add_data_key; ?>" <?php echo ($psg_set_default_address != 'billing' && $psg_set_default_address == $ajax_add_data_key) ? 'checked' : "" ;?>/>
						<label for="psg_default_address_shipping_<?php echo $i; ?>">Set Default Address</label>
					</span>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button">
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'psg_shipping' ) ); ?>?address_id=<?php echo $ajax_add_data_key ?>" class="edit"><i class="fal fa-pen"></i> <span>Edit</span></a>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button psg-custom-address-button-delete">
					<button id="psg_mul_add_delete_button" name="psg_mul_add_delete_button" data-userid="<?php echo $ajax_add_data_value[0]; ?>" data-addressid="<?php echo $ajax_add_data_key; ?>"  class="psg_mul_address_delete_button_billing" type="submit" >
						<i class="fal fa-trash-alt"></i> <span>Delete</span>
					</button>
				</div>
			</div>

		</div>
		<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		  jQuery(".psg_mul_address_delete_button_billing").click(function(){
			  var parent_class = jQuery(this).parent('.psg-custom-address-button-delete');
			  var user_id = jQuery(this).data("userid");
			  var address_id = jQuery(this).data("addressid");
			jQuery.ajax
				  ({
				  url: ajaxurl,
				  dataType: "html",
				  type: "POST",
				  data:
					{
					  "user_id" : user_id,
					  "address_ids" : address_id,
					  "psg_data" :'billing_data',
					  "action" : "psg_multi_address_delete"
					},
					beforeSend: function() {
						jQuery(parent_class).html('<img src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
					},
					success: function(data)
					{
						jQuery(".psg-custom-billing-address").html(data);
					},
				  });
		 });
			jQuery('.psg_set_defult_address').on('click', function(e) {
				var child_lable = jQuery(this).parent(".psg_set_defult_address_main_wrp");
				var user_id = jQuery(this).data('userid');
				var address_id = jQuery(this).data('addressid');
				jQuery.ajax({
					url: ajaxurl,
					dataType: "html",
					type: "POST",
					data:
					{
						"user_id" : user_id,
						"address_ids" : address_id,
						"action" : "psg_set_default_address"
					},
					beforeSend: function() {
						jQuery(child_lable).addClass("psg_loader_gif")
						jQuery(child_lable).prepend('<img class="psg_defu_add_load" src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
					},
					success: function(data)
					{
						jQuery(child_lable).removeClass('psg_loader_gif');
						jQuery(".psg_defu_add_load").remove();
					},
				});

			});
		</script>
		<?php
			$i++;
		}
	}
	else{
		$get_shipping_adderss = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true );
		if(array_key_exists($adrress_id,$get_shipping_adderss)){
			unset($get_shipping_adderss[ $adrress_id ]);
			update_user_meta( $user_id, 'psg_custom_multiaddress_data', $get_shipping_adderss );
		}
		$psg_set_default_address_shipping = get_user_meta( $user_id, 'set_default_address_shiiping', true );
		$ajax_address_data = get_user_meta( $user_ids, 'psg_custom_multiaddress_data', true );
		$i = 1;
		foreach($ajax_address_data as $ajax_add_data_key => $ajax_add_data_value ){
	?>
		<div class="psg-custom-address-book-inner">
			<div class="psg-ab-address">
				<h5 class="psg-name"><?php echo $ajax_add_data_value[1]; ?></h5>
				<p class="psg-phone-no"><?php echo $ajax_add_data_value[5]; ?></p>
				<p class="psg-street-address">
					<?php echo $ajax_add_data_value[2];?>,
					<?php if(!empty($ajax_add_data_value[3])){echo $ajax_add_data_value[3] . ",";} ?>
					<?php echo $ajax_add_data_value[4]; ?>
				</p>
			</div>
			<div class="psg-custom-address-book-action">
				<div class="psg-custom-address-button">
					<span class="psg_set_defult_address_main_wrp">
						<input type="radio" class="psg_set_defult_address_shipping" name="psg_default_address_shipping" id="psg_default_address_shipping_<?php echo $i; ?>" data-userid="<?php echo $user_id; ?>" data-addressid="<?php echo $ajax_add_data_key; ?>" <?php echo ($psg_set_default_address_shipping != 'billing' && $psg_set_default_address_shipping == $ajax_add_data_key) ? 'checked' : "" ;?>/>
						<label for="psg_default_address_shipping_<?php echo $i; ?>">Set Default Address</label>
					</span>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button">
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'psg_billing' ) ); ?>?address_id=<?php echo $ajax_add_data_key ?>" class="edit"><i class="fal fa-pen"></i> <span>Edit</span></a>
				</div>
				<span class="psg-btn-seprator"></span>
				<div class="psg-custom-address-button psg-custom-address-button-delete">
					<button id="psg_mul_add_delete_button" name="psg_mul_add_delete_button" data-userid="<?php echo $ajax_add_data_value[0]; ?>" data-addressid="<?php echo $ajax_add_data_key; ?>"  class="psg-mul-address-delete-button" type="submit" >
						<i class="fal fa-trash-alt"></i> <span>Delete</span>
					</button>
				</div>
			</div>
		</div>

	<?php
			$i++;
	}
		?>
	<script type="text/javascript">
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	  jQuery(".psg-mul-address-delete-button").click(function(){
		  var parent_class = jQuery(this).parent('.psg-custom-address-button-delete');
		  var user_id = jQuery(this).data("userid");
		  var address_id = jQuery(this).data("addressid");
		jQuery.ajax
			  ({
			  url: ajaxurl,
			  dataType: "html",
			  type: "POST",
			  data:
				{
				  "user_id" : user_id,
				  "address_ids" : address_id,
				  "action" : "psg_multi_address_delete"
				},
				beforeSend: function() {
					jQuery(parent_class).html('<img class="psg_defu_add_load" src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
				},
				success: function(data)
				{
					jQuery("#psg_custom_address_ship_main").html(data);
				},
			  });
	 });
		jQuery('.psg_set_defult_address_shipping').on('click', function(e) {
			var child_lable = jQuery(this).parent(".psg_set_defult_address_main_wrp");
			var user_id = jQuery(this).data('userid');
			var address_id = jQuery(this).data('addressid');
			jQuery.ajax({
				url: ajaxurl,
				dataType: "html",
				type: "POST",
				data:
				{
					"user_id" : user_id,
					"address_ids" : address_id,
					"action" : "psg_set_default_address_shipping"
				},
				beforeSend: function() {
					jQuery(child_lable).addClass("psg_loader_gif")
					jQuery(child_lable).prepend('<img class="psg_defu_add_load" src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
				},
				success: function(data)
				{
					jQuery(child_lable).removeClass('psg_loader_gif');
					jQuery(".psg_defu_add_load").remove();
				},
			});

		});
	</script>
<?php
	}
	exit();
}



add_action( 'wp_ajax_psg_default_address_delete', 'psg_default_address_delete_callback' );
add_action( 'wp_ajax_nopriv_psg_default_address_delete', 'psg_default_address_delete_callback' );
function psg_default_address_delete_callback(){
	$user_id = $_POST['user_id']; // get user id
	$adrress = $_POST['address_ids']; // get address ( Ex: billing and shipping)
	
	update_user_meta( $user_id, $adrress.'_full_name', "" );
	update_user_meta( $user_id, $adrress.'_address_1', "" );
	update_user_meta( $user_id, $adrress.'_address_2', "" );
	update_user_meta( $user_id, $adrress.'_postcode', "" );
	update_user_meta( $user_id, $adrress.'_phone', "" );
	if($adrress != 'shipping'){
		update_user_meta( $user_id, $adrress.'_email', "" );
	}
	?>
	<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		jQuery(".psg_defu_address_delete_button").click(function(){
			var parent_class = jQuery(this).parent('.psg-custom-address-button-delete');
			var user_id = jQuery(this).data("userid");
			var address_id = jQuery(this).data("addressid");
			jQuery.ajax
			({
				url: ajaxurl,
				dataType: "html",
				type: "POST",
				data:
				{
					"user_id" : user_id,
					"address_ids" : address_id,
					"action" : "psg_default_address_delete"
				},
				beforeSend: function() {
					jQuery(parent_class).html('<img src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
				},
				success: function(data)
				{
					jQuery("#psg_custom_address_"+address_id+"_default").html(data);
				},
			});
			.preventDefault();
		});	
	</script>

	<?php
	
	exit();
}


add_action( 'wp_ajax_psg_set_default_address', 'psg_set_default_address_callback' );
add_action( 'wp_ajax_nopriv_psg_set_default_address', 'psg_set_default_address_callback' );
function psg_set_default_address_callback(){
	$user_id = $_POST['user_id'];
	$address_id = $_POST['address_ids'];
	update_user_meta( $user_id, 'set_default_address_billing', $address_id );
	exit();
}
add_action( 'wp_ajax_psg_set_default_address_shipping', 'psg_set_default_address_shipping_callback' );
add_action( 'wp_ajax_nopriv_psg_set_default_address_shipping', 'psg_set_default_address_shipping_callback' );
function psg_set_default_address_shipping_callback(){
	$user_id = $_POST['user_id'];
	$address_id = $_POST['address_ids'];
	update_user_meta( $user_id, 'set_default_address_shiiping', $address_id );
	exit();
}


/** Start add shipping method name in checkout order review **/

add_action( 'woocommerce_review_order_before_order_total', 'get_shipping_name_by_id', 5 );
function get_shipping_name_by_id( $chosen_shipping_methods ) {
	
	$chosen_shipping_method = WC()->session->get( 'chosen_shipping_methods' );
	$packages = WC()->shipping()->get_packages();
	$package = $packages[0];
	$available_methods = $package['rates'];
	
	foreach ($available_methods as $key => $method) {
		if($chosen_shipping_method[0] == $method->id){ ?>
			<span class="psg-checkout-chosen-method"><?php echo $method->label; ?> - Preferred </span>
			<span class="psg-checkout-chosen-date"></span>
			<span class="psg-checkout-chosen-time"></span>
		<?php }
	}	
	?>
	<script type="text/javascript">
		var val = jQuery( '.psg-checkout-notification-main-wrp .wlpr_points_rewards_earn_message .wlpr-message-info strong' ).text();
		jQuery(".psg-checkout-form-point-wrp .wlpr_points_rewards_earn_message").text(val);
	</script>
<?php
}

// Add custom script to update delivery date on change
add_action( 'wp_footer', 'update_delivery_date_time_script' );
function update_delivery_date_time_script() {
    // Only run on checkout page
    if ( is_checkout() && ! is_wc_endpoint_url() ) :
    ?>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
		
        $('body').on('change', '#jckwds-delivery-date', function() {
            var deliveryDate = $('#jckwds-delivery-date').val();
						
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action': 'update_delivery_date',
                    'delivery_date': deliveryDate,
                },
                success: function (result) {
					var delivery_date = result.data;
					
					var dateComponents = delivery_date.split('/');
					var day = dateComponents[0];
					var month = dateComponents[1];
					var year = dateComponents[2];					
					var monthNames = [
						"Jan", "Feb", "Mar",
						"Apr", "May", "Jun", "Jul",
						"Aug", "Sep", "Oct",
						"Nov", "Dec"
					];
					
					var formattedDate = day + " " + monthNames[month-1] + " " + year + ",";					
					jQuery( 'span.psg-checkout-chosen-date' ).html(formattedDate);
                },
            });
        });
		
		
		$('body').on('change', '#jckwds-delivery-time', function() {
            var selectElement = $('#jckwds-delivery-time');

			// Get the selected option
			var selectedOption = selectElement.find('option').filter(function() {
			  return $(this).is(':selected');
			});

			// Get the option value and text
			var optionValue = selectedOption.val();
			var optionText = selectedOption.text();
			//var timeSlot = optionText.substring(0, optionText.indexOf(" - "));													
						
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action': 'update_delivery_time',
                    'delivery_time': optionText,
                },
                success: function (result) {
                    var delivery_time = result.data;    
                    
                    jQuery( 'span.psg-checkout-chosen-time' ).html(optionText);
                },
            });
        });
		
    });
    </script>	
    <?php
    endif;
}


// Add custom function to update delivery date value
add_action( 'wp_ajax_update_delivery_date', 'update_delivery_date' );
add_action( 'wp_ajax_nopriv_update_delivery_date', 'update_delivery_date' );
function update_delivery_date() {
    $delivery_date = $_POST['delivery_date'];
	
    WC()->session->set('jckwds_delivery_date', $delivery_date);
    wp_send_json_success( $delivery_date );
	
}

// Add custom function to update delivery time value
add_action( 'wp_ajax_update_delivery_time', 'update_delivery_time' );
add_action( 'wp_ajax_nopriv_update_delivery_time', 'update_delivery_time' );
function update_delivery_time() {
	$delivery_time = $_POST['delivery_time'];
	
	WC()->session->set('jckwds_delivery_time', $delivery_time);
	wp_send_json_success( $delivery_time ); 		
}

?>