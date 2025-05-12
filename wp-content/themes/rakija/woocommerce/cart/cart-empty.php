<?php
defined( 'ABSPATH' ) || exit;

// // Prikazuje WooCommerce defaultnu poruku ako je korpa prazna
do_action( 'woocommerce_cart_is_empty' );

// Poruka o minimalnom broju proizvoda
?>
<!-- <div class="cart-minimum-notice">
    <p class="cart-minimum-message"><?php esc_html_e( 'Minimalan broj proizvoda za poručivanje je 3. Trenutno imate 0 u korpi.', 'your-theme-textdomain' ); ?></p>
</div> -->

<?php
// Query WooCommerce products
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 12, // Broj proizvoda za prikaz
    'paged'          => ( get_query_var('paged') ) ? get_query_var('paged') : 1 // Paginacija
);

$products_query = new WP_Query( $args );

// Prikaz proizvoda ako postoje
if ( $products_query->have_posts() ) : ?>
    <div class="products-sec">
        <!-- <div class="container"> -->
            <div class="products-sec__container">
                <?php
                while ( $products_query->have_posts() ) : $products_query->the_post();
                    $product = wc_get_product( get_the_ID() );
                    $product_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    $product_name = get_the_title();
                    $product_price = $product->get_price_html();
                    ?>
                    <div class="product-item">
                        <div class="product-item__img">
                            <a href="<?php the_permalink(); ?>">
                                <?php 
                                    $product_image_id = get_post_thumbnail_id(); // Dohvati ID istaknute slike proizvoda
                                    echo wp_get_attachment_image($product_image_id, 'product-item-img'); // Prikazuje sliku u definisanoj veličini
                                ?>
                            </a>
                        </div>
                        <div class="product-item__wrap">
                            <div class="product-item__info">
                                <h3 class="product-item__name"><?php echo esc_html( $product_name ); ?></h3>
                                <span class="product-item__price"><?php echo $product_price; ?></span>
                            </div>
                            <div class="product-item__btn">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                <span class="font-cart"></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <!-- </div> -->
    </div>
<?php endif;
wp_reset_postdata();
?>
