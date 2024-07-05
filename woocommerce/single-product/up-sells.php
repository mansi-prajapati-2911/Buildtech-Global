<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : 
$product_count = count($upsells);
?>

	<section class="up-sells upsells products psg-upsells-sp-wrp">
		<div class="psg-upsells-products-inner">
		<?php
		$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You May Also Like&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2 class="psg-upsells-sp-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<div class="psg-upsells-products-carousel-main">
			<div class="psg-upsells-products-carousel <?php if($product_count < 3 ){ echo "psg-upsells-products-grid"; } ?>">
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

			</div>
		</div>
		</div>
	</section>


<!-- Start Upsells products js -->

<?php if($product_count >= 2 ){ ?>
	

<script type="text/javascript">
	   
  var $slider = jQuery('.psg-upsells-products-carousel .products');
 
  $slider.slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  speed: 400,
	  infinite: false,
	  arrows: false,
	  dots: false,
	  responsive: [
		{
			breakpoint: 1025,
			settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: false,
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
		{
			breakpoint: 601,
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

<!-- End Upsells products js -->

	<?php
endif;

wp_reset_postdata();
