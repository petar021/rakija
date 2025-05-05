<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="checkout__order-review">
	<?php
	do_action( 'woocommerce_review_order_before_cart_contents' );

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			?>
			<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'checkout__order-review-item', $cart_item, $cart_item_key ) ); ?>">
				<div class="checkout__product-thumbnail">
					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						echo $thumbnail; // PHPCS: XSS ok.
					?>
				</div>
				<div class="checkout__product-name">
					<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
					<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<div class="checkout__product-total">
					<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
			<?php
		}
	}

	do_action( 'woocommerce_review_order_after_cart_contents' );
	?>
</div>

<div class="checkout__totals">
	<div class="checkout__totals-item">
		<span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
		<span><?php wc_cart_totals_subtotal_html(); ?></span>
	</div>

	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> checkout__totals-item">
			<span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
			<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
		</div>
	<?php endforeach; ?>

	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
		<div class="checkout__totals-item">
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

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

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		</div>
	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<div class="fee checkout__totals-item">
			<span><?php echo esc_html( $fee->name ); ?></span>
			<span><?php wc_cart_totals_fee_html( $fee ); ?></span>
		</div>
	<?php endforeach; ?>

	<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
		<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
				<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> checkout__totals-item">
					<span><?php echo esc_html( $tax->label ); ?></span>
					<span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="tax-total checkout__totals-item">
				<span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
				<span><?php wc_cart_totals_taxes_total_html(); ?></span>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

	<div class="checkout__order-total checkout__totals-item">
		<span><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
		<span><?php wc_cart_totals_order_total_html(); ?></span>
	</div>
</div>

<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

