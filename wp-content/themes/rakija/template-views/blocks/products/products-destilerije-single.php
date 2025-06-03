<?php
$term = get_queried_object();

// Sortiranje (WooCommerce koristi 'orderby' GET parametar)
$orderby = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : 'menu_order';

// Dohvati proizvode za ovu podkategoriju
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'orderby' => $orderby,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ),
    ),
);

$products = new WP_Query($args);
$product_count = $products->found_posts;
?>

<section class="products">
    <div class="container">
        <form class="woocommerce-ordering" method="get">
            <label for="orderby"><?php echo esc_html($product_count); ?> proizvoda</label>
            <select class="js-example-basic-single" name="orderby" onchange="this.form.submit()">
                <option value="popularity" <?php selected($orderby, 'popularity'); ?>>Najpopularnije</option>
                <option value="date" <?php selected($orderby, 'date'); ?>>Najnovije</option>
                <option value="price" <?php selected($orderby, 'price'); ?>>Cena: rastuće</option>
                <option value="price-desc" <?php selected($orderby, 'price-desc'); ?>>Cena: opadajuće</option>
            </select>

            <?php // Zadrži ostale GET parametre osim 'orderby' ?>
            <?php
            foreach ($_GET as $key => $val) {
                if ($key === 'orderby') continue;
                echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" />';
            }
            ?>
        </form>

        <div class="products-wrapper">
            <?php if ($products->have_posts()) :
                while ($products->have_posts()) : $products->the_post();
                    global $product;
                    ?>
                    <div class="product-box">
                        <div class="product-box__top">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo $product->get_image(); ?>
                            </a>
                        </div>
                        <div class="product-box__bottom">
                            <div class="price-box">
                                <span class="price"><?php echo wc_price($product->get_price()); ?></span>
                            </div>
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'product_cat');
                            if ($terms && !is_wp_error($terms)) {
                                $names = wp_list_pluck($terms, 'name');
                                echo '<span class="product-cat">' . esc_html(implode(', ', $names)) . '</span>';
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>" class="product-title-link">
                                <h3 class="product-title"><?php the_title(); ?></h3>
                            </a>
                            <?php if ($volume = $product->get_attribute('pa_zapremina')) : ?>
                                <span class="product-tax"><?php echo esc_html($volume); ?></span>
                            <?php endif; ?>
                            <a href="?add-to-cart=<?php echo esc_attr($product->get_id()); ?>" class="add-to-cart-btn"><span class="font-cart-plus"></span></a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata();
            else :
                echo '<p>Nema proizvoda u ovoj kategoriji.</p>';
            endif; ?>
        </div>
    </div>
</section>