<?php
global $wpdb;	
$current_user = wp_get_current_user();
$current_user_id = get_current_user_id();
$current_useremail = $current_user->user_email;	

$mypoints = $wpdb->get_results( "SELECT points FROM wp_wlpr_points WHERE user_email LIKE '$current_useremail'");
foreach ( $mypoints as $mypoint )
{
	$point = $mypoint->points;
	if(!empty($point)){
		$user_point = $point;
	}else{
		$user_point = 0;
	}
}
?>

<div class="psg-rewards-content-main-wrp">
	<h3 class="psg-dashboard-main-heading">My Rewards</h3>
	<div class="psg-rewards-point-area-main">
		<div class="psg-rewards-point-area">
			<h4 class="psg-rewards-sub-title">My awarded points</h4>
			<div class="psg-rewards-point-top">
				<h2 class="psg-rewards-point-number"><?php echo $user_point; ?></h2>
				<a href="<?php echo wc_get_account_endpoint_url('points-history'); ?>" class="psg-rewards-history-btn"><i class="fal fa-eye"></i><span>View Points History</span></a>
			</div>
			<p class="psg-rewards-point-info">**Every $1.00 spent = 1 point</p>
			<p class="psg-rewards-point-info">*100 points can be redeemed equivalent of $1.00</p>
		</div>
	</div>	
</div>
