<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

defined( 'ABSPATH' ) || exit; ?>

<div class="psg-order-history-main-wrp">
	<h3 class="psg-dashboard-main-heading">Order History</h3>
	<form action="<?php echo wc_get_account_endpoint_url('orders'); ?>" method="get" id="order_page_sorting_form">
	<div class="psg-order-history-topbar">
		<div class="psg-order-sortby-wrp">
			<span class="psg-order-sortby-label">Sort by:</span>
			<select class="psg-order-sortby" id="psg-order-sortby" name="sort_by">
				<?php if(!empty($_GET["sort_by"])){ ?>
					<option value="DESC" <?php if($_GET["sort_by"] == "DESC"){ echo 'selected="selected"'; } ?> >Most recent</option>
					<option value="ASC" <?php if($_GET["sort_by"] == "ASC"){ echo 'selected="selected"'; } ?> >Most oldest</option>
				<?php }else{ ?>
					<option value="DESC" selected="selected">Most recent</option>
					<option value="ASC">Most oldest</option>
				<?php } ?>
			</select>
		</div>
		<div class="psg-order-from-date-wrp">
			<div class="psg-order-from-date">
				<input type="date" name="start_date" id="start_date" class="date-picker" placeholder="From " value="<?php if(!empty($_GET['start_date'])){ echo $_GET['start_date']; }?>" />
			</div>
		</div>
		<div class="psg-order-end-date-wrp">
			<div class="psg-order-end-date">
				<input type="date" name="end_date" id="end_date" class="date-picker" placeholder="To " value="<?php if(!empty($_GET['end_date'])){ echo $_GET['end_date']; }?>" />
			</div>
		</div>
		<div class="psg-order-search-wrp">
			<div class="psg-order-search">
				<input type="text" name="order_search" value="<?php if(!empty($_GET['order_search'])){ echo $_GET['order_search']; } ?>" autocomplete="off" placeholder="Search by Keywords">
				<button type="submit"><i class="fal fa-search"></i></button>
			</div>
		</div>
	</div>	
	</form>	
<?php
	
	
do_action( 'woocommerce_before_account_orders', $has_orders ); 

	
if ( $has_orders ) : ?>
<div class="order-custom-container">

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table psg_shop_table_responsive my_account_orders account-orders-table psg_woocommerce_table_border_style">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody class="psg-account-order-body">
			<?php
			
			foreach ( $customer_orders->orders as $customer_order ) {
				
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
									<?php echo esc_html($order->get_order_number() ); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s', '%1$s', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '"><i class="fal fa-eye"></i><span>' . esc_html( $action['name'] ) . '</span></a>';
									}
								}
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
	        <nav class="psg-orders-pagination psg-pagination woocommerce-pagination">
				
<?php
				
				if(1 == $current_page){ ?> 
				<a class="prev page-numbers disable" > 
					<i class="far fa-chevron-left"></i>
				</a> <?php }
								
				if( isset($_GET['sort_by']) || isset($_GET['start_date']) || isset($_GET['end_date']) || isset($_GET['order_search']) ){
					$formate = '%#%?sort_by='.$_GET["sort_by"].'&start_date='.$_GET["start_date"].'&end_date='.$_GET["end_date"].'&order_search='.$_GET["order_search"];
				}else{
					$formate = '%#%';
				}
				
						
				$args = array(
					'base'          => esc_url( wc_get_endpoint_url( 'orders') ) . '%_%',
					'format'        => $formate,
					'total'         => $customer_orders->max_num_pages,
					'current'       => $current_page,
					'show_all'      => false,
					'end_size'      => 3,
					'mid_size'      => 3,
					'prev_next'     => true,
					'prev_text'    => __('<i class="far fa-chevron-left"></i>'),
					'next_text'    => __('<i class="far fa-chevron-right"></i>'),
					'type'          => 'plain',
					'add_args'      => false,
					'add_fragment'  => ''
				);
				
				echo paginate_links( $args );

				if($customer_orders->max_num_pages == $current_page){ ?> 
				<a class="next page-numbers disable" > 
					<i class="far fa-chevron-right"></i>
				</a> <?php }
				?>
        </nav>
	
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

</div>
	
</div>	
	