<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<?php if ( wc_coupons_enabled() ) : ?>
    <div class="coupon-section">
        <h3><?php esc_html_e( 'Promo kod', 'woocommerce' ); ?></h3>
        <form class="coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <div class="coupon__wrap">
                <div class="coupon">
                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Unesite promo kod', 'woocommerce' ); ?>" />
                    <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Pošalji', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Unesi', 'woocommerce' ); ?>
                    </button>
                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<div class="<?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ' '; ?>cart__totals">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<!-- <h2 class="cart__totals-title"><?php // esc_html_e( 'Cart totals', 'woocommerce' ); ?></h2> -->

	<div class="shop_table shop_table_responsive">

		<div class="cart__subtotal cart__totals-item">
			<span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</span>
			<span><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> cart__totals-item">
				<span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
				<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<div class="checkout__totals-item">
				<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

				<!-- Grupisanje ikonice i teksta "Dostava" u jedan div -->
				<div class="shipping-label">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/truck.svg" alt="Dostava" width="20" height="20">
					<span>Dostava</span>
				</div>

				<!-- Drugi div samo za cenu dostave -->
				<div class="shipping-price">
					<?php 
						$shipping_packages = WC()->shipping->get_packages();
						$shipping_method = WC()->session->get('chosen_shipping_methods')[0]; // Dobija aktivnu metodu dostave
						$shipping_rate = $shipping_packages[0]['rates'][$shipping_method];

						if ( isset($shipping_rate) ) {
							echo wc_price($shipping_rate->cost); // Prikazuje samo cenu dostave
						}
					?>
				</div>

				<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
			</div>
		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="shipping cart__totals-item">
				<span><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
				<span><?php woocommerce_shipping_calculator(); ?></span>
			</div>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee cart__totals-item">
				<span><?php echo esc_html( $fee->name ); ?></span>
				<span><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> cart__totals-item">
						<span><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
					<?php
				}
			} else {
				?>
				<div class="tax-total cart__totals-item">
					<span><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="cart__order-total cart__totals-item">
			<span><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
			<span><?php wc_cart_totals_order_total_html(); ?></span>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>

	<div class="cart__order-checkout-btn">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
