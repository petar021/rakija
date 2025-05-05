<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<!-- WooCommerce Hook za pre checkout forme -->


<?php
// Ako korisnik nije ulogovan, a registracija je obavezna, spreči checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<div class="checkout__main">
    <form name="checkout" method="post" class="checkout__form light-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <div class="checkout__form-container">    
            <div class="checkout__form-wrap">
                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="checkout__customer_details" id="customer_details">
                        <div class="checkout__billing">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>
            </div>

            <div class="checkout__order-details">
            
                <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                
                <h3 class="checkout__title"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
                
                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
        </div>
    </form>
</div>

<!-- WooCommerce Hook za posle checkout forme -->
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<!-- Dodavanje products_sec BLOKA ISPOD checkout forme -->
<?php if (have_rows('content')) : ?>
    <?php while (have_rows('content')) : the_row(); ?>
        <?php if (get_row_layout() == 'products_sec') : ?>
            <?php get_template_part('template-views/blocks/products-sec/products-sec'); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

