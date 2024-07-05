<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : 
$product_count = count($cross_sells);
?>

	<div class="cross-sells psg-cross-sells-sp-wrp">
		<div class="psg-cross-sells-products-inner">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2 class="psg-cross-sells-sp-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
			
		<div class="psg-cross-sells-products-carousel-main">
			<div class="psg-cross-sells-products-carousel <?php if($product_count < 3 ){ echo "psg-cross-sells-products-grid"; } ?>">	

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
			</div>
		</div>
		</div>
	</div>

<!-- Start Cross-Sells products js -->

<?php if($product_count >= 2 ){ ?>
	

<script type="text/javascript">
	   
  var $slider = jQuery('.psg-cross-sells-products-carousel .products');
 
  $slider.slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  speed: 400,
	  infinite: false,
	  arrows: false,
	  dots: false,
	  responsive: [
		 {
			breakpoint: 1350,
			settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			}
		}, 
		{
			breakpoint: 1025,
			settings: {
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: true,
	  		dots: false,
			}
		},
		{
			breakpoint: 768,
			settings: {
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: true,
	  		dots: false,
			}
		},
	 ] 
  });	   
	   
</script>
<?php } ?>

<!-- End Cross-Sells products js -->

	<?php
endif;

wp_reset_postdata();
