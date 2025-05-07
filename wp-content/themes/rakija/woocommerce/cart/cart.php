<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit; ?>

<!-- <div class="container"> -->
    <?php do_action( 'woocommerce_before_cart' ); ?>

        
  
<!-- </div> -->
<h2 class="section-title">Korpa</h2>
<div class="cart cart-page">
    <!-- <div class="container"> -->
        <div class="cart__wrap">
            <form class="cart__form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <table class="cart__table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="cart__header-thumbnail" colspan="2"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th class="cart__header-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <tr class="cart__item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                    <td class="cart__thumbnail">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                        if ( ! $product_permalink ) {
                                            echo $thumbnail;
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                        }
                                        ?>
                                    </td>

                                    <td class="cart__product">
                                        <div class="cart__product-name">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( $product_name . '&nbsp;' );
                                            } else {
                                                echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) );
                                            }

                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                            echo wc_get_formatted_cart_item_data( $cart_item );

                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo wp_kses_post( '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' );
                                            }
                                            ?>
                                        </div>
                                    </td>

                                    <td class="cart-qty">
                                        <div class="cart__product-quantity">
                                            <?php
                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    'input_value'  => $cart_item['quantity'],
                                                    'max_value'    => $_product->get_max_purchase_quantity(),
                                                    'min_value'    => '0',
                                                    'product_name' => $product_name,
                                                ),
                                                $_product,
                                                false
                                            );

                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                            ?>
                                        </div>
                                    </td>

                                    <td class="cart__remove">
                                        <div class="cart__product-remove">
                                            <?php
                                                echo apply_filters(
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                            <span class="icon font-trash"></span>
                                                        </a>', 
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                            ?>
                                        </div>
                                    </td>

                                    <td class="cart__subtotal">
                                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                    </td>        
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>

            </form>

            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

            <div class="cart__collaterals">

                <!-- Ostatak sadržaja (ukupna cena, dugme za plaćanje) -->
                <?php do_action( 'woocommerce_cart_collaterals' ); ?>
            </div>

        </div>
    <!-- </div> -->
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
