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


function custom_eventTypeDescription($eventType, $event = null)
{
	$eventDescription = '';
	$pointLabel = "Points";
	switch ($eventType) {
		case 'admin-adjustment':
			$eventDescription = sprintf(__('%s adjusted by "admin"', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'order-placed':
			$eventDescription = sprintf(__('%s earned for purchase', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'order-cancelled':
			$eventDescription = sprintf(__('%s adjusted for cancelled order', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'order-refunded':
			$eventDescription = sprintf(__('%s adjusted for an order refund', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'order-redeem':
			$eventDescription = sprintf(__('%s redeemed towards purchase', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'expire':
			$eventDescription = sprintf(__('%s expired', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'product-review':
			$eventDescription = sprintf(__('%s earned for product review', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'account-signup':
			$eventDescription = sprintf(__('%s earned for account signup', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'referring_user':
			$eventDescription = sprintf(__('%s earned via referral code', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'referral_point':
			$eventDescription = sprintf(__('%s earned referred some one', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'import':
			$eventDescription = __('User data imported by Admin', WLPR_TEXT_DOMAIN);
			break;
		case 'birth_date':
			$eventDescription = sprintf(__('%s earned Birthday date update', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'facebook_share':
			$eventDescription = sprintf(__('%s earned for Facebook share', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'twitter_share':
			$eventDescription = sprintf(__('%s earned for twitter share', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'email_share':
			$eventDescription = sprintf(__('%s earned for email share', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'rest-api':
			$eventDescription = sprintf(__('%s adjusted via "REST API"', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'on_birth_date':
			$eventDescription = sprintf(__('%s earned for birthday gift', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
		case 'whatsapp_share':
			$eventDescription = sprintf(__('%s earned for WhatsApp share', WLPR_TEXT_DOMAIN), $pointLabel);
			break;
	}
	return apply_filters('wlpr_point_event_description', $eventDescription, $eventType, $event);
}

?>

<div class="psg-points-history-content-main-wrp">
	<div class="psg-points-history-back-btn">
		<a href="<?php echo wc_get_account_endpoint_url('rewards'); ?>"><i class="fal fa-arrow-left"></i><span>Back</span></a>
	</div>
	
	<h3 class="psg-dashboard-main-heading">My Rewards - Points History 
		<div class="psg-points-history-available-points"> Available Points: <?php echo $user_point; ?></div>
	</h3>
	
	<?php 				
	$points_table_data = $wpdb->get_results( "SELECT * FROM wp_wlpr_user_point_actions WHERE user_email LIKE '$current_useremail' ORDER BY created_date DESC");

	$points_history = $_POST["points_history"];
	$points_sort = $_POST["points_sort"];
	
	?>
	
	<form action="<?php echo wc_get_account_endpoint_url('points-history'); ?>" method="get" id="points_history_sorting_form">
	<div class="psg-points-history-filter-main">
		<div class="psg-points-history-inner">
			<div class="psg-points-history-filter">
				<span class="psg-points-transactions-label">Filter:</span>
				<select name="psg_points_transactions" id="psg_points_transactions" class="psg-points-transactions-dropdown">
					<?php if(!empty($points_history)){?>
					<option value="All" <?php if($points_history == 'All'){echo "selected";} ?>>All transactions</option>
					<option value="Redeemed" <?php if($points_history == "Redeemed") echo 'selected'; ?>>Redeemed</option>
					<option value="Earned"  <?php if($points_history == "Earned")  echo 'selected'; ?>>Earned</option>
					<?php }else{ ?>
					<option value="All" selected>All transactions</option>
					<option value="Redeemed">Redeemed</option>
					<option value="Earned">Earned</option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="psg-points-history-sortby-wrp">
			<span class="psg-points-sortby-label">Sort by:</span>
			<select class="psg-points-history-sortby" id="psg-order-sortby" name="sort_by_ph">
				<?php if(!empty($_GET["sort_by_ph"])){ ?>
					<option value="DESC">Default sorting</option>
					<option value="DESC" <?php if($_GET["sort_by_ph"] == "DESC"){ echo 'selected="selected"'; } ?> >Most recent</option>
					<option value="ASC" <?php if($_GET["sort_by_ph"] == "ASC"){ echo 'selected="selected"'; } ?> >Most oldest</option>
				<?php }else{ ?>
					<option value="DESC">Default sorting</option>
					<option value="DESC">Most recent</option>
					<option value="ASC">Most oldest</option>
				<?php } ?>
			</select>
		</div>
	</div>
	</form>
	<div class="psg-points-history-sorting-table">
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
				$order_description = "Point earned";
			} elseif($order_action == "order-redeem") {
				$order_description = "Point redemption for purchase";
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
				$order_description = "Point earned";
			} elseif($order_action == "order-redeem") {
				$order_description = "Point redemption for purchase";
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
				$order_description = "Point earned";
			} elseif($order_action == "order-redeem") {
				$order_description = "Point redemption for purchase";
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
	</div>
	
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
	
	
</div>




