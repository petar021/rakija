<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

// Dobijamo povezane proizvode
$related_products = wc_get_related_products( $product->get_id(), 4 ); // Maksimalno 4 povezana proizvoda

if ( $related_products ) : ?>

    <div class="container">
        <h2>Pogledaj i ostale ukuse</h2>
        <div class="products-sec__container">
            <?php foreach ( $related_products as $related_product_id ) : 
                $related_product = wc_get_product( $related_product_id );
                $product_image_url = get_the_post_thumbnail_url( $related_product_id, 'full' ); // URL slike
                $product_name = $related_product->get_name(); // Ime proizvoda
                $product_price = $related_product->get_price_html(); // Cena proizvoda
                $product_permalink = get_permalink( $related_product_id ); // Link ka proizvodu
                ?>
                <div class="product-item">
                    <div class="product-item__img">
                        <a href="<?php echo esc_url( $product_permalink ); ?>"> <!-- Link ka stranici proizvoda -->
                            <img src="<?php echo esc_url( $product_image_url ); ?>" alt="<?php echo esc_attr( $product_name ); ?>" />
                        </a>
                    </div>
                    <div class="product-item__wrap">
                        <div class="product-item__info">
                            <h3 class="product-item__name"><?php echo esc_html( $product_name ); ?></h3>
                            <span class="product-item__price"><?php echo $product_price; ?></span>
                        </div>
                        <div class="product-item__btn">
                            <a class="btn" href="<?php echo esc_url( $related_product->add_to_cart_url() ); ?>" data-product_id="<?php echo esc_attr( $related_product_id ); ?>" class="add_to_cart_button"><?php esc_html_e( 'Dodaj u korpu', 'woocommerce' ); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    

<?php endif;

wp_reset_postdata();
?>
