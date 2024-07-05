<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

$user = wp_get_current_user();
$user_id = get_current_user_id();
$useremail = $user->user_email;	

?>

<div class="psg-wd-sidebar-wrp">
	<div class="psg-wd-sidebar">
		<div class="psg-wd-sidebar-top">
			<div class="psg-wd-sidebar-user-image">
				<?php		
				$attachment_id = get_user_meta( $user_id, 'image1', true );
				$original_image_url = wp_get_attachment_url( $attachment_id );
				if ( !empty( $original_image_url ) ) {
					echo wp_get_attachment_image( $attachment_id, 'thumbnail');
				} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-683-10-my-account.jpg">
				<?php } ?>
			</div>
			<div class="psg-wd-sidebar-user-info">
				<h5 class="psg-wd-sidebar-user-name"><?php echo esc_attr( $user->display_name ); ?></h5>
				<?php
				if ( is_plugin_active( 'loyalty-points-rewards/wp-loyalty-points-rewards.php' ) ) {
						global $wpdb;				
						$result = $wpdb->get_results( "SELECT points FROM wp_wlpr_points WHERE user_email LIKE '$useremail'");
						foreach ( $result as $page )
						{
							$points = $page->points;
							if(!empty($points)){
								$point = $points;
							}else{
								$point = 0;
							}
						} ?>
					<p class="psg-wd-sidebar-user-poin"><?php echo $point; ?> Points</p>
				<?php } ?>
			</div>
		</div>
		
		<div class="psg-wd-sidebar-toggle-wrp">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		</div>
		<div class="psg-wd-sidebar-menu-wrp">
<!-- 			<div class="psg-loyalty-point-main">
				<a href="<?php //echo wc_get_account_endpoint_url( 'rewards' ); ?>" class="psg-loyalty-point-link">My Rewards</a>
			</div> -->
<!-- 			<div class="psg-wd-sidebar-head">My Account</div> -->
			<ul>
				<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
				<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		
	</div>
</div>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>