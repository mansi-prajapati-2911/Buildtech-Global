<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form class="woocommerce-ordering" method="get">
	<h3 class="woocommrece-order-sort">Sort by</h3> 
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
	


<div id="shop-filter-fullscreen-menu" class="psg_filter_bar">	
	<div class="psg-shop-filter-owerlay"></div>
	
	<div class="psg-shop-filter-popup">
	<div class="psg_filter_bar_open_wrp">
		<div class="psg_filter_bar_open">Filter</div>		
		<div class="psg_filter_close" data-toggle="filter-sidebar-menu"><i class="las la-times"></i></div>
	</div>	
		
	<div class="psg-products-search-wrp">
		<h4 class="psg-filter-search-title">How can we help you?</h4>
		<form class="search" action="<?php echo home_url( '/' ); ?>">
		  	<input type="search" class="psg-products-search-inner" name="s" placeholder="Search by product keywords">
		  	<button type="submit" class="psg-products-search-btn" value="Submit"><i class="fal fa-search"></i></button>
		  	<input type="hidden" name="post_type" value="product">
		</form>
    </div>		
		
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>	
	



	