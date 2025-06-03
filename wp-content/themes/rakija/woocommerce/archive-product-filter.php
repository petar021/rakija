<?php
/**
 * Template Name: Shop with custom filter
 *
 * Ovo je custom shop template sa filtracijom.
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="woocommerce-products-page">

    <div class="products-sidebar">
        <?php
        // Ovde uključi filter deo - možeš direktno napisati kod filtracije ili include nekog drugog fajla
        get_template_part('template-parts/shop', 'filters'); 
        ?>
    </div>

    <div class="products-main">
        <?php if (woocommerce_product_loop()) : ?>

            <?php do_action('woocommerce_before_shop_loop'); ?>

            <div class="products-grid">
                <div>
                    <?php woocommerce_product_loop_start(); ?>

                    <?php while (have_posts()) : the_post(); ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>

                    <?php woocommerce_product_loop_end(); ?>
                </div>
            </div>

        <?php else : ?>
            <?php do_action('woocommerce_no_products_found'); ?>
        <?php endif; ?>
    </div>

    <div class="pagination three-column-posts__pagination">
        <?php do_action('woocommerce_after_shop_loop'); ?>
    </div>

</div>

<?php get_footer(); ?>
