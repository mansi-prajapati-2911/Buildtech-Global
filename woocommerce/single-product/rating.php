<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

// echo "<pre>";
// print_r($product);
// echo "</pre>";

if ( $rating_count > 0 ){ ?>

	<div class="psg-product-rating-wrp">
		<div class="woocommerce-product-rating">
			<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
			<?php if ( comments_open() ) : ?>
			<a class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s', '%s', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a>
			<?php endif ?>

		</div>
		<p class="psg-product-rating-write"><i class="fal fa-pencil-alt"></i><span>Write A Review</span></p>
	</div>
<?php 
	}else{ ?>
	<div class="psg-product-rating-wrp">
		<div class="woocommerce-product-rating">
			<div class="star-rating" role="img"><span style="width:0%"></span></div>			
			<a class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s', '%s', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a>
		</div>
		<p class="psg-product-rating-write"><i class="fal fa-pen"></i><span>Write A Review</span></p>
	</div>
<?php }
	
?>
