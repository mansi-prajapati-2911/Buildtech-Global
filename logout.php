<?php
/* Template Name: Logout */

get_header();


if( ! is_user_logged_in() ){
 
    wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id')) );
    exit();

}else{
?>

<div class="psg_logout_main_wrp psg-woocommerce-dashboard-wrp">
<?php
//do_action( 'woocommerce_account_navigation' ); 
?>	
	
<div class="woocommerce-MyAccount-content">
    <h3 class="psg-dashboard-main-heading">Log Out</h3>
	
	<div class="psg-logout-content">Are you sure want to log out?</div>
	
	<div class="psg-logout-main-btn">
		<div class="psg-custom-btn-inner">
			<a href="<?php echo get_home_url(); ?>" class="psg-logout-btn-cnl" ><span>Cancel</span><i class="fal fa-horizontal-rule"></i></a>
		</div>
	
		<div class="psg-custom-btn-inner">
			<a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="psglogout-btn"><span>Log Out</span><i class="fal fa-horizontal-rule"></i></a>
		</div>
	</div>	
</div>	
</div>
<?php
}	

get_footer();