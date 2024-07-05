<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<footer class="psg_footer_main_wrp">

<?php 
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
		get_template_part( 'template-parts/footer' );
}
?>

</footer>


<!-- Start Whatsapp icon -->

<?php if( get_theme_mod('whatsapp_chat_enable') == 'true'){ ?>
<div class="psg-footer-whatsapp-icon">
<a target="_blank" href="<?php echo get_theme_mod( 'whatsapp_chat_link'); ?>"><i class="fab fa-whatsapp"></i></a>
</div>
<?php } ?>

<!-- End Whatsapp icon -->

<!-- Start Call Us icon -->

<div class="psg-footer-call-us-icon">
<a href="<?php echo get_theme_mod( 'call_us_link'); ?>"><i class="far fa-phone-alt"></i></a>
</div>

<!-- End Call Us icon -->


<script>
/*** Start Back to top JQ ***/
	jQuery('.btg-footer-back-to-top a.elementor-button').on('click', function(e) {
		jQuery("html, body").animate({scrollTop: 0}, 500);
	});
/*** End Back to top JQ ***/
</script>
	 
<!-- Start js for Search icon -->
<script>
jQuery(document).ready(function() {	
    jQuery(".psg-desktop-search .header-search-icon").on('click', function(e) {
        e.stopPropagation();
        var search = jQuery('body');
        search.addClass('psg-header-search-opened');
        jQuery('.search-close').on('click', function(e) {
            e.preventDefault();
            search.removeClass('psg-header-search-opened');
        });
        jQuery(document).on('click', function(e) {
            if (jQuery(e.target).hasClass('psg-header-search-main-section') ||
                jQuery(e.target).parents('.psg-header-search-main-section').length ||
                jQuery(e.target).parents('form').length ||
                jQuery(e.target).parents('.btn').length ||
                jQuery(e.target).is('a') ) {
                return;
            }
            if (search.hasClass('psg-header-search-opened') === true) {
                search.removeClass('psg-header-search-opened');
            }
        });
    });
});
	
</script>

<!-- End js for Search icon -->


<!-- Start header Fixed -->
<script>
jQuery(document).ready(function($) {
$(window).scroll(function(){
  var sticky = $('.site-header-wrp'),
      scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass('header-fixed');
  else sticky.removeClass('header-fixed');
});

});
</script>

<!-- End header Fixed -->



<script>
/*** Start on hover copy url ***/
function copyToClipboard(element) {
  var $temp = jQuery("<input>");
  jQuery("body").append($temp);
  $temp.val(jQuery(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  jQuery(".psg-hover-tooltip").addClass('show');  
  jQuery('.psg-hover-tooltip').text('Copied');	
}
/*** End on hover copy url ***/
</script>

	

<!-- Start Profile Image upload --> 
<script>	
jQuery(document).on('click', '.upload-field', function(){
  var file = jQuery(this).parent().parent().parent().find('.input-file');
  file.trigger('click');
});
jQuery(document).on('change', '.input-file', function(){
  jQuery(this).parent().find('.form-file-custom-btn').val(jQuery(this).val().replace(/C:\\fakepath\\/i, ''));
});
</script>
<!-- End Profile Image upload --> 


<!----------------------  Start Blog sorting Js -------------------------->
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

	jQuery(function() { 
		jQuery("#blog-sort-by").change(function() {
			var blog_sort = jQuery("#blog-sort-by #sorting-select").val();
			var blog_search = jQuery('#blog-search').val();

			var media_url = "<?php echo home_url('/blogs/'); ?>"
			var current_url      = window.location.href;	
			jQuery.ajax
			({
				url: ajaxurl, 
				dataType: "html",
				type: "POST",
				data: 
				{
					"blog_sort" : blog_sort, 
					"blog_search" : blog_search,
					"action" : "get_psg_blog_from_sort"
				},
				beforeSend: function() {
					jQuery("#psg-blog-1").html('<div class="blog-loader"><img src="<?php echo home_url(); ?>/wp-content/themes/buildtech-global/assets/images/loading.gif"></div>');
					if( current_url != media_url ){
						history.pushState(null, "", media_url);
					}
				},
				success: function(data) 
				{
					jQuery("#psg-blog-1").html(data);
				},         
			});
		});

});
</script>
<!----------------------  End Blog sorting Js -------------------------->

<!------------------- Start js For Blog Search Box -------------------------->
<script type="text/javascript">
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

	function blog_fetch(){

		var blog_search = jQuery('#blog-search').val();	
		var blog_sort = jQuery("#blog-sort-by #sorting-select").val();

		jQuery.ajax({
			url: ajaxurl,
			dataType: "html",
			type: "POST",
			data: { 
				action: 'get_psg_blog_from_sort',
				"blog_sort" : blog_sort, 
				"blog_search" : blog_search,
			},
			beforeSend: function() {
				jQuery("#psg-blog-1").html('<div class="blog-loader"><img src="<?php echo home_url(); ?>/wp-content/themes/buildtech-global/assets/images/loading.gif"></div>');
			}, 
			success: function(data) {
				jQuery('#psg-blog-1').html( data );
			}
		});

	}
</script>
<!------------------- End js For Blog Search Box -------------------------->


<!-- Start js for Minicart Popup -->
<script>
jQuery(document).ready(function(){	
	
	jQuery(".minicart-menu-link").click(function(){
		jQuery(".psg-minicart-main-wrp").toggleClass('active');
	});
	jQuery(".psg-minicart-owerlay, .psg-minicart-popup-closed").on('click', function()  {
		jQuery(".psg-minicart-main-wrp").toggleClass('active');
	});
});	
	

</script>
<!-- End js for Minicart Popup -->


<!-- Start js for Single Product Popup -->
<script>
jQuery(document).ready(function(){	
	
	jQuery(".psg-product-rating-write").click(function(){
		jQuery('#psg-tab-title-reviews').toggleClass('open');
	});
	
	jQuery(".psg-product-popup-trigger-wrp").click(function(){
		jQuery('ul.psg-product-detail-popup-list li').removeClass('open');
		jQuery(this).parent('li').toggleClass('open');
	});
	jQuery(".psg-product-detail-owerlay, .psg-product-popup-content h2").on('click', function()  {
		jQuery( "ul.psg-product-detail-popup-list li" ).removeClass("open");
	});
});	
</script>
<!-- End js for Single Product Popup -->


<!--- Start Single Product Slider JQ --->
<script>

jQuery(document).ready(function(){
	const sliderThumbs = new Swiper('.psg-sp-custom-gallery-nav .swiper-container', { 
			direction: 'horizontal',
			slidesPerView: 4,
			spaceBetween: 10,
			freeMode: true,
			mousewheel: true,
			grabCursor: true,
			breakpoints: {
				768: {
				  direction: 'vertical',
				}
			}
		});

		const sliderImages = new Swiper('.psg-sp-custom-gallery-slider .swiper-container', {
			direction: 'horizontal',
			autoHeight: false,
			spaceBetween: 20,
			//speed: 500,
			freeMode: true,
			loop: false,
			slidesPerView: 1,
			centeredSlides: true,
			roundLengths: true,
			mousewheel: {
				enabled: false,
			},
			grabCursor: true,
			thumbs: {
				swiper: sliderThumbs
			},
			breakpoints: {
				768: {
				  direction: 'vertical',
				  mousewheel: {
					eventsTarged: ".psg-single-product-top", 
				    //eventsTarged: ".psg-sp-custom-gallery-slider",
				    enabled: true,
					sensitivity: 5,
					releaseOnEdges: true,
				 },	
				}
			}
		});	
});
	
// 	Start JS for product images popup
	
	jQuery('.psg-sp-custom-gallery-slider .swiper-slide').magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		callbacks: {
			elementParse: function(item) {
				console.log(item.el[0].className);
				item.type = 'image',
					item.tLoading = 'Loading image #%curr%...',
					item.mainClass = 'mfp-img-mobile',
					item.image = {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
				}

			}
		}
	});

// 	End JS for product images popup	

</script>
<!--- End Single Product Slider JQ --->


<!---  Start js for wishlist module --->

<script type="text/javascript">
	jQuery( document ).on( 'change', '.variations select', function() {
		// Get the selected variation ID
		var variation_id = jQuery('.variation_id').val();	
		var wishlistValues = jQuery('#wishlist_old_val').val().split(',');
		var product_id = jQuery('input[name="product_id"]').val();

		if(variation_id !== ''){
			var product_class = 'wishlist_' + product_id;
			var variation_class = 'wishlist_' + variation_id;
			
			jQuery('#whislist_single_icon_wrp').attr( 'data-id', variation_id );
			jQuery('#whislist_single_icon_wrp').removeClass(product_class).addClass(variation_class);
			
		}	

		if (wishlistValues.indexOf(variation_id) >= 0) {
			jQuery('#whislist_single_icon_wrp').addClass('added');
		} else {
			jQuery('#whislist_single_icon_wrp').removeClass('added');
		}

	});
	
	jQuery(".woocommerce div.product form.cart .reset_variations").click(function() {	
		var variation_id = jQuery('.variation_id').val();
		var product_id = jQuery('input[name="product_id"]').val();	
		
		var product_class = 'wishlist_' + product_id;
		var variation_class = 'wishlist_' + variation_id;
		
		jQuery('#whislist_single_icon_wrp').removeClass('added');
		jQuery('#whislist_single_icon_wrp').removeClass(variation_class).addClass(product_class);
	});		
	
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	jQuery("#wishlist-icon-main .wishlist-icon, .add_to_wishlist").click(function(){
		var product_id = jQuery(this).data("id");
		var user = '<?php echo get_current_user_id(); ?>';
		<?php if( is_user_logged_in() ) { ?> 
		jQuery.ajax
		({
			url: ajaxurl,
			dataType: "html",
			type: "POST",
			data:
			{
				"users" : user,
				"product_ids" : product_id,
				"action" : "get_product_wishlist"
			},
			success: function(data)
			{			
				jQuery(".wishlist_" + product_id).addClass('added');
			},
		});
		<?php } else { ?>
			window.location.href = '<?php echo ( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>'	 
		<?php } ?>
	});	
</script>

<!--- End js for wishlist module --->


<!-- Whishlist Single Product jQuery for variation products Start -->

<script>
	jQuery(document).ready(function (){
		if(jQuery('.woocommerce-variation-add-to-cart .variation_id').val() == '' || jQuery('.woocommerce-variation-add-to-cart .variation_id').val() == '0'){
			jQuery('.single-product-upper .wishlist-icon').prop('disabled', true);
			jQuery('.single-product-upper .wishlist-icon-main').addClass('whishlist_disabled');
		}
		jQuery(".variation_id").change(function(){
			if(jQuery('.woocommerce-variation-add-to-cart .variation_id').val() == '' || jQuery('.woocommerce-variation-add-to-cart .variation_id').val() == '0'){
				jQuery('.single-product-upper .wishlist-icon').prop('disabled', true);
			}
			else{
				jQuery('.single-product-upper .wishlist-icon').prop('disabled', false);
				jQuery('.single-product-upper .wishlist-icon-main').removeClass('whishlist_disabled');
			}
		});
	});
	
</script>

<!-- Whishlist Single Product jQuery for variation products End -->

<script>
	jQuery("input#psg_password_enable").click(function () {
		if (jQuery(this).is(":checked")) {
			jQuery(".edit-change-password-info .woocommerce-Input--password").removeAttr("disabled");
		} else {
			jQuery(".edit-change-password-info .woocommerce-Input--password").attr("disabled", "disabled");
		}
	});
	
	function file_upload_preview(input) {
		if (input.files && input.files[0]) {
				var reader = new FileReader();  
				reader.onload = function (e) {
						jQuery('.logoContainer img').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
		}
	}
	jQuery(".custom-file-upload input.input-file").change(function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();            
			reader.onload = function (e) {
				jQuery('.psg-edit-profile-image img').attr('src', e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
		}
	});
</script>


<!--- Start js for Order Page sorting --->

<script type="text/javascript">
jQuery(".psg-order-history-topbar").change(function(){
	jQuery( "#order_page_sorting_form" ).submit();
});
</script>

<!---  End js for Order Page sorting --->


<!--- Start js for Points History Page sorting and filter --->

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

	jQuery(function() { 
		jQuery("#psg_points_transactions").change(function() {
			var points_history = jQuery(this).val();
			var points_sort = jQuery("select#psg-order-sortby").val();
			
			var media_url = "<?php echo wc_get_account_endpoint_url('points-history'); ?>"
			var current_url      = window.location.href;	
			
			jQuery.ajax({
				url: ajaxurl, 
				dataType: "html",
				type: "POST",
				data: 
				{
					"points_history" : points_history,
					"points_sort" : points_sort,
					"action" : "get_points_history_table"
				},
				beforeSend: function() {
					jQuery(".psg-points-history-sorting-table").html('<div class="media-loader"><img src="<?php echo home_url(); ?>/wp-content/themes/buildtech-global/assets/images/loading.gif"></div>');
					if( current_url != media_url ){
						history.pushState(null, "", media_url);
					}
				},
				success: function(data) 
				{
					jQuery(".psg-points-history-sorting-table").html(data);
				},  
			});
		});
	});

	jQuery(function() { 
		jQuery("#psg-order-sortby").change(function(){
			var points_history = jQuery("#psg_points_transactions").val();
			var points_sort = jQuery(this).val();
			
			var media_url = "<?php echo wc_get_account_endpoint_url('points-history'); ?>"
			var current_url      = window.location.href;
			
			jQuery.ajax({
				url: ajaxurl, 
				dataType: "html",
				type: "POST",
				data: 
				{
					"points_history" : points_history,
					"points_sort" : points_sort,
					"action" : "get_points_history_table"
				},
				beforeSend: function() {
					jQuery(".psg-points-history-sorting-table").html('<div class="media-loader"><img src="<?php echo home_url(); ?>/wp-content/themes/buildtech-global/assets/images/loading.gif"></div>');
					if( current_url != media_url ){
						history.pushState(null, "", media_url);
					}
				},
				success: function(data) 
				{
					jQuery(".psg-points-history-sorting-table").html(data);
				},  
			});
		});
	});	
	
jQuery(".psg-points-history-filter-link").click(function () {
    jQuery(".psg-points-history-filter-link").removeClass("active");
    jQuery(this).addClass("active"); 
});	
	
</script>	
	
<!--- End js for Points History Page sorting and filter --->


<!-- Start js for Invoice -->

<script>
	
function printdatafunction() {		
var data = jQuery( ".psg-view-order-main" ).html();
jQuery(".view-order-print-append").html(data);
}	
printdatafunction();
	
</script>

<!-- End js for Invoice -->

<script>
/*** Start Dashboard Menu JQ ***/
	jQuery(".psg-wd-sidebar-toggle-wrp").click(function(){
		jQuery(this).toggleClass("active");
		jQuery(".psg-wd-sidebar-menu-wrp").slideToggle();
	});
/*** End Dashboard Menu JQ ***/	
</script>


<script>
/*** Start Checkout JQ ***/
	
	jQuery(".psg-checkout-mobile-toggle-btn i").click(function(){
		jQuery(".psg-checkout-right-wrp").toggleClass('psg-hide');
		jQuery('.psg-checkout-mobile-wrp').toggleClass('active');
	});
	
	<?php if( !is_front_page() ){ ?>
	jQuery(document).ready(function(){
		jQuery('.site-header-wrp').css('min-height', jQuery('.site-header-wrp').innerHeight() + "px");
	});
	jQuery(window).on('resize', function(){
		jQuery('.site-header-wrp').css('min-height', jQuery('.psg-header-main-wrp ').innerHeight() + "px");
	});
	<?php } ?>
	
	// Fix Sidebar
	jQuery(function() {
		var top = jQuery('.psg-checkout-right-wrp').offset().top - parseFloat(jQuery('.psg-checkout-right-wrp').css('marginTop').replace(/auto/, 0));
		var footTop = jQuery('.psg_footer_main_wrp').offset().top - parseFloat(jQuery('.psg_footer_main_wrp').css('marginTop').replace(/auto/, 0));

		var maxY = footTop - jQuery('.psg-checkout-right-wrp').outerHeight();

		jQuery(window).scroll(function(evt) {
			var y = jQuery(this).scrollTop();
			if (y >= top - jQuery('.psg-header-main-wrp ').height() && window.matchMedia("(min-width: 992px)").matches) {
				if (y < maxY - 200) {
					jQuery('.psg-checkout-right-wrp').addClass('fixed').removeAttr('style');
				} else {
					if(window.matchMedia("(min-width: 992px)").matches){
						jQuery('.psg-checkout-right-wrp').removeClass('fixed').css({
							position: 'absolute',
							top: ((maxY - top) - 50) + 'px',
							right: '0px',
							height: '100%'
						});
					}else{
						jQuery('.psg-checkout-right-wrp').removeClass('fixed');
					}
				}
			} else {
				jQuery('.psg-checkout-right-wrp').removeClass('fixed').removeAttr('style');;
			}
		});
	});
	
	jQuery(document).on("ajaxSend", function(){
		var notice_message = jQuery('.woocommerce > .woocommerce-notices-wrapper').html();
		jQuery('.woocommerce > .woocommerce-notices-wrapper').html('');
		jQuery('.psg-checkout-notification-main-wrp').append(notice_message);
	});
	
	jQuery( document ).ajaxComplete(function() {
		var checkout_bottom_height = jQuery('.psg-checkout-bottom').innerHeight();
		var max_height = "calc(100% - " + checkout_bottom_height +"px)";
		jQuery('.psg-checkout-review-order-table-wrp').css("max-height", max_height);		
	});
	
	jQuery( document ).ajaxComplete(function() {
		var checkout_bottom_height = jQuery('.psg-checkout-mobile-wrp .psg-checkout-bottom').innerHeight();
		var max_height = "calc(100% - " + checkout_bottom_height +"px)";
		jQuery('.psg-checkout-mobile-wrp .psg-checkout-review-order-table-wrp').css("max-height", max_height);		
	});
	
	// Custom checkout Btn 
	
	jQuery(document).ready(function($) {
		$(document).on('click', '.psg-pay-btn', function(e) {
			e.preventDefault();
			$('#place_order').attr('disabled', true);
			$('#psg_checkout_form').submit();
		});
	});
	
/*** End Checkout JQ ***/
	
</script>


<!-- Start js for Shop Filter -->

<script>
	
jQuery(document).ready(function(){	
	
	jQuery(".psg-shop-filter").click(function(){
		jQuery(".psg_filter_bar").toggleClass('filter-sidebar-menu-open');
	});
	jQuery(".psg-shop-filter-owerlay, .psg_filter_close").on('click', function()  {
		jQuery(".psg_filter_bar").toggleClass('filter-sidebar-menu-open');
	});
});			
	
</script>

<!-- End js for Shop Filter -->


<script type="text/javascript">
/*** Start Add New Shipping & Billing Address Popup JQ ***/	
	
	jQuery("div#add_new_billing_address").click(function(){
		jQuery('#add_new_billing_address_popup').toggleClass('open');
		var name = jQuery(this).data("form");
		window.location.hash = '?addresss_popup='+name;
	});
	
	jQuery("div#add_new_shipping_address").click(function(){
		jQuery('#add_new_shipping_address_popup').toggleClass('open');
		var name = jQuery(this).data("form");
		window.location.hash = '?addresss_popup='+name;
	});

	
	jQuery(".psg-ma-add-new-popup-overlay, .psg-address-cancel-button").on('click', function()  {
		jQuery( "#add_new_billing_address_popup, #add_new_shipping_address_popup" ).removeClass("open");
		window.location.hash = '';
	});
	
	jQuery(function() {
		if (jQuery('#psg_multiple_address_billing_form .customer_errors').length > 0) {
			jQuery('#add_new_billing_address_popup').addClass('open');
		}
		if (jQuery('#psg_multiple_address_shipping_form .customer_errors').length > 0) {
			jQuery('#add_new_shipping_address_popup').addClass('open');
		}
	});
	
// 	jQuery(function() {
// 		var siteURL = '<?php //echo site_url(); ?>';
// 		if (window.location.href === siteURL + '/psg-login/edit-address/#?addresss_popup=billing') {
// 		//if(window.location.href === 'https://projs.ifdemo.com/p15/psg2023/psg-login/edit-address/#?addresss_popup=billing'){
// 			jQuery('#add_new_billing_address_popup').addClass('open');
// 		}
// 		if (window.location.href === siteURL + '/psg-login/edit-address/#?addresss_popup=shipping') {	
// 		//if(window.location.href === 'https://projs.ifdemo.com/p15/psg2023/psg-login/edit-address/#?addresss_popup=shipping'){
// 			jQuery('#add_new_shipping_address_popup').addClass('open');
// 		}
// 	});

/*** End Add New Shipping & Billing Address Popup JQ ***/	
</script>


<!-- Start js for add div after title and slideToggle -->

<script>
	jQuery( ".psg-shop-filter-popup .prdctfltr_filter .widget-title" ).after( '<i class="far fa-chevron-up"></i>' );
	
	
	jQuery(".psg-shop-filter-popup .prdctfltr_filter .pf-help-title i").click(function(){
		jQuery(this).toggleClass("down");
    	jQuery(this).parent().next(".psg-shop-filter-popup .prdctfltr_wc_widget .prdctfltr_add_scroll").slideToggle("slow");
		
	});
	
</script>

<!-- End js for add div after title and slideToggle -->


<!-- Start js for View order add div after title and slideToggle -->

<script>
	jQuery(document).ready(function() {
	var windowWidth = jQuery(window).width();
	if (windowWidth < 768) {

	jQuery( ".view-custom-order-container .psg-address-title" ).after( '<i class="far fa-chevron-up"></i>' );
	
	
	jQuery(".psg-bs-arrow i").click(function(){
		jQuery(this).toggleClass("down");
    	jQuery(this).parent().next(".psg-view-order-address").slideToggle("slow");
		
	})
	} 
	});	
</script>

<!-- End js for View order add div after title and slideToggle -->

<script>
jQuery(document).ready(function() {
jQuery(".wish-page-numbers a").click(function () {
    jQuery(".wish-page-numbers a").removeClass("active");
     jQuery(".wish-page-numbers a").addClass("active"); // instead of this do the below 
    //jQuery(this).addClass("active");   
});
});	
</script>



<!-- Multiple Shipping Address Delete ajax -->
<script type="text/javascript">
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	jQuery(".psg-mul-address-delete-button").click(function(){
		var parent_class = jQuery(this).parent('.psg-custom-address-button-delete');
		var user_id = jQuery(this).data("userid");
		var address_id = jQuery(this).data("addressid");
		jQuery.ajax
		({
			url: ajaxurl,
			dataType: "html",
			type: "POST",
			data:
			{
				"user_id" : user_id,
				"address_ids" : address_id,
				"psg_data" :'shipping_data',
				"action" : "psg_multi_address_delete"
			},
			beforeSend: function() {
				jQuery(parent_class).html('<img src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
			},
			success: function(data)
			{
				jQuery("#psg_custom_address_ship_main").html(data);
			},
		});
	});
</script>


<!-- Multiple Billing Address Delete ajax -->
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  jQuery(".psg_mul_address_delete_button_billing").click(function(){
	  var parent_class = jQuery(this).parent('.psg-custom-address-button-delete');
	  var user_id = jQuery(this).data("userid");
	  var address_id = jQuery(this).data("addressid");
	jQuery.ajax
          ({
          url: ajaxurl,
          dataType: "html",
          type: "POST",
          data:
            {
			  "user_id" : user_id,
			  "address_ids" : address_id,
			  "psg_data" :'billing_data',
              "action" : "psg_multi_address_delete"
            },
			beforeSend: function() {
				jQuery(parent_class).html('<img src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
			},
            success: function(data)
            {
			    jQuery(".psg-custom-billing-address").html(data);
            },
          });
 });	
</script>


<!-- PSG Checkout Address Change jQyery Start -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		/* Billing */
		var user_att_id = jQuery("input[name='billing_radio_group']:checked").data("userid");
		var address_id = jQuery("input[name='billing_radio_group']:checked").val();
		var form_name = jQuery("input[name='billing_radio_group']:checked").data("form_name");
		
		<?php 
		$user_id = get_current_user_id();
		?>
		/* Billing */
		if(user_att_id == <?php echo $user_id; ?> && address_id != "defult_billing" ){
			if(form_name == 'billing'){
				<?php
				$chek_data_address = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
				if (!empty($chek_data_address) && is_array($chek_data_address)) {
					foreach($chek_data_address as $key => $value){
					?>
					if(address_id == <?php echo $key; ?>){
					jQuery('#'+form_name+'_full_name','#'+form_name+'_address_1','#'+form_name+'_address_2','#'+form_name+'_postcode','#'+form_name+'_phone','#'+form_name+'_email').val();
					jQuery('#'+form_name+'_full_name').val("<?php echo $value[1];?>");
					jQuery('#'+form_name+'_address_1').val("<?php echo $value[2];?>");
					jQuery('#'+form_name+'_address_2').val("<?php echo $value[3];?>");
					jQuery('#'+form_name+'_postcode').val("<?php echo $value[4];?>");
					jQuery('#'+form_name+'_phone').val("<?php echo $value[6];?>");
					jQuery('#'+form_name+'_email').val("<?php echo $value[5];?>");
				}
				<?php
					}
				}
			?>
		}		
	}
    // Woocommerce defualt Meta value Selected Data filing form  
	else {
	 	if(form_name == 'billing'){
				<?php 
				$defult_name = get_user_meta( $user_id, 'billing_full_name', true );
				$defult_address = get_user_meta( $user_id, 'billing_address_1', true );
				$defult_unitno = get_user_meta( $user_id, 'billing_address_2', true ); 
				$defult_postal = get_user_meta( $user_id, 'billing_postcode', true );
				$defult_phone = get_user_meta($user_id, 'billing_phone', true );
				$defult_email = get_user_meta( $user_id, 'billing_email', true );	
				?>	
				jQuery('#billing_full_name','#billing_address_1','#billing_address_2','#billing_postcode','billing_phone','#billing_email').val();
				jQuery('#billing_full_name').val("<?php echo $defult_name;?>");
				jQuery('#billing_address_1').val("<?php echo $defult_address;?>");
				jQuery('#billing_address_2').val("<?php echo $defult_unitno;?>");
				jQuery('#billing_postcode').val("<?php echo $defult_postal;?>");
				jQuery('#billing_phone').val("<?php echo $defult_phone;?>");
				jQuery('#billing_email').val("<?php echo $defult_email;?>");	
	    }			
	}
	/* Shipping */
		var user_att_id_shipping = jQuery("input[name='shipping_radio_group']:checked").data("userid");
		var address_id_shipping = jQuery("input[name='shipping_radio_group']:checked").val();
		var form_name_shipping = jQuery("input[name='shipping_radio_group']:checked").data("form_name");
	if(user_att_id_shipping == <?php echo $user_id; ?> && address_id_shipping != "defult_billing" ){
			if(form_name_shipping == 'shipping'){
				<?php
				$chek_data_address = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true );
				if (!empty($chek_data_address) && is_array($chek_data_address)) {
					foreach($chek_data_address as $key => $value){
					?>
						if(address_id_shipping == <?php echo $key; ?>){ 
							jQuery('#'+form_name_shipping+'_full_name','#'+form_name_shipping+'_address_1','#'+form_name_shipping+'_address_2','#'+form_name_shipping+'_postcode','#'+form_name_shipping+'_phone').val();
							jQuery('#'+form_name_shipping+'_full_name').val("<?php echo $value[1];?>");
							jQuery('#'+form_name_shipping+'_address_1').val("<?php echo $value[2];?>");
							jQuery('#'+form_name_shipping+'_address_2').val("<?php echo $value[3];?>");
							jQuery('#'+form_name_shipping+'_postcode').val("<?php echo $value[4];?>");
							jQuery('#'+form_name_shipping+'_phone').val("<?php echo $value[5];?>");
						}
			  <?php } 
				}
		?>
		}		
	}
    // Woocommerce defualt Meta value Selected Data filing form  
	else {
			if(form_name_shipping == 'shipping'){
			<?php
					$defult_name = get_user_meta( $user_id, 'shipping_full_name', true );
					$defult_address = get_user_meta( $user_id, 'shipping_address_1', true );
					$defult_unitno = get_user_meta( $user_id, 'shipping_address_2', true ); 
					$defult_postal = get_user_meta( $user_id, 'shipping_postcode', true );
					$defult_phone = get_user_meta($user_id, 'shipping_phone', true );
				?>
				jQuery('#shipping_full_name','#shipping_address_1','#shipping_address_2','#shipping_postcode','#shipping_phone','#shipping_email').val();
				jQuery('#shipping_full_name').val("<?php echo $defult_name;?>");
				jQuery('#shipping_address_1').val("<?php echo $defult_address;?>");
				jQuery('#shipping_address_2').val("<?php echo $defult_unitno;?>");
				jQuery('#shipping_postcode').val("<?php echo $defult_postal;?>");
				jQuery('#shipping_phone').val("<?php echo $defult_phone;?>");
		}			
	}
	jQuery(".checkout_radio_btn").click(function(e){
		var user_att_id = jQuery(this).data("userid");
		var address_id = jQuery(this).val();
		var form_name = jQuery(this).data("form_name");
		// PSG Custom Meta value Selected Data filing form  
		if(user_att_id == <?php echo $user_id; ?> && address_id != "defult_billing" ){
			if(form_name == 'billing'){
				<?php
				$chek_data_address = get_user_meta( $user_id, 'psg_custom_multiaddress_billing_data', true );
				if (!empty($chek_data_address) && is_array($chek_data_address)) {
					foreach($chek_data_address as $key => $value){
					?>
					if(address_id == <?php echo $key; ?>){
					jQuery('#'+form_name+'_full_name','#'+form_name+'_address_1','#'+form_name+'_address_2','#'+form_name+'_postcode','#'+form_name+'_phone','#'+form_name+'_email').val();
					jQuery('#'+form_name+'_full_name').val("<?php echo $value[1];?>");
					jQuery('#'+form_name+'_address_1').val("<?php echo $value[2];?>");
					jQuery('#'+form_name+'_address_2').val("<?php echo $value[3];?>");
					jQuery('#'+form_name+'_postcode').val("<?php echo $value[4];?>");
					jQuery('#'+form_name+'_phone').val("<?php echo $value[6];?>");
					jQuery('#'+form_name+'_email').val("<?php echo $value[5];?>");
				}
				<?php
					}
				}
			?>
		}
		else if(form_name == 'shipping'){
				<?php
				$chek_data_address = get_user_meta( $user_id, 'psg_custom_multiaddress_data', true );
				if (!empty($chek_data_address) && is_array($chek_data_address)) {
					foreach($chek_data_address as $key => $value){
					?>
						if(address_id == <?php echo $key; ?>){ 
							jQuery('#'+form_name+'_full_name','#'+form_name+'_address_1','#'+form_name+'_address_2','#'+form_name+'_postcode','#'+form_name+'_phone').val();
							jQuery('#'+form_name+'_full_name').val("<?php echo $value[1];?>");
							jQuery('#'+form_name+'_address_1').val("<?php echo $value[2];?>");
							jQuery('#'+form_name+'_address_2').val("<?php echo $value[3];?>");
							jQuery('#'+form_name+'_postcode').val("<?php echo $value[4];?>");
							jQuery('#'+form_name+'_phone').val("<?php echo $value[5];?>");
						}
				   <?php } 
				} ?>
		}
			
	}
    // Woocommerce defualt Meta value Selected Data filing form  
	else {
		
	 	if(form_name == 'billing'){
				<?php 
				$defult_name = get_user_meta( $user_id, 'billing_full_name', true );
				$defult_address = get_user_meta( $user_id, 'billing_address_1', true );
				$defult_unitno = get_user_meta( $user_id, 'billing_address_2', true ); 
				$defult_postal = get_user_meta( $user_id, 'billing_postcode', true );
				$defult_phone = get_user_meta($user_id, 'billing_phone', true );
				$defult_email = get_user_meta( $user_id, 'billing_email', true );	
				?>	
				jQuery('#billing_full_name','#billing_address_1','#billing_address_2','#billing_postcode','billing_phone','#billing_email').val();
				jQuery('#billing_full_name').val("<?php echo $defult_name;?>");
				jQuery('#billing_address_1').val("<?php echo $defult_address;?>");
				jQuery('#billing_address_2').val("<?php echo $defult_unitno;?>");
				jQuery('#billing_postcode').val("<?php echo $defult_postal;?>");
				jQuery('#billing_phone').val("<?php echo $defult_phone;?>");
				jQuery('#billing_email').val("<?php echo $defult_email;?>");	
	    }else{
			<?php
				$defult_name = get_user_meta( $user_id, 'shipping_full_name', true );
				$defult_address = get_user_meta( $user_id, 'shipping_address_1', true );
				$defult_unitno = get_user_meta( $user_id, 'shipping_address_2', true ); 
				$defult_postal = get_user_meta( $user_id, 'shipping_postcode', true );
				$defult_phone = get_user_meta($user_id, 'shipping_phone', true );
			?>
			jQuery('#shipping_full_name','#shipping_address_1','#shipping_address_2','#shipping_postcode','#shipping_phone','#shipping_email').val();
			jQuery('#shipping_full_name').val("<?php echo $defult_name;?>");
			jQuery('#shipping_address_1').val("<?php echo $defult_address;?>");
			jQuery('#shipping_address_2').val("<?php echo $defult_unitno;?>");
			jQuery('#shipping_postcode').val("<?php echo $defult_postal;?>");
			jQuery('#shipping_phone').val("<?php echo $defult_phone;?>");
		   }			
	}
	});
});
</script>
<!-- PSG Checkout Address Change jQyery End -->


<!-- Woocommerce default Address Delete jQuery  -->
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  jQuery(".psg_defu_address_delete_button").click(function(){
	  var parent_class = jQuery(this).parent('.psg-custom-address-button-delete');
	  var user_id = jQuery(this).data("userid");
	  var address_id = jQuery(this).data("addressid");
	jQuery.ajax
          ({
          url: ajaxurl,
          dataType: "html",
          type: "POST",
          data:
            {
			  "user_id" : user_id,
			  "address_ids" : address_id,
              "action" : "psg_default_address_delete"
            },
			beforeSend: function() {
				jQuery(parent_class).html('<img src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
			},
            success: function(data)
            {
			    jQuery("#psg_custom_address_"+address_id+"_default").html(data);
            },
          });
 });	
</script>


<!-- Start js for billing address multiclick disable  -->

<script>
	jQuery(document).ready(function($) {
		jQuery('#psg_multiple_address_billing_form').submit(function(event) {
			const submitBtn = $('#psg_multiple_billing_address_button');
			let clicks = 0;
			submitBtn.on('click', function() {
				clicks++;
				if (clicks >= 1) {
					submitBtn.prop('disabled', true);
					clicks = 0;
				}
			});
		});
	});
</script>

<!-- End js for billing address multiclick disable  -->


<!-- Start js for Shipping address multiclick disable  -->

<script>
	jQuery(document).ready(function($) {
		jQuery('#psg_multiple_address_shipping_form').submit(function() {
			const submitBtn = $('#psg_multiple_shipping_address_button');
			let clicks = 0;
			submitBtn.on('click', function() {
				clicks++;
				if (clicks >= 1) {
					submitBtn.prop('disabled', true);
					clicks = 0;
				}
			});
		});
	});
</script>

<!-- End js for Shipping address multiclick disable  -->


<!-- Start js for set default address -->

<script>
	jQuery(document).ready(function($) {
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		jQuery('.psg_set_defult_address').on('click', function(e) {
			var child_lable = jQuery(this).parent(".psg_set_defult_address_main_wrp");
			var user_id = jQuery(this).data('userid');
			var address_id = jQuery(this).data('addressid');
			jQuery.ajax({
				url: ajaxurl,
				dataType: "html",
				type: "POST",
				data:
				{
					"user_id" : user_id,
					"address_ids" : address_id,
					"action" : "psg_set_default_address"
				},
				beforeSend: function() {
					jQuery(child_lable).addClass("psg_loader_gif")
					jQuery(child_lable).prepend('<img class="psg_defu_add_load" src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
				},
				success: function(data)
				{
					jQuery(child_lable).removeClass('psg_loader_gif');
					jQuery(".psg_defu_add_load").remove();
				},
			});
			
		});
		jQuery('.psg_set_defult_address_shipping').on('click', function(e) {
			var child_lable = jQuery(this).parent(".psg_set_defult_address_main_wrp");
			var user_id = jQuery(this).data('userid');
			var address_id = jQuery(this).data('addressid');
			jQuery.ajax({
				url: ajaxurl,
				dataType: "html",
				type: "POST",
				data:
				{
					"user_id" : user_id,
					"address_ids" : address_id,
					"action" : "psg_set_default_address_shipping"
				},
				beforeSend: function() {
					jQuery(child_lable).addClass("psg_loader_gif")
					jQuery(child_lable).prepend('<img class="psg_defu_add_load" src="<?php echo home_url(); ?>/wp-content/themes/PSG/assets/images/add_loading.gif">');
				},
				success: function(data)
				{
					jQuery(child_lable).removeClass('psg_loader_gif');
					jQuery(".psg_defu_add_load").remove();
				},
			});
			
		});
	});
</script>

<!-- End js for set default address -->


<script>
/////////////////////////////////////////// Start Progress Bar ///////////////////////////////////////////
	
	jQuery("#psg_checkout_form input").keyup(function() {
		psg_progressbar();
	});
	
	 jQuery('#terms, .shipping_method[type=radio], input[name=payment_method], .psg_checkout_address_inner_filed .checkout_radio_btn[type=radio]').click(function(){
		 psg_progressbar();
	 });

	
	
	function psg_progressbar(numValid) {
		
		var numValid = 0;

		jQuery("#billing_full_name, #billing_address_1, #billing_postcode, #billing_phone, #billing_email").each(function() {
			if( !jQuery(this).val() ) {
				//numValid = numValid - 1;
			}else{
				numValid = numValid + 1;
			}			
		});		
		
		
		if(jQuery(' #terms').prop("checked") == true){
			numValid = numValid + 1;
		}
		
		if(jQuery('.shipping_method[type=radio],input[name=payment_method]').is(':checked')) {
			numValid = numValid + 1; 
		}
			
		
		var progress = jQuery(".psg-checkout-progress-bar-inner");
		
		if(numValid === 0) {
			progress.css('width', '0%');
			jQuery( ".psg-checkout-progress-bar-text" ).text( "Three step closer to completing..." );
		}else if(numValid === 1 || numValid === 2) {
			progress.css('width', '20%');
			jQuery( ".psg-checkout-progress-bar-text" ).text( "Three step closer to completing..." );
		}else if(numValid === 3 || numValid === 4 || numValid === 5) {
			progress.css('width', '40%');
			jQuery( ".psg-checkout-progress-bar-text" ).text( "Two step closer to completing..." );	
		}else if(numValid === 6) {
			progress.css('width', '80%');
			jQuery( ".psg-checkout-progress-bar-text" ).text( "One step closer to completing..." );
		}else if(numValid === 7) {
			progress.css('width', '100%');
			jQuery( ".psg-checkout-progress-bar-text" ).text( "Complete." );
		}
	}
	jQuery(document).ready(function(){
		psg_progressbar();
	});
	/////////////////////////////////////////// End Progress Bar ///////////////////////////////////////////
</script>

<!-- Start js for single product variation image  variation -->

<script>

jQuery( '.single_variation_wrap' ).on( 'show_variation', function( event, variation ) {
	var data = jQuery(".psg-sp-custom-gallery-nav .swiper-wrapper .swiper-slide-active img").attr('src');
	var str = data.replace("-100x100", "");
	jQuery('.psg-sp-custom-gallery-slider .swiper-wrapper .swiper-slide:first-child img').attr('src', str);	
});	
		
</script>
	
<!-- Start js for single product variation image  variation -->
	
	
<!-- Start js for add class on coupon remove msg -->

<script>

jQuery(document).ajaxComplete(function(){
	jQuery('.psg-coupon-remove-msg').parent('.woocommerce-message').addClass('psg-cart-remove-parent');
});

</script>

<!-- End js for add class on coupon remove msg -->


<!-- Start js for refresh checkout on address change -->

<script>	
	
jQuery(document).ready(function() {
	jQuery('input[name="ship_to_different_address"]').change(function() {
		var isChecked = jQuery(this).prop('checked');
		jQuery('input[name="ship_to_different_address"]').prop('checked', isChecked);
	});
});	
	
jQuery(document).ready(function($) {
jQuery('input[name="billing_radio_group"], input[name="shipping_radio_group"], input[name="billing_address_1"], input[name="billing_address_2"], input[name="billing_postcode"], input[name="shipping_address_1"], input[name="shipping_address_2"], input[name="shipping_postcode"], input[name="ship_to_different_address"]').change(function() {
	
	if (!$('input[name="ship_to_different_address"]').is(":checked")) {			
		var billing_full_name = $('input[name="billing_full_name"]').val();
		var billing_email = $('input[name="billing_email"]').val();
		var billing_phone = $('input[name="billing_phone"]').val();
		var billing_address_1 = $('input[name="billing_address_1"]').val();
		var billing_address_2 = $('input[name="billing_address_2"]').val();
		var billing_postcode = $('input[name="billing_postcode"]').val();

		var shipping_full_name = billing_full_name;
		var shipping_phone = billing_phone;
		var shipping_address_1 = billing_address_1;
		var shipping_address_2 = billing_address_2;
		var shipping_postcode = billing_postcode;
	} else {		
		var billing_full_name = $('input[name="billing_full_name"]').val();
		var billing_email = $('input[name="billing_email"]').val();
		var billing_phone = $('input[name="billing_phone"]').val();
		var billing_address_1 = $('input[name="billing_address_1"]').val();
		var billing_address_2 = $('input[name="billing_address_2"]').val();
		var billing_postcode = $('input[name="billing_postcode"]').val();

		var shipping_full_name = $('input[name="shipping_full_name"]').val();
		var shipping_phone = $('input[name="shipping_phone"]').val();
		var shipping_address_1 = $('input[name="shipping_address_1"]').val();
		var shipping_address_2 = $('input[name="shipping_address_2"]').val();
		var shipping_postcode = $('input[name="shipping_postcode"]').val();	
	}
	
	
    // Send an AJAX request to refresh the shipping methods
    jQuery.ajax({
        type: 'POST',
        url: wc_checkout_params.ajax_url,
        data: {
        action: 'refresh_checkout',
       	 	billing_full_name: billing_full_name,
			billing_email: billing_email,
			billing_phone: billing_phone,
			billing_address_1: billing_address_1,
			billing_address_2: billing_address_2,
			billing_postcode: billing_postcode,
			billing_country: 'SG',
			
			shipping_full_name: shipping_full_name,
			shipping_phone: shipping_phone,
			shipping_address_1: shipping_address_1,
			shipping_address_2: shipping_address_2,
			shipping_postcode: shipping_postcode,
			shipping_country: 'SG',
      	},
		beforeSend: function() {				
			jQuery("div.psg-checkout-shipping-method-wrp").append('<div class="psg-shipping-method-loader"><img src="../wp-content/themes/PSG/assets/images/checkout-loader.svg"></div>');
    	},
                 
        success: function( response ) {
            jQuery( 'div.psg-checkout-shipping-method-wrp' ).replaceWith(response.data);

        },
        error: function( error ) {
            console.log( error );
        },
	});
    });
});	
	
	
jQuery( function() {
	jQuery('input[name="billing_radio_group"], input[name="shipping_radio_group"], input[name="billing_address_1"], input[name="billing_address_2"], input[name="billing_postcode"], input[name="shipping_address_1"], input[name="shipping_address_2"], input[name="shipping_postcode"], input[name="ship_to_different_address"]').change(function() {
	  jQuery( 'body' ).trigger( 'update_checkout' );
	});
});
	
</script>

<!-- End js for refresh checkout on address change -->


<!-- Start js for Mobile(Offcanvas) menu -->

<script>
	
jQuery( document ).ready(function() {
	
	jQuery(".psg_toggle_icon").click(function() {
		jQuery(".psg_mobile_menu").addClass("active");
		jQuery("body").addClass("psg_menu_open");
	});
	jQuery(".psg_mobile_close_btn").click(function() {
		jQuery(".psg_mobile_menu").removeClass("active");
		jQuery("body").removeClass("psg_menu_open");
	});
	
// 	jQuery(".psg_menu_open").click(function(e){
// 		jQuery(".psg_mobile_menu").removeClass("active");
// 		e.preventDefault();
// 	});
	
	jQuery('<i class="fal fa-chevron-right"></i>').insertAfter( ".psg_mobile_nav .menu > li.menu-item-has-children > .psg-link > a" );
	jQuery('<i class="fal fa-chevron-right"></i>').insertAfter( ".psg_mobile_nav .menu > li > .sub-menu-wrap > ul.sub-menu > li.menu-item-has-children > .psg-link > a" );
	jQuery('<i class="fal fa-chevron-right"></i>').insertAfter( ".psg_mobile_nav .menu > li > .sub-menu-wrap > ul.sub-menu > li > .sub-menu-wrap > ul.sub-menu > li.menu-item-has-children > .psg-link > a" );

 	jQuery('<div class="psg-offcanvas-back-btn"><i class="fal fa-arrow-left"></i></i>Back</div><h6 class="current_menu_name"></h6>').insertBefore('.psg_mobile_nav .menu > li.menu-item-has-children > .sub-menu-wrap > ul.sub-menu > li:first-child');
	
	jQuery(".psg_mobile_nav .menu > li.menu-item-has-children > .psg-link i").click(function(e){
		var current_menu =  jQuery(this).parents().children('a').text();
		jQuery('.current_menu_name').html(current_menu + '<i class="fal fa-long-arrow-right"></i>');

		jQuery(this).parents().parents().addClass("menu_open");
		e.preventDefault();
	});
	
	jQuery(".psg_mobile_my_account_menu > li.menu-item-has-children > .psg-link i").click(function(e){
		jQuery(this).parents().parents().addClass("menu_open");
		e.preventDefault();
	});
	
	jQuery(".psg-offcanvas-back-btn").click(function(e){
		jQuery(this).parents().parents().removeClass("menu_open");
		e.preventDefault();
	});
	
	jQuery(".psg_mobile_nav .menu > li > .sub-menu-wrap > ul.sub-menu > li.menu-item-has-children > .psg-link i, .psg_mobile_nav .menu > li > .sub-menu-wrap > ul.sub-menu > li > .sub-menu-wrap > ul.sub-menu > li.menu-item-has-children > .psg-link i").click(function(e){
		e.preventDefault();
		jQuery(this).parents(".psg-link").parents("li.menu-item-has-children").toggleClass("mobile_menu_open");
		e.preventDefault();
		jQuery(this).parents(".psg-link").next(".sub-menu-wrap").toggle("slow");
	});
	
});
	
</script>

<!-- End js for Mobile(Offcanvas) menu -->
	

<!-- Start js for cart page quantity on mobile -->

<script>	
if (window.matchMedia("(max-width: 768px)").matches) {
   var myDiv = jQuery('.woocommerce .psg-cart-page-main-wrp tr.cart_item td.product-quantity').detach();
}	
</script>

<!-- End js for cart page quantity on mobile -->


<!-- Start js for header sorting -->

<script>
jQuery(".psg-header-sorting #sorting-search").change(function(){
	var input_data = jQuery('.psg-header-sorting #sorting-search option:selected').val();
	//console.log(input_data);
	jQuery('input[type=hidden]#post_type').val(input_data);
	});
</script>

<!-- End js for header sorting -->



<!-- Start js for password change template password strength -->

<script>
jQuery(document).ready(function($) {
    $(document).on('keyup', '.psg-change-password-template-main #password', function() {
        var password = $(this).val();
        var strength = getPasswordStrength(password);
        var meter = $('#password-strength-meter');
        meter.removeClass().addClass(getPasswordStrengthClassName(strength));
        meter.html(getPasswordStrengthLabel(strength));
    });
});

function getPasswordStrength(password) {
    var score = 0;
    if (password.length > 7) {
        score++;
    }
    if (/[a-z]/.test(password)) {
        score++;
    }
    if (/[A-Z]/.test(password)) {
        score++;
    }
    if (/[0-9]/.test(password)) {
        score++;
    }
    if (/[!@#$%^&*()\-_=+{};:,<.>]/.test(password)) {
        score++;
    }
    return score;
}

function getPasswordStrengthClassName(strength) {
    switch (strength) {
        case 0:
            return 'pw-very-weak password-strength-meter-main';
        case 1:
            return 'pw-weak password-strength-meter-main';
        case 2:
            return 'pw-mediocre password-strength-meter-main';
        case 3:
            return 'pw-strong password-strength-meter-main';
        case 4:
            return 'pw-very-strong password-strength-meter-main';
        default:
            return 'pw-default password-strength-meter-main';
    }
}

function getPasswordStrengthLabel(strength) {
    switch (strength) {
        case 0:
            return 'Very very weak.';
        case 1:
            return 'Very weak - Please enter a stronger password.';
        case 2:
            return 'Weak - Please enter a stronger password.';
        case 3:
            return 'Medium';
        case 4:
            return 'Strong';
        default:
            return 'Strong';
    }
}
</script>

<!-- End js for password change template password strength -->


<!-- Start js for submit button disable password change template password strength -->

<script>
	jQuery(":input#password.psg-change-password-new").on("keyup change", function(e) {
		if (jQuery("#password-strength-meter").hasClass("pw-weak")) {
			jQuery(".change-password-btn").prop("disabled", true);
		}
		else if (jQuery("#password-strength-meter").hasClass("pw-mediocre")) {
			jQuery(".change-password-btn").prop("disabled", true);
		}
		else if (jQuery("#password-strength-meter").hasClass("pw-strong")) {
			jQuery(".change-password-btn").prop("disabled", true);
		}
		else {
			jQuery(".change-password-btn").prop("disabled", false);
		}
	});	
</script>

<!-- End js for submit button disable password change template password strength -->


<!-- Start js for signup form password strength -->

<script>
jQuery(document).ready(function($) {
    $(document).on('keyup', '.woocommerce-form-register #reg_password', function() {
        var password = $(this).val();
        var strength = getPasswordStrength(password);
        var meter = $('#password-strength-meter');
        meter.removeClass().addClass(getPasswordStrengthClassName(strength));
        meter.html(getPasswordStrengthLabel(strength));
    });
});

function getPasswordStrength(password) {
    var score = 0;
    if (password.length > 7) {
        score++;
    }
    if (/[a-z]/.test(password)) {
        score++;
    }
    if (/[A-Z]/.test(password)) {
        score++;
    }
    if (/[0-9]/.test(password)) {
        score++;
    }
    if (/[!@#$%^&*()\-_=+{};:,<.>]/.test(password)) {
        score++;
    }
    return score;
}

function getPasswordStrengthClassName(strength) {
    switch (strength) {
        case 0:
            return 'pw-very-weak password-strength-meter-main';
        case 1:
            return 'pw-weak password-strength-meter-main';
        case 2:
            return 'pw-mediocre password-strength-meter-main';
        case 3:
            return 'pw-strong password-strength-meter-main';
        case 4:
            return 'pw-very-strong password-strength-meter-main';
        default:
            return 'pw-default password-strength-meter-main';
    }
}

function getPasswordStrengthLabel(strength) {
    switch (strength) {
        case 0:
            return 'Very very weak.';
        case 1:
            return 'Very weak - Please enter a stronger password.';
        case 2:
            return 'Weak - Please enter a stronger password.';
        case 3:
            return 'Medium';
        case 4:
            return 'Strong';
        default:
            return 'Strong';
    }
}

</script>

<!-- End js for signup form password strength -->


<!-- Start js for submit button disable signup password strength -->

<script>
	jQuery(":input#reg_password").on("keyup change", function(e) {
		if (jQuery("#password-strength-meter").hasClass("pw-weak")) {
			jQuery("button#submit.woocommerce-form-register__submit").prop("disabled", true);
		}
		else if (jQuery("#password-strength-meter").hasClass("pw-mediocre")) {
			jQuery("button#submit.woocommerce-form-register__submit").prop("disabled", true);
		}
		else if (jQuery("#password-strength-meter").hasClass("pw-strong")) {
			jQuery("button#submit.woocommerce-form-register__submit").prop("disabled", true);
		}
		else {
			jQuery("button#submit.woocommerce-form-register__submit").prop("disabled", false);
		}
	});	
</script>

<!-- End js for submit button disable signup password strength -->


<?php wp_footer(); ?>
</body>
</html>