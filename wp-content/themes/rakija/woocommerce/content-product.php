<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$product_id = get_the_ID();
$product_link = get_permalink( $product_id );
$product_title = get_the_title( $product_id );
$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'medium' );
$product_price = $product->get_price();
$product_cat = wc_get_product_category_list( $product_id, ', ' );
$product_volume = $product->get_attribute( 'pa_zapremina' ); // ili naziv tvog atributa (slug)
?>

<div <?php wc_product_class( 'product-box', $product ); ?>>
    <div class="product-box__top">
		<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
        <a href="<?php echo esc_url( $product_link ); ?>">
            <?php if ( $product_image ) : ?>
                <img src="<?php echo esc_url( $product_image[0] ); ?>" alt="<?php echo esc_attr( $product_title ); ?>">
            <?php endif; ?>
        </a>
    </div>
    <div class="product-box__bottom">
        <div class="price-box">
            <span class="price"><?php echo wc_price( $product_price ); ?></span>
        </div>
		<?php
			$product_cats = get_the_terms( $product_id, 'product_cat' );

			if ( $product_cats && ! is_wp_error( $product_cats ) ) {
				$cat_names = wp_list_pluck( $product_cats, 'name' ); // Izvlači samo imena
				echo '<span class="product-cat">' . esc_html( implode( ', ', $cat_names ) ) . '</span>';
			}
		?>

        <a href="<?php echo esc_url( $product_link ); ?>" class="product-title-link">
            <h3 class="product-title"><?php echo esc_html( $product_title ); ?></h3>
        </a>

        <?php if ( $product_volume ) : ?>
            <span class="product-tax"><?php echo esc_html( $product_volume ); ?></span>
        <?php endif; ?>

        <a href="?add-to-cart=<?php echo esc_attr( $product_id ); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product_id ); ?>" class="add-to-cart-btn ajax_add_to_cart add_to_cart_button product_type_<?php echo esc_attr( $product->get_type() ); ?>">
            <span class="font-cart-plus"></span>
        </a>
    </div>
</div>
