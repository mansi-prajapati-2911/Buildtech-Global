<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<div class="pag-shop-banner">
	<?php echo do_shortcode('[elementor-template id="349"]'); ?>
</div>

<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<div class="psg-product-archive">
<?php
	
$product_search = get_search_query();
	
$args = array(  
	'post_type' => 'product',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	's' => $product_search,
	'paged' => $paged,
);	
$product_query = new WP_Query( $args );
$product_list_count = $product_query->post_count;	

if(isset($_GET['nop'])) {	
	$post_per_page = $_GET['nop'];		
}		
	
if ( woocommerce_product_loop() ) {
	
?>


<div class="psg-archive-product-upper">
	
	<?php //if($product_search) {  ?>
	<div class="psg-products-search-wrp">
		<form class="search" action="<?php echo home_url( '/' ); ?>">
		  	<input type="search" class="psg-products-search-inner" name="s" placeholder="Search by product keywords" value="<?php echo $product_search; ?>">
		  	<button type="submit" class="psg-products-search-btn" value="Submit"><i class="fal fa-search"></i></button>
		  	<input type="hidden" name="post_type" value="product">
		</form>
<!-- 		<p class="psg-search-found-result" style="display: none;">Found <?php echo $product_list_count; ?> results for "<?php echo $product_search; ?>"</p> -->
    </div>
	<?php //} ?>
		
	<div class="psg-shop-upper">	
		<div class="psg-shop-upper-right-inner">	
	
			<div class="psg-shop-show-product-main">
				<span class="psg-show-product-title">Show:</span>		
				<?php global $wp;
	$current_params = $_SERVER['QUERY_STRING'];
	$current_params = remove_query_arg( 'nop', $current_params );
	$cur_url = home_url( add_query_arg( array(), $wp->request ) ); 
				?>
				<div class="psg-show-list <?php echo $cur_url; ?>">
					<a href="<?php echo $cur_url; ?>/?nop=12<?php if(!empty($current_params)){echo "&".$current_params; }?>">
						<span class="product_12 <?php if($post_per_page == 12){echo "active";} ?>">12</span>
					</a>
					<a href="<?php echo $cur_url; ?>/?nop=15<?php if(!empty($current_params)){echo "&".$current_params; }?>">
						<span class="product_15 <?php if($post_per_page == 15){echo "active";} ?>">15</span>
					</a>
					<a href="<?php echo $cur_url; ?>/?nop=30<?php if(!empty($current_params)){echo "&".$current_params; }?>">
						<span class="product_30 <?php if($post_per_page == 30){echo "active";} ?>">30</span>
					</a>
				</div>
			</div>
			<div class="psg-custom-shop-filter">
				<a class="psg-shop-filter" id="custom-filter" data-toggle="filter-sidebar-menu"><i class="fal fa-sliders-v"></i><span>Filters</span></a>		
			</div>
		</div>


		<?php
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

		?>	
	</div>
</div>
<div class="psg-archive-product-inner">
	<?php	

	woocommerce_product_loop_start();
		
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
 
	
do_action( 'woocommerce_after_main_content' );
?>
 
</div>
</div>


<?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );