<?php
/* Template Name: Wishlist */
get_header();

if( ! is_user_logged_in() ){
 
    wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id')) );
    exit();

}else{

?>

<div class="woocommerce psg_wishlist_main_wrp psg-woocommerce-dashboard-wrp">
<?php
do_action( 'woocommerce_account_navigation' ); 
	?>
<div class="woocommerce-MyAccount-content">
    <h3 class="psg-dashboard-main-heading">My Wishlist</h3>
<?php 
	$user_id = get_current_user_id(); 
	$product_id = get_user_meta( $user_id, 'wishlist', true ); 
    global $woocommerce , $product;
	
	$nb_elem_per_page = 6;
	$page = isset($_GET['paged_wish'])?intval($_GET['paged_wish']):1;
	if(!empty($product_id)){
		$number_of_pages = ceil(count($product_id)/$nb_elem_per_page);	
	}

	
	if(!empty($product_id)){
	 ?>                                
<div class="psg-wishlist-table-wrap" id="wishlist_table">
	<table class="psg_woocommerce_table_style psg_shop_table_responsive">
		<thead>
			<tr>
				<th colspan="2">Product</th>
				<th colspan="3">Unit Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
		    
			
			 foreach (array_slice($product_id, ($page-1)*$nb_elem_per_page, $nb_elem_per_page) as $product) {
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
							<?php	}
								  
							
				       
						?>
														
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
			var numItems = items.length;
		    jQuery('.psg-wishlist-btn #current_item').val(numItems);
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
</script>

<script>
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	jQuery(".whi_prod_delete, .move-to-bag").click(function(e){
		var del_product_id = jQuery(this).data("id");
		var del_variation_id = jQuery(this).data("variation_id");
		var user = '<?php echo get_current_user_id(); ?>';
		var current_item = jQuery(".psg-wishlist-btn #current_item").val();
    		//console.log(current_item);
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
</div>
	<?php } 
	else{ 
		echo '<p class="psg-wishlist-not-found-text">Your Wishlist is currently empty. Start adding products to your wishlist!</p>';
	} ?>
</div>	
</div>
<?php 

}	
	
get_footer();
