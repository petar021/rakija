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

    <div class="products">
        <div class="container">
            <h2 class="section-title section-title--center">Rakija House preporučuje</h2>
            <div class="products-sec__container products-wrapper">
                <?php foreach ( $related_products as $related_product_id ) : 
                    $related_product = wc_get_product( $related_product_id );
                    $product_image_url = get_the_post_thumbnail_url( $related_product_id, 'full' ); // URL slike
                    $product_name = $related_product->get_name(); // Ime proizvoda
                    $product_price = $related_product->get_price_html(); // Cena proizvoda
                    $product_permalink = get_permalink( $related_product_id ); // Link ka proizvodu
                    ?>

                    <div class="product-box">
                        <div class="product-box__top">
                            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>"> <!-- Link ka stranici proizvoda -->
                                <img src="<?php echo esc_url( $product_image_url ); ?>" alt="<?php echo esc_attr( $product_name ); ?>" />
                            </a>
                        </div>
                        <div class="product-box__bottom">
                            <div class="price-box">
                                <span class="product-item__price price"><?php echo $product_price; ?></span>
                            </div>

                            <?php
$product_id = get_the_ID(); // ili $product->get_id() ako koristiš WC_Product objekat
$terms = get_the_terms($product_id, 'product_cat');

if (!empty($terms) && !is_wp_error($terms)) {
    $category_names = wp_list_pluck($terms, 'name');
    echo '<span class="product-cat">' . esc_html(implode(', ', $category_names)) . '</span>';
}
?>


                            <a href="<?php echo esc_url( $product_permalink ); ?>" class="product-title-link">
                                <h3 class="product-item__name product-title"><?php echo esc_html( $product_name ); ?></h3>
                            </a>
                            
                            <a 
                                class="btn add-to-cart-btn ajax_add_to_cart add_to_cart_button product_type_simple" 
                                href="<?php echo esc_url( $related_product->add_to_cart_url() ); ?>" 
                                data-product_id="<?php echo esc_attr( $related_product_id ); ?>" 
                                class="add_to_cart_button">
                                <?php esc_html_e( '', 'woocommerce' ); ?>
                                <span class="font-cart-plus"></span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="products-wrapper-cta-box">
                <a href="http://localhost/rakija/shop/" class="btn-icon">
                    <span class="font-eye"></span>
                    Pogledaj sve
                </a>
            </div>
        </div>
    </div>

<?php endif;

wp_reset_postdata();
?>
