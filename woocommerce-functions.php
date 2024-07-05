<?php
/** Start Woocommerce email template **/

add_filter('wp_mail_from_name', 'wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return 'PSG'; // Edit it with project name
}

// Change Email to HTML function
function set_email_html_content_type() {
    return 'text/html';
}


//Remove actionfor Result Count in Shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


// Replace the default password change email (in HTML change PSG to Your Project Name)
add_filter('password_change_email', 'change_password_mail_message', 10, 3);
function change_password_mail_message( $change_mail, $user, $userdata ) {

    // Call Change Email to HTML function
    add_filter( 'wp_mail_content_type', 'set_email_html_content_type' );
    $message = '<div style="width: 65%;">
	
	
	<div class="form-notification-title appointment-notification-title" style="background: #59656F; padding: 20px 30px; display:flex; align-items:center;"><img class="alignnone size-medium wp-image-1097" style="width: 130px; height: auto; object-fit: contain;" src="https://projs.ifdemo.com/p15/buildtech-global/wp-content/uploads/2023/07/logo.png" alt="" /><h3 style="color: #FFFFFF; font-weight: 500; font-size: 24px; padding-left: 10px;">Password Changed Successfully</h3></div>
	
	<div style="padding: 0 30px; color: #151B20; font-size: 14px;"><p>Hi ###USERNAME###,</p>
    <p>This notice confirms that your password was changed on PSG.</p>

    <p>If you did not change your password, please contact the Site Administrator at <a href="mailto:###ADMIN_EMAIL###">###ADMIN_EMAIL###</a></p>

    <p>This email has been sent to <a href="mailto:###EMAIL###">###EMAIL###</a></p>

    <p>Regards,
	All at PSG</p>
    <a href="###SITEURL### ">###SITEURL### </a></div>
	</div>';

    $change_mail[ 'message' ] = $message;
        return $change_mail;

    // Remove filter HTML content type
    remove_filter( 'wp_mail_content_type', 'set_email_html_content_type' );
}

/** End Woocommerce email template **/


/** Start Orders table title rename **/

function new_orders_columns( $columns = array() ) {

    // Hide the columns
    if( isset($columns['order-total']) ) {
        // Unsets the columns which you want to hide
        unset( $columns['order-number'] );
        unset( $columns['order-date'] );
        unset( $columns['order-total'] );
        unset( $columns['order-status'] );
        unset( $columns['order-actions'] );
    }

    // Add new columns
    $columns['order-number'] = __( 'Order Number', 'Text Domain' );
    $columns['order-date'] = __( 'Date', 'Text Domain' );
    $columns['order-total'] = __( 'Total', 'Text Domain' );
    $columns['order-status'] = __( 'Status', 'Text Domain' );
    $columns['order-actions'] = __( 'Action', 'Text Domain' );

    return $columns;
}
add_filter( 'woocommerce_account_orders_columns', 'new_orders_columns' );

/** End Orders table title rename **/


/** Start Rename My account > Orders "view" action button text **/
add_filter( 'woocommerce_my_account_my_orders_actions', 'change_my_account_my_orders_view_text_button', 10, 2 );
function change_my_account_my_orders_view_text_button( $actions, $order ) {
    $actions['view']['name'] = __( 'View Order', 'woocommerce' );

    return $actions;
}
/** End Rename My account > Orders "view" action button text **/


/** Start My account page css **/

add_action('wp_head', 'add_css_head');
function add_css_head() { ?>

	<style>
		.woocommerce-form-coupon-toggle .woocommerce-info:before{
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/coupon.png");
		}		
		.psg-address-book-wrp .psg-custom-address-book-inner .psg-ab-address:before{
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/man-dark.png");
		}
		.psg-cart-page-main-wrp .wlpr_point_redeem_earn_points .wlpr-message-info:before, 
		.psg-checkout-notification-main-wrp .wlpr_point_redeem_earn_points .wlpr-message-info:before {
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/redeem-points-icon.png");
		}
		.psg-checkout-page-left-wrp form.checkout_coupon.woocommerce-form-coupon {
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/coupon-toggle-bg.png");
		}
		.woocommerce-message.psg-coupon-success-msg-main {
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/coupon-success-bg.png");
		}
		.woocommerce-message.psg-coupon-success-msg-main:before {
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/coupon-success-icon.png");
		}
		
	</style>

   <?php
   if( ! is_user_logged_in() && is_account_page() ){ 
   ?>
      <style>
        .woocommerce-account main.site-main {
            width: 100% !important;
            max-width: 100% !important;
        }
		.woocommerce-account #customer_login .u-column1.col-1 {
			margin: 0 !important;
            padding: 180px 110px;
            padding-top: 0px !important;
            padding-bottom: 70px !important;
            background: #F4F4F4;		  
		}
		.woocommerce-account #customer_login .u-column2.col-2 {
			background: #FFFFFF;
			padding: 137px 110px;
			padding-bottom: 70px !important;
		}
        .woocommerce-account .elementor-column-wrap.elementor-element-populated{
            padding: 0 !important;   
        }
        .woocommerce-account main.site-main {
            padding: 0px;
        }
        .woocommerce-account .shop-page-header-main {
            margin: 0 auto;
            display: flex;
            vertical-align: middle;
            align-items: center;
            padding: 20px 40px;
            position: absolute;
            left: 0;
            right: 0;
            z-index: 111;
            height: auto;
        }
        .woocommerce form .form-row {
            padding: 3px;
            margin: 0 0 15px;
        }
        .woocommerce-account .shop-inner-header-wrp {
            width: 100%;
        }
      </style>
   <?php
   }
}

/** End My account page css **/


/** Start My account field validation **/

function action_woocommerce_save_account_details_errors( $args ){
    if ( isset($_POST['image']) && empty($_POST['image1']) ) {
        $args->add( 'image_error', __( 'Please provide a valid image', 'woocommerce' ) );
    }
	
	if ( empty( $_POST['account_display_name'] ) ) {
        $args->add( 'error', __( 'Full Name is required.', 'woocommerce' ),'');
    }
	
	if ( empty( $_POST['billing_gender'] ) ) {
        $args->add( 'error', __( 'Gender is required.', 'woocommerce' ),'');
    }
	
	if ( empty( $_POST['account_email'] ) ) {
        $args->add( 'error', __( 'Email Address is required.', 'woocommerce' ),'');
    }
	
	if ( empty( $_POST['billing_phone'] ) ) {
        $args->add( 'error', __( 'Contact no is required.', 'woocommerce' ),'');
    }
}
add_action( 'woocommerce_save_account_details_errors','action_woocommerce_save_account_details_errors', 10, 1 );

/** End My account field validation **/


/** Start My account save custom image upload **/

function action_woocommerce_save_account_details( $user_id ) {  
    if(isset($_FILES["image1"]["size"]) && !empty($_FILES["image1"]["size"])) {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $attachment_id = media_handle_upload( 'image1', 0 );

        if ( is_wp_error( $attachment_id ) ) {
           update_user_meta( $user_id, 'image1', $_FILES["image1"]["size"] . ": " . $attachment_id->get_error_message() );
        } else {
            update_user_meta( $user_id, 'image1', $attachment_id );
        }
   }
}
add_action( 'woocommerce_save_account_details', 'action_woocommerce_save_account_details', 10, 1 );

/** End My account save custom image upload **/


/** Start disable shipping on cart page **/

function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );

/** End disable shipping on cart page **/


/** Start Edit Profile update data **/

$user_id = get_current_user_id();
function save_additional_account_details( $user_id ){
	
	$billing_email = ! empty( $_POST['billing_email'] ) ? wc_clean( $_POST['billing_email'] ) : '';
    $billing_phone = ! empty( $_POST['billing_phone'] ) ? wc_clean( $_POST['billing_phone'] ) : '';
    $billing_gender = ! empty( $_POST['billing_gender'] ) ? wc_clean( $_POST['billing_gender'] ) : '';	
  
	update_user_meta( $user_id, 'billing_email', $billing_email );
    update_user_meta( $user_id, 'billing_phone', $billing_phone );
    update_user_meta( $user_id, 'billing_gender', $billing_gender );

}
add_action( 'woocommerce_save_account_details', 'save_additional_account_details' );


// Add enctype to form to allow image upload
function action_woocommerce_edit_account_form_tag() {
    echo 'enctype="multipart/form-data"';
} 
add_action( 'woocommerce_edit_account_form_tag', 'action_woocommerce_edit_account_form_tag' );

add_filter( 'woocommerce_save_account_details_required_fields', 'filter_function_name_5166' );
function filter_function_name_5166( $array ){

unset($array['account_first_name']);
unset($array['account_last_name']);
	return $array;
}

/** End Edit Profile update data **/


/** Start Related Products **/

add_filter( 'woocommerce_output_related_products_args', 'bbloomer_change_number_related_products', 9999 );
 
function bbloomer_change_number_related_products( $args ) {
 $args['posts_per_page'] = 7; // # of related products
 $args['columns'] = 4; // # of columns per row
 return $args;
}

/** End Related Products **/


/** Start remove breadcrumb shop page **/

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/** End remove breadcrumb shop page **/


/** Start Remove cross-sells at cart **/
 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display', 15 );

/** End Remove cross-sells at cart **/


/** Start Star in Archive Product page **/

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/** End Star in Archive Product page **/


/** Start action for change position of coupon code in checkout page **/

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 5 );

/** End action for change position of coupon code in checkout page **/


/** Start Increase mini-cart count and price total **/

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;

  ob_start();

  ?>
  <span id="woo-cart-count-text" class="woo-cart-count-text"><?php echo $woocommerce->cart->get_cart_total(); ?> </span>	
  <?php

  $fragments['span.woo-cart-count-text'] = ob_get_clean();	
  	
  return $fragments;

}

add_filter('add_to_cart_fragments', 'woocommerce_minicart_add_to_cart_fragment');

function woocommerce_minicart_add_to_cart_fragment( $fragments ) {
  global $woocommerce;

  ob_start();

  ?>
  <span id="woo-cart-count-inner" class="woo-cart-count-inner"><?php echo $woocommerce->cart->cart_contents_count; ?> </span>	
  <?php

  $fragments['span.woo-cart-count-inner'] = ob_get_clean();	
  	
  return $fragments;

}



add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragments');

function woocommerce_header_add_to_cart_fragments( $fragments ) {
  global $woocommerce;

  ob_start();

  ?>
  <span id="woo-cart-count" class="woo-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
  <?php

  $fragments['span.woo-cart-count'] = ob_get_clean();
  	
  return $fragments;

}
/** End Increase mini-cart count and price total **/


/** Start remove upsell product output **/

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 5 );

/** End remove upsell product output **/


/** Start Related Product Position Change Hook ***/

remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product','woocommerce_output_related_products', 10);

/** End Related Product Position Change Hook **/


/** Start Remove Shipping Label checkout page **/

add_filter( 'woocommerce_shipping_package_name', 'bbloomer_new_shipping_title' );
 
function bbloomer_new_shipping_title() {
   return '<p class="psg-shipping-method-sub-heading">Kindly select one shipping preference.</p>';
}
/** End Remove Shipping Label checkout page **/


/** Start Shipping method should be unselected at checkout **/

add_filter( 'woocommerce_shipping_chosen_method', '__return_false', 99);

add_action( 'template_redirect', 'reset_previous_chosen_shipping_method' );
function reset_previous_chosen_shipping_method() {
    if( is_checkout() && ! is_wc_endpoint_url() && is_user_logged_in() 
    && get_user_meta( get_current_user_id(), 'shipping_method', true ) ) {
        delete_user_meta( get_current_user_id(), 'shipping_method' );
        WC()->session->__unset( 'chosen_shipping_methods' );
    }
}

/** End Shipping method should be unselected at checkout **/


/** Start shipping name & billing name entry in backend **/
// Save the custom billing fields (once order is placed)

add_action( 'woocommerce_checkout_create_order', 'save_custom_billingt_fields', 20, 2 );
function save_custom_billingt_fields( $order, $data ) {
   
    
    if ( isset( $_POST['shipping_full_name'] ) && ! empty( $_POST['shipping_full_name'] ) ) {
		$final_full_name = $_POST['shipping_full_name'];
	}
	
	else{
		$final_full_name = $_POST['billing_full_name'];
	}
	
		$order->update_meta_data('_billing_first_name', $_POST['billing_full_name']);
        update_user_meta( $order->get_customer_id(), 'billing_first_name', $_POST['billing_full_name']  );
        $order->update_meta_data('_shipping_first_name', $final_full_name );
        update_user_meta( $order->get_customer_id(), 'shipping_first_name', $final_full_name );
	
}

/** End shipping name & billing name entry in backend **/


/** Start Custom Register Submit **/

// 1. VALIDATE FIELDS
  
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
  
function bbloomer_validate_name_fields( $errors, $username, $email ) {
	 extract( $_POST );
    if ( strcmp( $password, $password2 ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
    }
	if ( ! isset( $_POST['terms'] ) ) {
       $errors->add( 'terms', __( 'Terms and condition are not checked!', 'woocommerce' ) );
    }
    return $errors;
}

/** End Custom Register Submit **/


/** Start Replace 'An account is already registered with your email address. Please log in.' **/

add_filter( 'woocommerce_registration_error_email_exists', function() {
    return 'An account is already registered with your email address. <a href="'.wc_get_page_permalink( "myaccount" ).'" class="showlogin">Please log in.</a>';
} );

/** End Replace 'An account is already registered with your email address. Please log in.' **/


/** Start Add Singapore bydefault in User account **/

function wooc_save_extra_register_fields( $customer_id ) {  
            update_user_meta( $customer_id, 'billing_country', 'SG' );
            update_user_meta( $customer_id, 'shipping_country', 'SG' );
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );

/** End Add Singapore bydefault in User account **/


/** Start Plus Minus Quantity for Single Product page **/
  
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );
  
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus"><i class="fal fa-minus"></i></button>';
}
  
add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );
  
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus"><i class="fal fa-plus"></i></button>';
}

  
add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
  
function bbloomer_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if ( ! is_product()) return;
   ?>
      <script type="text/javascript">
           
      jQuery(document).ready(function($){   
           
         $('form.cart').on( 'click', 'button.plus, button.minus', function() {
  
            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });  
           
      });
           
      </script>
   <?php
}

/** End Plus Minus Quantity for Single Product page **/


/** Start Plus Minus Quantity for Cart page **/

add_action( 'wp_footer', 'psg_add_cart_quantity_plus_minus' );
function psg_add_cart_quantity_plus_minus() {
	
   // Only run this on the single product page
   if ( ! is_cart() ) return;
   ?>
      <script type="text/javascript">
          
     jQuery(document).ready(function($){ 
           
		 $(document).ajaxComplete(function() {
			 $('.cart-custom-quantity-wrp').off('click', 'button.plus, button.minus').on( 'click', 'button.plus, button.minus', function() {
				 //alert("hello");
				 $('.custom-update-cart').prop('disabled', false);
				 // Get current quantity values
				 var qty = $( this ).closest( '.cart-custom-quantity-wrp' ).find( '.qty' );
				 var val   = parseFloat(qty.val());
				 var max = parseFloat(qty.attr( 'max' ));
				 var min = parseFloat(qty.attr( 'min' ));
				 var step = parseFloat(qty.attr( 'step' ));

				 // Change the value if plus or minus
				 if ( $( this ).is( '.plus' ) ) {
					 if ( max && ( max <= val ) ) {
						 qty.val( max );
					 } else {
						 qty.val( val + step );
					 }
				 } else {
					 if ( min && ( min >= val ) ) {
						 qty.val( min );
					 } else if ( val > 1 ) {
						 qty.val( val - step );
					 }
				 }

			 });
		 });
		 
		 
         $('.cart-custom-quantity-wrp').on( 'click', 'button.plus, button.minus', function() {
			$('.custom-update-cart').prop('disabled', false);
            // Get current quantity values
            var qty = $( this ).closest( '.cart-custom-quantity-wrp' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });
           
      });
	           
      </script>
      
   <?php
	
}

/** End Plus Minus Quantity for Cart page **/


/** Start billing_full_name is same as Profile Name **/

add_action( 'woocommerce_save_account_details', 'my_account_saving_billing_user', 20, 1 );
function my_account_saving_billing_user( $user_id ) {
    
    if( isset( $_POST['account_display_name'] ) && $_POST['account_display_name'] != '' ){
        update_user_meta( $user_id, 'billing_full_name', sanitize_text_field( $_POST['account_display_name'] ) );
    }
}

add_action( 'woocommerce_checkout_update_user_meta', 'checkout_update_user_display_name', 10, 2 );
function checkout_update_user_display_name( $customer_id, $data ) {
    if ( isset($_POST['billing_full_name']) ) {
        $user_id = wp_update_user( array( 'ID' => $customer_id, 'display_name' => sanitize_text_field($_POST['billing_full_name']) ) );
    }
}

/** End billing_full_name is same as Profile Name **/


/** Start Single Product Page Rating position **/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 4 );

/** End Single Product Page Rating position **/


/** Start Single Product Page Excerpt position **/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 8 );

/** End Single Product Page Excerpt position **/


/** Start hide additional info tab in single product **/

add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 9999 );
  
function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}

/** End hide additional info tab in single product **/


/** Start add custom tab in product backend and single product **/

add_action( 'add_meta_boxes', 'create_custom_meta_box' );
if ( ! function_exists( 'create_custom_meta_box' ) ){
    function create_custom_meta_box(){
        add_meta_box(
            'custom_product_meta_box',
            __( 'Additional Product Information', 'psg' ),
            'add_custom_content_meta_box',
            'product',
            'normal',
            'default'
        );
    }
}

//  Custom metabox content in admin product pages
if ( ! function_exists( 'add_custom_content_meta_box' ) ){
    function add_custom_content_meta_box( $post ){
        $prefix = '_bhww_'; // global $prefix;

        $application = get_post_meta($post->ID, $prefix.'add_info_wysiwyg', true) ? get_post_meta($post->ID, $prefix.'add_info_wysiwyg', true) : '';
        $args['textarea_rows'] = 6;
		
		 echo '<h3>'.__( 'Additional Information', 'psg' ).'</h3>';
        wp_editor( $application, 'add_info_wysiwyg', $args );

		 echo '<input type="hidden" name="custom_product_field_nonce" value="' . wp_create_nonce() . '">';
    }
}

//Save the data of the Meta field
add_action( 'save_post', 'save_custom_content_meta_box', 10, 1 );
if ( ! function_exists( 'save_custom_content_meta_box' ) ){

    function save_custom_content_meta_box( $post_id ) {
        $prefix = '_bhww_'; // global $prefix;

        // Check if our nonce is set.
        if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'custom_product_field_nonce' ];

        //Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'product' == $_POST[ 'post_type' ] ){
            if ( ! current_user_can( 'edit_product', $post_id ) )
                return $post_id;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }

        // Sanitize user input and update the meta field in the database.
        update_post_meta( $post_id, $prefix.'add_info_wysiwyg', $_POST[ 'add_info_wysiwyg' ]);
    }
}

// Add a custom product data tab
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
	
	// Adds the new tab
	global $post;
  	$product_add_info = get_post_meta( $post->ID, '_bhww_add_info_wysiwyg', true );
	
    if ( !empty( $product_add_info ) ) {
	$tabs['add_info'] = array(
		'title' 	=> __( 'Additional Information', 'woocommerce' ),
		'priority' 	=> 25,
		'callback' 	=> 'add_info_tab_content'
	);
	}
	   return $tabs;	
}	

// The new tab content
function add_info_tab_content() {

	global $post;
  	$product_add_info = get_post_meta( $post->ID, '_bhww_add_info_wysiwyg', true );

    if ( !empty( $product_add_info ) ) {
		
		echo '<h2>' . __( 'Additional Information', 'woocommerce' ) . '</h2>';
        // Updated to apply the_content filter to WYSIWYG content ?>
        <div class="psg-product-popup-content-des">
        	<?php echo apply_filters( 'the_content', $product_add_info ); ?>
		</div> <?php
    }
}

/** End add custom tab in product backend and single product **/


/** Start Custom Video Link Meta Box **/

function add_video_fields_meta_box() {
	add_meta_box(
		'video_fields_meta_box',
		'Single Product',
		'show_video_fields_meta_box',
		'product',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'add_video_fields_meta_box' );

function show_video_fields_meta_box() {
    global $post;
        $meta = get_post_meta( $post->ID, 'video_fields', true ); ?>
	
		<br />
		<input type="hidden" name="video_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <label style="padding-right: 50px;"><b>Video Url </b></label><input type="url" name="video_fields[video_members_button_url]" id="videos_field[video_members_button_url]" class="regular-text" value="<?php echo isset($meta['video_members_button_url']) ? $meta['video_members_button_url'] : ''; ?>"><br /><br />
	
    
<?php 
}

    function save_video_fields_meta( $post_id ) {
    // verify nonce
    if ( !wp_verify_nonce( $_POST['video_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // check permissions
    if ( 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }
    
    $old = get_post_meta( $post_id, 'video_fields', true );
    $new = $_POST['video_fields'];

    if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'video_fields', $new );
    } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'video_fields', $old );
    }
}
add_action( 'save_post', 'save_video_fields_meta' );

/** End Custom Video Link Meta Box **/


/** Start remove add to cart button in shop page **/

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/** End remove add to cart button in shop page **/


/** Start change order of shop page ordering **/

 add_filter( 'woocommerce_catalog_orderby', 'ui_change_sorting_options_order', 5 );

 function ui_change_sorting_options_order( $options ){
	
 	$options = array(
	
 	'menu_order' => __( 'Default Sorting', 'woocommerce' ),
 	'popularity' => __( 'Sort by Popularity', 'woocommerce' ),
 	'rating'      => __( 'Sort by Average Rating', 'woocommerce' ),
 	'date'      => __( 'Sort by Latest', 'woocommerce' ),
 	'price'      => __( 'Sort by Price: Low to High', 'woocommerce' ), // I need sorting by price to be the first
	'price-desc' => __( 'Sort by Price: High to Low', 'woocommerce' ),
 	);
 	return $options;
 }

/** End change order of shop page ordering **/


/** Start My Account Menu Code **/

add_filter( 'woocommerce_account_menu_items', 'psg_my_account_menu_item_reorder_and_rename' );
function psg_my_account_menu_item_reorder_and_rename( $menu_links ){
	return array(
		'edit-account' => __( 'My Profile', 'psg' ),
		'edit-address' => __( 'Address Book', 'psg' ),
		'orders' => __( 'Order History', 'psg' ),
		'my-wishlist' => __( 'My Wishlist', 'psg' ),
		//'cart' => __( 'My Cart', 'psg' ),
		'rewards' => __( 'My Rewards', 'psg' ),
		//'points-history' => __( 'Points History', 'psg' ),
		'logout' => __( 'Logout', 'psg' ),
	);
}

/** End My Account Menu Code **/


/** Start My Rewards Page Content Code **/

if ( is_plugin_active( 'loyalty-points-rewards/wp-loyalty-points-rewards.php' ) ) {
	
	//My Rewards Page
	add_action( 'init', 'register_rewards_endpoint');
	function register_rewards_endpoint() {
		add_rewrite_endpoint( 'rewards', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'points-history',  EP_PERMALINK | EP_PAGES );
	}
	
	
	add_action( 'woocommerce_account_rewards_endpoint', 'my_rewards_page_content' );
	function my_rewards_page_content() { 
		include 'my-rewards.php';	
	}
	
	add_action( 'woocommerce_account_points-history_endpoint', 'my_points_history_page_content' );
	function my_points_history_page_content() { 
		include 'points-history.php';	
	}	
}

/** End My Rewards Page Content Code **/


/** Start Order Page Sorting Code **/

add_filter( 'woocommerce_my_account_my_orders_query', 'custom_woocommerce_my_account_my_orders_query', 10, 1);
function custom_woocommerce_my_account_my_orders_query($array) {
	    
	//Sortby 
	if(!empty($_GET['sort_by'])){
		$sort_by = $_GET['sort_by'];
		$array['order'] = $sort_by;
	}
	
	//START Date And END Date
	if( !empty($_GET['start_date']) && !empty($_GET['end_date'])){
		$start_date = $_GET['start_date'];
		$end_date = $_GET['end_date'];
		
		$array['date_query'] = array(
			array(
				'after'  => $start_date, //start_date 2021-11-16
				'before' => $end_date, //end_date
				'inclusive' => true,
			),
		);
	}
	//Search 
	if(!empty($_GET['order_search'])){
		$order_search = $_GET['order_search'];
		$array['post__in'] = array($order_search);
	}	
	return $array;
}

/** End Order Page Sorting Code **/


/** Start Invoice Function **/

add_filter('wf_pklist_alter_template_html', 'wt_pklist_add_custom_css_in_invoice_html', 10, 2);
function wt_pklist_add_custom_css_in_invoice_html($html, $template_type) {
if($template_type=='invoice') {
	
     $html.='<style type="text/css">
	 .wfte_payment_summary_table_row.wfte_product_table_payment_total td.wfte_product_table_payment_total_label.wfte_text_right {
	 	vertical-align: baseline;
	 }	
	 .wfte_shipping_address{
	 	position: relative;
	 }
	 .wfte_product_table_body td{
		 border-bottom: none;
		 font-size: 14px;
		 line-height: 21px;
		 letter-spacing: 0.6px;
		 padding: 12px 20px;
	 }
	 .wfte_table_head_color {
		color: #FFFFFF;
		background: #59656F;
		border: 1px solid #59656F !important;
	}
	 .wfte_product_table{
	 	margin-bottom: 30px;
	 }
	 tbody.wfte_product_table_body.wfte_table_body_color tr {
    	border: 1px solid #E9E9F0;
	}
	 .wfte_invoice-main{
		max-width: 1200px !important;
        margin: 0 auto;
    	padding: 100px 10px;
    	font-size: 14px;
    	line-height: 21px;
   		letter-spacing: 0.6px;
	 }
	 .wfte_company_logo_img{
		 object-fit: contain;
		 width: 250px !important;
		 height: auto !important;
	 }
	 .wfte_address-field-header {
		 font-size: 18px;
    	letter-spacing: 0.9px;
    	line-height: 28px;
   	 	color: #393438;
    	text-transform: uppercase;
	 }
	 .wfte_invoice_data {
		 font-size: 14px;
		 line-height: 21px;
		 letter-spacing: 0.6px;
	 }
	 .wfte_product_table_head th {
		 padding: 9px 20px;
		 line-height: 21px;
	 }
	 .wfte_product_table_payment_total td {
	 	border-bottom: none;
	 }
	 .wfte_payment_summary_table tbody tr td {
		 font-size: 14px;
		 line-height: 18px;
		 padding: 5px 20px;
	 }
	 .wfte_payment_summary_table tbody tr:last-child td {
	 	padding-top: 15px;
	 }
	 .wfte_payment_summary_table tbody tr.wfte_product_table_tax_item td {
	 	padding-bottom: 15px;
	 }
	 .wfte_billing_address {
	 	margin-top: 20px;
	 }
	 .wfte_shipping_address {
	 	margin-top: 20px;
	 }
	 table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table {
		 width: 400px;
		 float: right;
		 background: #F5F6F6;
	 }
	 table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr.wfte_product_table_payment_total td.wfte_left_column {
    	padding: 0;
	}
	 table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr td {
		 width: auto;
		 padding: 10px 30px;
		 text-align: left !important;
	 }	
	 table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr td.wfte_right_column.wfte_text_left {
		text-align: right !important;
	}
	 table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr:first-child td {
		 padding-top: 30px;
	 }	
	table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr.wfte_product_table_tax_item td {
		padding-bottom: 20px;
	}
	table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr.wfte_product_table_payment_total {
		border-top: 1px solid #E9E9F0;
	}
	table.wfte_payment_summary_table.wfte_product_table.wfte_side_padding_table tbody tr.wfte_product_table_payment_total td {
		border-top: 0;
		height: auto;
		padding-top: 20px;
		padding-bottom: 20px;
	}
	.wfte_product_table_head_product {
    	width: 29%;
	}
	.wfte_product_table_head_quantity {
    	width: 24%;
	}
	.wfte_product_table .wfte_right_column {
    	width: 20%;
	}
	.wfte_barcode {
    	display: none;
	}
	.image_td img.wfte_product_image_thumb {
    	max-height: 60px !important;
    	max-width: 60px !important;
		border-radius: 0 !important;
	}
	 </style>';
	
}
return $html;
}

/** End Invoice Function **/


/** Start Checkout Payment Order change **/

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );

/** End Checkout Payment Order change **/


/** Start filter for display product name & vaiation in different row **/

add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );

/** End filter for display product name & vaiation in different row **/


/** Start disable theme block editor for widgets **/

function disable_wbe_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'disable_wbe_theme_support' );

/** End disable theme block editor for widgets **/


/** Start Register shop page sidebar **/

add_action( 'widgets_init', 'wpb_widgets_init' );
function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' => __( 'Shop Sidebar', 'wpb' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
 
/** End Register shop page sidebar **/


/** Start action for add new label in shop page **/

add_action ( 'woocommerce_after_shop_loop_item', 'custom_after_title', 999 );
function custom_after_title() {

global $product,$new_product_ids;
$current_product_id = $product->get_id();
$new_product_ids = array();
	$new_products = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC',
		'date_query' => array(
			array(
				'after' => '1 week ago'
			)
		)
	);
$products_loop = new WP_Query( $new_products );
while ( $products_loop->have_posts() ) : $products_loop->the_post();

$new_product_ids[] = $products_loop->post->ID;

$product_ids = $products_loop->post->ID;
$product_ids = array($product_ids);
	foreach ($product_ids as $product_id) {
        if ($product_id == $current_product_id) {
			echo '<div class="psg-latest-product-text">New</div>';
		}
    }
endwhile;
wp_reset_query();
}


add_filter( 'post_class', 'add_new_product_class', 10, 3 );
function add_new_product_class ($class, $classes, $product_id){
	global $new_product_ids;
	if (is_array($new_product_ids) && in_array($product_id, $new_product_ids)){
			$classes[] = 'psg_new_product';
		return $classes;
	}else{
		$classes[] = '';
		return $classes;
	}
}

/** End action for add new label in shop page **/


/** Start change product per page in shop page **/

add_filter( 'loop_shop_per_page', 'bbloomer_redefine_products_per_page', 9999 );
function bbloomer_redefine_products_per_page( $per_page ) {
    if ( isset( $_GET["nop"] ) && !empty( $_GET["nop"] ) ) {
        if ( $_GET["nop"] == 12 ) { 
            $per_page = 12;
        } elseif ( $_GET["nop"] == 15 ) { 
            $per_page = 15;
        } elseif ( $_GET["nop"] == 30 ) { 
            $per_page = 30;
        } else { 
            $per_page = 12;
        }
    }
    
    return $per_page;
}

/** End change product per page in shop page **/


/** Start required checkout field **/

add_filter( 'woocommerce_default_address_fields', 'customising_checkout_fields', 1000, 1 );
function customising_checkout_fields( $address_fields ) {
    $address_fields['address_2']['required'] = true;

    return $address_fields;
}

/** End required checkout field **/


/** Start redirect to login after register **/

add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 2);
function custom_registration_redirect() {
    wp_logout();
	$redirection_url = get_permalink( wc_get_page_id( 'myaccount' ) );
    return $redirection_url;
}

/** End redirect to login after register **/


/** Start Login redirect to current page **/

add_action( 'woocommerce_login_form_end', 'bbloomer_actual_referrer' );
function bbloomer_actual_referrer($signup_link) {
	
	if ( ! wc_get_raw_referer() ) return;
	
	$signup_link = get_permalink( 220 );
	
	if( wp_validate_redirect( wc_get_raw_referer(), get_permalink() ) == $signup_link ) {
		echo '<input type="hidden" name="redirect" value="' . wc_get_account_endpoint_url('edit-account') . '" />';
	} else {
		echo '<input type="hidden" name="redirect" value="' . wp_validate_redirect( wc_get_raw_referer(), get_permalink() ) . '" />';
	}			
}

/** End Login redirect to current page **/


/** Start hide Shipping Rate When Free Shipping is Available **/

// add_filter( 'woocommerce_package_rates', 'bbloomer_unset_shipping_when_free_is_available_all_zones', 9999, 2 );   
// function bbloomer_unset_shipping_when_free_is_available_all_zones( $rates, $package ) {
//    $all_free_rates = array();
//    foreach ( $rates as $rate_id => $rate ) {
//       if ( 'free_shipping' === $rate->method_id ) {
//          $all_free_rates[ $rate_id ] = $rate;
//          break;
//       }
//    }
//    if ( empty( $all_free_rates )) {
//       return $rates;
//    } else {
//       return $all_free_rates;
//    } 
// }

/** End hide Shipping Rate When Free Shipping is Available **/


/** Start wishlist code **/

add_action( 'wp_ajax_get_product_wishlist', 'get_product_wishlist' );
add_action( 'wp_ajax_nopriv_get_product_wishlist', 'get_product_wishlist' );
function get_product_wishlist(){	

$product_id = $_POST['product_ids'];
$user_id = $_POST['users'];
$newvalue = $product_id;
$new_whish_list_id = $whish_vari_id;
$oldvalue = get_user_meta( $user_id, 'wishlist', true );
	if(!empty($oldvalue)){
		$a=$oldvalue;
		array_push($a, $newvalue);
		$a = array_unique($a);
	}
	else{
		$a[] = $newvalue;
	}
	update_user_meta( $user_id, 'wishlist', $a );
}

add_action( 'wp_ajax_delete_product_wishlist', 'delete_product_wishlist' );
add_action( 'wp_ajax_nopriv_delete_product_wishlist', 'delete_product_wishlist' );

function delete_product_wishlist() {	
$product_id = $_POST['delete_product_ids'];
$user_id = $_POST['delete_user'];
$variation_id = $_POST['del_variation_id'];
$current_item = $_POST['current_item'];
$f_current_item = $current_item - 1 ;

$get_all_data = get_user_meta( $user_id, 'wishlist', true ); // all product ids
//$get_variation_data = get_user_meta( $user_id, 'wishlist_variation', true ); // variable product variation ids
	
	if(in_array($product_id,$get_all_data)){
			$get_all_data = array_flip($get_all_data);
			unset($get_all_data[ $product_id ]);
			$get_all_data = array_flip($get_all_data);
		update_user_meta( $user_id, 'wishlist', $get_all_data );
	}
	$user_id = get_current_user_id(); 
	$product_id = get_user_meta( $user_id, 'wishlist', true ); 
	//$variation_data = get_user_meta( $user_id, 'wishlist_variation', true ); // variable product variation ids
	
	
	$nb_elem_per_page = $f_current_item;
	$page = isset($_GET['paged_wish'])?intval($_GET['paged_wish']-1):0;
	if(!empty($product_id)){
		$number_of_pages = intval(count($product_id)/$nb_elem_per_page)+1;	
	}
	global $woocommerce , $product;
	if(!empty($product_id)){
	?>

	<table class="psg_woocommerce_table_style psg_shop_table_responsive">
		<thead>
			<tr>
				<th colspan="2">Product</th>
				<th colspan="3">Unit Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
		    $post_count = array_slice($product_id, $page*$nb_elem_per_page, $nb_elem_per_page);
		    $count_array = count($post_count);
		  
			foreach(array_slice($product_id, $page*$nb_elem_per_page, $nb_elem_per_page)  as $product){
				$product_ids   = wc_get_product( $product );
 				$thumbnail   = $product_ids->get_image(array( 60, 60));
			?>	
			<tr>
				<td data-title="Product Image" class="psg-wishlist-image"><?php echo $thumbnail; ?></td>
				<td data-title="Title" class="psg-wishlist-title">
					<a href="<?php echo get_permalink($product); ?>"><?php echo $product_ids->get_name(); ?></a>
						<?php 
							if ( !$product_ids->is_type( 'simple' ) ) {
								$variation_id = $product; // Replace with your variation ID
								$post_type = get_post_type( $variation_id );
								if ( $post_type === 'product_variation' ) {
									$variation = new WC_Product_Variation( $variation_id );

									if ( $variation ) {
										// Get the variation attributes and values as an array
										$variation_attributes = $variation->get_variation_attributes();    
										// Get the variation name by combining the attribute names and values
										$variation_name = join( ' - ', $variation_attributes );
								?>
								<span class="psg_whislist_variations_details">
									<p class="psg_attr">
										<span class="attr_name">Variation: </span> <?php echo $variation_name;?>
									</p>
								</span>
								<?php
									} else {
										// Handle case where variation ID is invalid or product not found
									}
								}  
							}
				           
						?>
				 
					<div class="wishlist-mobile-main-price" style="display: none;"><?php echo $product_ids->get_price_html(); ?></div>
					
					<div class="wishlist-mobile-main-button" style="display: none;">
						<a href="<?php echo home_url(); ?>/cart/?add-to-cart=<?php echo $product; ?>" class="move-to-bag" data-id="<?php echo $product; ?>">
							<i class="fal fa-shopping-bag"></i>Move to cart
						</a>						
					</div>
					
				</td>

				<td data-title="Unit Price" class="psg-wishlist-prise"><?php echo $product_ids->get_price_html(); ?></td>
				<td data-title="Action" class="psg-wishlist-cart-btn">	
					<?php

				$variation_id = $product; // Replace with your variation ID
				$post_type = get_post_type( $variation_id );
				if ( !$product_ids->is_type( 'simple' ) ) {
					if ( $post_type === 'product_variation' ) {
						$variation = new WC_Product_Variation( $variation_id );
						if ( $variation ) {
							// Get the variation attributes and values as an array
							$variation_attributes = $variation->get_variation_attributes();  
							$url_cerate = "";
							foreach($variation_attributes as $key => $value){
								$url_cerate.= '&'.$key.'='.$value; 	
							}
						}
						$f_url = (!empty($url_cerate)) ? ($url_cerate) : ("");
					?>
					<a href="<?php echo home_url(); ?>/cart/?add-to-cart=<?php echo $product."".$f_url; ?>" class="move-to-bag" data-id="<?php echo $product; ?>">
						<i class="fal fa-shopping-bag"></i>Move to cart
					</a>
					<?php
					}
					else{
						$product_var = wc_get_product( $variation_id );
						$variations = $product_var->get_available_variations();
						$lowest_price = null;
						$lowest_price_variation_id = null;

						// Loop through the variations to find the lowest price
						foreach ( $variations as $variation ) {
							$price = $variation['display_price'];
							if ( ! $lowest_price || $price < $lowest_price ) {
								$lowest_price = $price;
								$lowest_price_variation = $variation['variation_id'];
							}
						}
						$variation = new WC_Product_Variation( $lowest_price_variation );
						$variation_attributes = $variation->get_variation_attributes(); 
						$url_cerates = "";
						foreach($variation_attributes as $key => $value){
							$url_cerates.= '&'.$key.'='.$value; 	
						}
						$f_url = $url_cerates;
					?>
					<a href="<?php echo home_url(); ?>/cart/?add-to-cart=<?php echo $lowest_price_variation."".$f_url; ?>" class="move-to-bag" data-id="<?php echo $product; ?>">
						<i class="fal fa-shopping-bag"></i>Move to cart
					</a>
					<?php
					}
				}
				else{ ?>
					<a href="<?php echo home_url(); ?>/cart/?add-to-cart=<?php echo $product;?>" class="move-to-bag" data-id="<?php echo $product; ?>">
						<i class="fal fa-shopping-bag"></i>Move to cart
					</a>
					<?php	}			?>
														
				</td>
				 <td class="psg-wishlist-btn"><input type="hidden" id="current_item" name="current_item" value=""><button data-id="<?php echo $product ;?>"  class="whi_prod_delete" id="whi_prod_delete"><i class="fal fa-trash-alt"></i></button></td>	
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<div id="pagination-container"></div>

    
	<?php 
	
add_action('get_footer', 'pagination_jquery_link');
function pagination_jquery_link() {
	wp_enqueue_script('psg-custom-pagination-js', get_template_directory_uri() . '/assets/js/psg-custom-pagination.js', array('jquery'));
}	
?>
<script>
	jQuery(".psg-wishlist-table-wrap tbody tr").slice(6).hide();
	jQuery(function() {
			var items = jQuery(".psg-wishlist-table-wrap tbody tr");
			var numItems = <?php echo $f_current_item; ?>;
			if(numItems > 6) {
				jQuery('#pagination-container').pagination({
					items: numItems,
					itemsOnPage: 6,
					prevText: '<i class="fal fa-chevron-left"></i>',
					nextText: '<i class="fal fa-chevron-right"></i>',
					onPageClick: function (pageNumber) {
						var showFrom = 6 * (pageNumber - 1);
						var showTo = showFrom + 6;
						console.log(showFrom);
						console.log(showTo);
						items.hide().slice(showFrom, showTo).show();
					}
				});
			}else{
				jQuery("#pagination-container").remove();
			}
		});
	
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		jQuery(".whi_prod_delete, .move-to-bag").click(function(e){
			var del_product_id = jQuery(this).data("id");
			var del_variation_id = jQuery(this).data("variation_id");
			var user = '<?php echo get_current_user_id(); ?>';
			var current_item = jQuery(".psg-wishlist-btn #current_item").val();
			jQuery.ajax
			({
				url: ajaxurl,
				dataType: "html",
				type: "POST",
				data:
				{
					"delete_user" : user,
					"delete_product_ids" : del_product_id,
					"del_variation_id" : del_variation_id,
					"current_item" : current_item,
					"action" : "delete_product_wishlist"
				},
				success: function(data)
				{
					jQuery("#wishlist_table").html(data);
				},
			});
		});
</script>
	<?php } else{
		echo '<p class="psg-wishlist-not-found-text">Your Wishlist is currently empty. Start adding products to your wishlist!</p>';
	} 
exit();
}

/** End wishlist code **/


/** Start add filter for coupon success msg **/

add_filter( 'woocommerce_coupon_message', 'filter_woocommerce_coupon_message', 10, 3 );
function filter_woocommerce_coupon_message( $msg, $msg_code, $coupon ) {

    if( $msg === __( 'Coupon code applied successfully.', 'woocommerce' ) ) {
        $msg = sprintf( 
            __( "<span class='psg-coupon-success-msg'>Coupon Applied Successfully!</span>", "woocommerce" ), 
        );
    }
	
	if( $msg === __( 'Discount Applied Successfully', 'woocommerce' ) ) {
        $msg = sprintf( 
            __( "<span class='psg-redeem-success-msg'>Redemption Applied Successfully!</span>", "woocommerce" ), 
        );
    }
?>
<script>
	jQuery( document ).ready(function() {
		jQuery('.psg-coupon-success-msg').parent('.woocommerce-message').addClass('psg-coupon-success-msg-main');
		jQuery('.psg-redeem-success-msg').parent('.woocommerce-message').addClass('psg-redeem-success-msg-main');
	});
</script>
<?php
    return $msg;		
}


/** End add filter for coupon success msg **/


/** Start add filter for coupon remove msg **/

add_filter( 'gettext', 'woocommerce_rename_coupon_field_on_cart', 10, 3 );
function woocommerce_rename_coupon_field_on_cart( $translated_text, $text, $text_domain ) {
	
	if ( is_admin() || 'woocommerce' !== $text_domain ) {
		return $translated_text;
	}

	if ('Coupon has been removed.' === $text){
		$text = '<span class="psg-coupon-remove-msg">Coupon has been removed.</span>';
	} 
	
	return $text;
}

/** End add filter for coupon remove msg **/


/** Start action for Points History Page sorting and filter **/

add_action( 'wp_ajax_get_points_history_table', 'get_points_history_table' );
add_action( 'wp_ajax_nopriv_get_points_history_table', 'get_points_history_table' ); 

function get_points_history_table() {
	
global $wpdb;	

$current_user = wp_get_current_user();
$current_user_id = get_current_user_id();
$current_useremail = $current_user->user_email;	
	
$points_history = $_POST["points_history"];
$points_sort = $_POST["points_sort"];		
	
$points_table_data = $wpdb->get_results( "SELECT * FROM wp_wlpr_user_point_actions WHERE user_email LIKE '$current_useremail' ORDER BY created_date $points_sort");	
	
?>
	
	<table class="shop_table shop_table_responsive psg-points-history-table-main psg_woocommerce_table_style">
		
		<thead>
			<tr>
				<th class="order-date"><?php esc_html_e( 'Date', 'woocommerce' ); ?></th>
				<th class="order-description"><?php esc_html_e( 'Transaction Type', 'woocommerce' ); ?></th>
				<th class="order-points"><?php esc_html_e( 'Points', 'woocommerce' ); ?></th>
			</tr>
		</thead>

		<?php if( $points_history == 'Redeemed' ) { ?>		

		<tbody>
			<?php foreach ( $points_table_data as $points_table ) {
			$order_date = $points_table->created_date;
			$only_date = date('d M Y', strtotime($order_date));
			$order_points = $points_table->points; 	
			$order_action = $points_table->action;
			if($order_action == "order-placed") {
				$order_description = "Point redemption for purchase";
			} elseif($order_action == "order-redeem") {
				$order_description = "Point redemption";
			} else {
				$order_description = "Points adjusted by admin";
			}	
	
			if( $order_points < 0 ){ ?>
			<tr>
				<td class="order-date" data-title="Date">
					<?php echo $only_date; ?>
				</td>
				<td class="order-description" data-title="Transaction Type">
					<?php echo $order_description; ?>
				</td>
				<td class="order-points" data-title="Points">
					<?php if($order_points > 0){ echo "+"; } echo $order_points; ?>
				</td>
			</tr>	
			<?php }
		} ?>
		</tbody>
		<?php } elseif( $points_history == 'Earned' ) { ?>

		<tbody>
			<?php foreach ( $points_table_data as $points_table ) {		
			$order_date = $points_table->created_date;
			$only_date = date('d M Y', strtotime($order_date));
			$order_points = $points_table->points;
		
			$order_action = $points_table->action;
			if($order_action == "account-signup") {
				$order_description = "Points earned for account signup";
			} elseif($order_action == "order-placed") {
				$order_description = "Points earned for purchase";
			} elseif($order_action == "order-redeem") {
				$order_description = "Point redemption";
			} else {
				$order_description = "Points adjusted by admin";
			}

			if( $order_points > 0 ){ ?>
			<tr>
				<td class="order-date" data-title="Date">
					<?php echo $only_date; ?>
				</td>
				<td class="order-description" data-title="Transaction Type">
					<?php echo $order_description; ?>
				</td>
				<td class="order-points" data-title="Points">
					<?php if($order_points > 0){ echo "+"; } echo $order_points; ?>
				</td>
			</tr>	
			<?php }
		} ?>
		</tbody>

		<?php } else { ?>

		<tbody>
			<?php foreach ( $points_table_data as $points_table ) {
			$order_date = $points_table->created_date;
			$only_date = date('d M Y', strtotime($order_date));
			$order_points = $points_table->points; 
			$order_action = $points_table->action;
			if($order_action == "account-signup") {
				$order_description = "Points earned for account signup";
			} elseif($order_action == "order-placed") {
				$order_description = "Points earned for purchase";
			} elseif($order_action == "order-redeem") {
				$order_description = "Point redemption";
			} else {
				$order_description = "Points adjusted by admin";
			}
			?>

			<tr>
				<td class="order-date" data-title="Date">
					<?php echo $only_date; ?>
				</td>
				<td class="order-description" data-title="Transaction Type">
					<?php echo $order_description; ?>
				</td>
				<td class="order-points" data-title="Points">
					<?php if($order_points > 0){ echo "+"; } echo $order_points; ?>
				</td>
			</tr>	
			<?php } ?>
		</tbody>

		<?php } ?>

	</table>
	<div id="pagination-container"></div>
	
<script>	
	jQuery(".psg-points-history-table-main tbody tr").slice(10).hide();
	jQuery(function() {
			var items = jQuery(".psg-points-history-table-main tbody tr");
			var numItems = items.length;
			if(numItems > 10) {
				jQuery('#pagination-container').pagination({
					items: numItems,
					itemsOnPage: 10,
					prevText: '<i class="fal fa-chevron-left"></i>',
					nextText: '<i class="fal fa-chevron-right"></i>',
					onPageClick: function (pageNumber) {
						var showFrom = 10 * (pageNumber - 1);
						var showTo = showFrom + 10;
						items.hide().slice(showFrom, showTo).show();
					}
				});
			}else{
				jQuery("#pagination-container").remove();
			}
		});
</script>
		
<?php 
exit();	
}

/** End action for Points History Page sorting and filter **/


/** Start action for single product variation price **/

add_action( 'woocommerce_variable_add_to_cart', 'bbloomer_update_price_with_variation_price' );
  
function bbloomer_update_price_with_variation_price() {
   global $product;
   $price = $product->get_price_html();
   wc_enqueue_js( "      
      $(document).on('found_variation', 'form.cart', function( event, variation ) {   
         if(variation.price_html) $('.summary > p.price').html(variation.price_html);
         $('.woocommerce-variation-price').hide();
      });
      $(document).on('hide_variation', 'form.cart', function( event, variation ) {   
         $('.summary > p.price').html('" . $price . "');
      });
   " );
}

/** End action for single product variation price **/


/** Start action for refresh checkout on address change **/

add_action( 'wp_ajax_refresh_checkout', 'my_refresh_checkout' );
add_action( 'wp_ajax_nopriv_refresh_checkout', 'my_refresh_checkout' );

function my_refresh_checkout() {
    // Retrieve the input data
    $billing_full_name = $_POST['billing_full_name'];
    $billing_email = $_POST['billing_email'];
    $billing_phone = $_POST['billing_phone'];
    $billing_address_1 = $_POST['billing_address_1'];
    $billing_address_2 = $_POST['billing_address_2'];
    $billing_postcode = $_POST['billing_postcode'];
	$billing_country = 'SG';

    $shipping_full_name = $_POST['shipping_full_name'];
    $shipping_phone = $_POST['shipping_phone'];
    $shipping_address_1 = $_POST['shipping_address_1'];
    $shipping_address_2 = $_POST['shipping_address_2'];
    $shipping_postcode = $_POST['shipping_postcode'];
    $shipping_country = 'SG';
    // Update the billing and shipping data
    WC()->customer->set_billing_country( $billing_country );
    WC()->customer->set_shipping_country( $shipping_country );
 	
    // Calculate the cart totals
     WC()->cart->calculate_shipping();

   ob_start();
	?>
	<div class="psg-checkout-shipping-method-wrp">
		<h3 class="psg-shipping-method-heading">Shipping Method</h3>
		<?php wc_cart_totals_shipping_html(); ?>
	</div>
	<?php
	$shipping_methods = ob_get_clean();

    wp_send_json_success( $shipping_methods );
    wp_die();
}

/** End action for refresh checkout on address change **/


/** Start label for Delivery Date and Time **/

function iconic_modify_delivery_slots_label( $labels, $order ) {
	
	$labels['date']   = 'Preferred Date';
	$labels['time_slot']   = 'Preferred Time';
	$labels['select_date']       = 'Please enter your preferred date';
	$labels['choose_date']       = 'Please choose a date for your collection';
	$labels['choose_time_slot']  = 'Please enter your preferred time';
	
	return $labels;
}

add_filter( 'iconic_wds_labels', 'iconic_modify_delivery_slots_label', 2, 2 );

/** End label for Delivery Date Time **/


/** Start minicart ajax solved **/

function menu_cart_elementor_fix() {
	// Remove ElementorPro\Modules\Woocommerce\Module::menu_cart_fragments (fragments ajax handler).
	remove_all_actions( 'wp_ajax_elementor_menu_cart_fragments' );
	remove_all_actions( 'wp_ajax_nopriv_elementor_menu_cart_fragments' );
	// Remove ElementorPro\Modules\Woocommerce\Module::e_cart_count_fragments (fragments count ajax handler).
	function remove_e_cart_count_fragments_filter() {
		global $wp_filter;
		$filter = 'woocommerce_add_to_cart_fragments';
		$fn     = 'e_cart_count_fragments';
		if ( ! isset( $wp_filter[ $filter ] ) || empty( $wp_filter[ $filter ]->callbacks ) ) {
			return;
		}
		foreach( $wp_filter[ $filter ]->callbacks as $priority => $callbacks ) {
			foreach( $callbacks as $callback_key => $callback ) {
				if( strpos( $callback_key, $fn ) !== false ) {
					remove_filter( $filter, $callback_key, $priority );
				}
			}
		}
	}
	remove_e_cart_count_fragments_filter();
	// Add fragments count handler without causing issues.
	function cart_count_fragments( $fragments ) {
		$product_count = WC()->cart->get_cart_contents_count();
		$fragments['.elementor-menu-cart__toggle_button span.elementor-button-text'] = '<span class="elementor-button-text">' . WC()->cart->get_cart_subtotal() . '</span>';
		$fragments['.elementor-menu-cart__toggle_button span.elementor-button-icon-qty'] = '<span class="elementor-button-icon-qty" data-counter=' . $product_count . '>' . $product_count . '</span>';
		return $fragments;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'cart_count_fragments' );
}
add_action( 'elementor/init', 'menu_cart_elementor_fix', 100 );

/** End minicart ajax solved **/


/** Start add highlight in product search result title **/

add_action('init', 'my_custom_init');
function my_custom_init() {
    add_action('wp', 'woocommerce_search_custom_title');
}

function woocommerce_search_custom_title() {    
    if( is_shop() && is_search() ){
        remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
		
		add_action('woocommerce_shop_loop_item_title','custom_shop_loop_item_title',10);		
		function custom_shop_loop_item_title() {
			$title = get_the_title(); ?>
			
			<h2 class="woocommerce-loop-product__title"><?php echo $title; ?></h2> 

			<script>
				jQuery.fn.highlight = function(pat) {
					function innerHighlight(node, pat) {
						var skip = 0;
						if (node.nodeType == 3) {
							var pos = node.data.toUpperCase().indexOf(pat);
							if (pos >= 0) {
								var spannode = document.createElement('span');
								spannode.className = 'highlight';
								var middlebit = node.splitText(pos);
								var endbit = middlebit.splitText(pat.length);
								var middleclone = middlebit.cloneNode(true);
								spannode.appendChild(middleclone);
								middlebit.parentNode.replaceChild(spannode, middlebit);
								skip = 1;
							}
						}
						else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
							for (var i = 0; i < node.childNodes.length; ++i) {
								i += innerHighlight(node.childNodes[i], pat);
							}
						}
						return skip;
					}
					return this.length && pat && pat.length ? this.each(function() {
						innerHighlight(this, pat.toUpperCase());
					}) : this;
				};

				jQuery.fn.removeHighlight = function() {
					return this.find("span.highlight").each(function() {
						this.parentNode.firstChild.nodeName;
						with (this.parentNode) {
							replaceChild(this.firstChild, this);
							normalize();
						}
					}).end();
				};

				jQuery( document ).ready(function() {
					var search_term = jQuery('input.psg-products-search-inner').val();
					jQuery('.psg-archive-product-inner .woocommerce-loop-product__title').removeHighlight().highlight(search_term);
				}); 
			</script>

<?php
		}
    } 
}

/** End add highlight in product search result title **/


/** Start sale text on shop page **/
 add_filter('woocommerce_sale_flash', 'ds_change_sale_text');
function ds_change_sale_text() {
   return '<span class="onsale">Sales</span>';
}
/** End sale text on shop page **/



add_action('woocommerce_after_add_to_cart_form','cmk_additional_button');
function cmk_additional_button() {
    $productID = get_the_ID();
	$product = wc_get_product( $productID );
    $prod_name =  $product->get_title();
	$prod_whatsapp_no = get_post_meta( $productID , 'whatsapp_sr_no' );
	$prod_whatsapp_text = get_post_meta( $productID , 'whatsapp_text' );
if(!empty($prod_whatsapp_no)){
  echo '<a href="'.esc_url('https://api.whatsapp.com/send?phone='.$prod_whatsapp_no[0].'&text='.$prod_whatsapp_text[0].':*' .$prod_name.'* URL:' .urlencode(get_permalink())).' Thank You!" target="_blank" class="psg_order_via_whatsapp"><i class="fab fa-whatsapp"></i> Order via Whatsapp</a>';    	
}
}