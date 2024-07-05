<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$attachment_ids  = $product->get_gallery_image_ids();
$image_urls      = array();
$post_thumbnail_id  = $product->get_image_id();

$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);


if ( $post_thumbnail_id ) {
    $image_url = wp_get_attachment_image_url( $post_thumbnail_id, 'full' );
    $image_urls[ 0 ] = $image_url;
}

foreach ( $attachment_ids as $attachment_id ) {
    $image_urls[] = wp_get_attachment_url( $attachment_id );
}
?>
<div class="psg-sp-custom-gallery-main-wrp <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="psg-sp-custom-gallery-nav">
		<div class="swiper-container">
		<ol class="swiper-wrapper flex-control-nav flex-control-thumbs">
		<?php 
        foreach ( $image_urls as $image_src_url ) {
            echo '<li class="swiper-slide"><img src="' . $image_src_url . '"></li>';
        }
        ?>
		</ol>
		</div>
	</div>
	<div class="psg-sp-custom-gallery-slider">
		<div class="swiper-container">
		<figure class="swiper-wrapper flex-control-nav woocommerce-product-gallery__wrapper">
		<?php 
        foreach ( $image_urls as $image_src_url ) {
			$id  = attachment_url_to_postid( $image_src_url );
			$image_title = get_the_title($id);
			$thumbnail_img = wp_get_attachment_image_url( $id, 'thumbnail' );
			$medium_img = wp_get_attachment_image_url( $id, 'medium' );
			
			 echo '<li class="swiper-slide" data-thumb="' . $thumbnail_img . '" data-thumb-alt data-o_data-thumb="' . $thumbnail_img . '" ><a href="' . $image_src_url . '"><img src="' . $image_src_url . '" class="wp-post-image" alt="" decoding="async" loading="lazy" title="' . $image_title . '" data-caption data-src="' . $image_src_url . '" data-large_image="' . $image_src_url . '" draggable="false" data-o_src="' . $image_src_url . '" data-o_srcset="' . $image_src_url . '" data-o_title="' . $image_title . '" data-o_data-caption data-o_alt data-o_data-src="' . $image_src_url . '" data-o_data-large_image="' . $image_src_url . '"></a></li>';
        }
        ?>
		</figure>
		</div>
	</div>
</div>
