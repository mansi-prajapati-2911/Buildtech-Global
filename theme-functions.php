<?php

/** Start wp-login logo backend **/

if ( !function_exists('tf_wp_admin_login_logo') ) :
 
    function tf_wp_admin_login_logo() { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg");
				width: 100%;
				background-size: contain;
            }
        </style>
    <?php }
 
    add_action( 'login_enqueue_scripts', 'tf_wp_admin_login_logo' );
 
endif;

/** End wp-login logo backend **/

/** Start Date Icon **/

function date_icon() { ?>
<style type="text/css">
	.psg-order-history-topbar input[type="date"]{
		padding-right: 0px;
	}
	.psg-order-history-topbar input[type="date"]::-webkit-calendar-picker-indicator {
		opacity: 1;
		display: block;
		background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/calender_icon.png");
		width: 13px;
		height: 15px;
		background-size: contain;
	}
</style>
<?php } 
add_action( 'wp_head', 'date_icon' );

/**End Date Icon **/


/** Start Dynamic Banner Image Code for search page **/

function search_page_banner_image() { ?>
<style type="text/css">
	.psg-search-page-wrp .page-header{
		background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/search_banner_image.jpg");
	}
</style>
<?php } 
add_action( 'wp_head', 'search_page_banner_image' );

/** End Dynamic Banner Image Code for search page **/



/** Start Dynamic Images Code **/
function btg_dynamic_images() { ?>
<style type="text/css">
	.psg-woocommrece-login-wrp{
		background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/login-bg-img.jpg");
	}
	.psg_logout_main_wrp.psg-woocommerce-dashboard-wrp{
		background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/login-bg-img.jpg");
	}
</style>
<?php } 
add_action( 'wp_head', 'btg_dynamic_images' );
/** End Dynamic Images Code **/




/** Start Breadcrumb **/

function the_breadcrumb() {
global $post;
	
$args = array( 'taxonomy' => 'product_cat',);
$terms = wp_get_post_terms($post->ID,'product_cat', $args);	
	
if (!is_home()) {
        if(is_product()):
			echo '<a href="'.home_url().'" rel="nofollow"><i class="fal fa-home"></i></a>';
			echo '<span class="separator"><i class="fal fa-chevron-right"></i></span>';
			echo '<a href="'.wc_get_page_permalink( 'shop' ).'" rel="nofollow">Shop</a>';
			echo'<span class="separator"><i class="fal fa-chevron-right"></i></span>';	
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term );
				echo '<a href="'.$term_link.'" rel="nofollow">' . $term->name . '</a>';
				echo'<span class="separator"><i class="fal fa-chevron-right"></i></span>';
			}			
			echo the_title();
        else:
        	echo '<a href="'.home_url().'" rel="nofollow"><i class="fal fa-home"></i></a>';
			echo '<span class="separator"><i class="fal fa-chevron-right"></i></span>';
        endif;
        if ( is_category() ) {
            the_category(', ');
            if ( is_single() ) {
                echo'<span class="separator"><i class="fal fa-chevron-right"></i></span>';
                the_title();
            }
        } elseif ( is_page() && $post->post_parent ) {
            echo '<a href="'. get_permalink($post->post_parent).'">'. apply_filters('the_title', get_the_title($post->post_parent)) .'</a>';
            echo '<span class="separator"><i class="fal fa-chevron-right"></i></span>';
            echo the_title();
        } 
        elseif (is_checkout()) {
         	echo '<a href="'.wc_get_cart_url() .'">Cart Summary</a>';
            echo '<span class="separator"><i class="fal fa-chevron-right"></i></span>';
            echo the_title();
         }
	     elseif (is_wc_endpoint_url( 'orders' )) {
         	echo '<a href="' .wc_get_page_permalink( 'myaccount' ).'">Login</a>';
            echo '<span class="separator"><i class="fal fa-chevron-right"></i></span>';
            echo 'My Orders';
          }
		 elseif (is_cart()) {
			echo 'Cart Summary';
		 }
		 elseif (is_page( 2760 )) {
         	echo '<a href="'.wc_get_cart_url() .'">My Profile</a>';
         }
         elseif (is_page()) {
            echo '';
            echo the_title();
            echo "";
         }
    }
}
/** End Breadcrumb **/


/** Start Elementor custom category **/

function create_custom_categories( $elements_manager ) {

    $elements_manager->add_category(
        'psg-widget',
        [
         'title' => __( 'PSG Widget'),
         'icon' => 'fa fa-plug',
		 'active' => true,
        ],
		2
		
    );
    
}
add_action( 'elementor/elements/categories_registered', 'create_custom_categories');

/** End Elementor custom category **/

/** Start auto update theme disable **/

add_filter( 'auto_update_theme', '__return_false' );

/** End auto update theme disable **/

/** Start Custom Logout Button Shortcode **/

add_shortcode('custom_logout_button', 'custom_logout_btn'); 
function custom_logout_btn() {
?>
<div class="psg-custom-logout-btn">
   <a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="psglogout-btn">Log Out</a>
</div>

<?php
}
/** End Custom Logout Button Shortcode **/

/*** Start Customizer Option Code ***/

function sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

// Sanitize text
function sanitize_text( $text ) {
	return sanitize_text_field( $text );
}

function psg_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'psg_cm_option' , array(
		'title'      => __( 'PSG Option', 'psg' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'priority'   => 60,
	));
	
	/* Start Search */
	$wp_customize->add_setting( 'search_enable', array(
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_checkbox',
		'default' => true,
	) );

	$wp_customize->add_control( 'search_enable', array(
		'type'                => 'checkbox',
		'section'             => 'psg_cm_option', // Add a default or your own section
		'label'               => esc_html__( 'Enable Search', 'mytheme' ),
	) );
	/* End Search */
	
	
	// Start Header Topbar
	$wp_customize->add_section( 'header_topbar_tab' , array(
		'title'      => __( 'Header Topbar', 'psg' ),
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'priority'   => 62,
	));
	
	//Contact Us
	$wp_customize->add_setting( 'header_contact_link', array(
	'capability'          => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'header_contact_control',
            array(
				'type'       => 'text',
                'label'      => __( 'Contact Us:', 'psg' ),
                'section'    => 'header_topbar_tab',
                'settings'   => 'header_contact_link',
            )
        )
    );
	
	//Mail ID
	$wp_customize->add_setting( 'header_mail_id', array(
	'capability'          => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'header_mail_id_control',
            array(
				'type'       => 'text',
                'label'      => __( 'Mail ID:', 'psg' ),
                'section'    => 'header_topbar_tab',
                'settings'   => 'header_mail_id',
            )
        )
    );
	
	//Facebook
	$wp_customize->add_setting( 'header_facebook_link', array(
	'capability'          => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'header_facebook_link_control',
            array(
				'type'       => 'text',
                'label'      => __( 'FaceBook', 'psg' ),
                'section'    => 'header_topbar_tab',
                'settings'   => 'header_facebook_link',
            )
        )
    );

	//Instagram
	$wp_customize->add_setting( 'header_instagram_link', array(
	'capability'          => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'header_instagram_link_control',
            array(
				'type'       => 'text',
                'label'      => __( 'Instagram', 'psg' ),
                'section'    => 'header_topbar_tab',
                'settings'   => 'header_instagram_link',
            )
        )
    );
	
	//Youtube
	$wp_customize->add_setting( 'header_youtube_link', array(
	'capability'          => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'header_youtube_link_control',
            array(
				'type'       => 'text',
                'label'      => __( 'Youtube', 'psg' ),
                'section'    => 'header_topbar_tab',
                'settings'   => 'header_youtube_link',
            )
        )
    );
	
	//Twitter
	$wp_customize->add_setting( 'header_twitter_link', array(
	'capability'          => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'header_twitter_link_control',
            array(
				'type'       => 'text',
                'label'      => __( 'Twitter', 'psg' ),
                'section'    => 'header_topbar_tab',
                'settings'   => 'header_twitter_link',
            )
        )
    );
	
	//End Header Social Media link
	
	/* Start Whatsapp */
	
	$wp_customize->add_setting( 'whatsapp_chat_enable', array(
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'sanitize_checkbox',
		'default' => true,
	) );

	$wp_customize->add_control( 'whatsapp_chat_enable', array(
		'type'                => 'checkbox',
		'section'             => 'psg_cm_option', // Add a default or your own section
		'label'               => esc_html__( 'Enable Whatsapp', 'mytheme' ),
	) );

	$wp_customize->add_setting( 'whatsapp_chat_link', array(
		'capability'          => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'whatsapp_chat_control',
		array(
			'type'       => 'url',
			'label'      => __( 'Whatsapp Chat Link', 'mytheme' ),
			'section'    => 'psg_cm_option',
			'settings'   => 'whatsapp_chat_link',
		)
	));
	/* End Whatsapp */

	/* Start Whatsapp */

	$wp_customize->add_setting( 'call_us_link', array(
		'capability'          => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'call_us_control',
		array(
			'type'       => 'url',
			'label'      => __( 'Call Us Link', 'mytheme' ),
			'section'    => 'psg_cm_option',
			'settings'   => 'call_us_link',
		)
	));
	/* End Whatsapp */
}
add_action( 'customize_register', 'psg_customize_register' );

/*** End Customizer Option Code ***/


/** Start Shortcode for footer copyright text **/

add_shortcode( 'footer_copyright', 'wpdocs_footag_func' );
function wpdocs_footag_func() { ?>

	<div class="psg-footer-copyright-main">
		<p class="psg-footer-copyright-text">Copyright <?php echo date("Y"); ?> @ Buildtech Global Pte Ltd</p>
	</div>

<?php }

/** End Shortcode for footer copyright text **/
