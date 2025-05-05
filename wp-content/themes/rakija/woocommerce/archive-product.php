<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @package WooCommerce\Templates
 */

defined('ABSPATH') || exit;

get_header('shop');

// Povlačenje trenutne taxonomije (kategorije)
$term = get_queried_object();
?>

<?php if ($term && have_rows('content', $term)) : ?>
    <?php while (have_rows('content', $term)) : the_row(); ?>
        <?php if (get_row_layout() == 'banner_cat') : ?>
            <?php get_template_part('template-views/blocks/banner/banner-cat'); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php
/**
 * Hook: woocommerce_archive_description.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action('woocommerce_archive_description');

if (woocommerce_product_loop()) : ?>
    <div class="products-sec">
        <div class="container">
            <div class="section-head">
                <span class="section-head__pretitle">Bogat izvor magnezijuma, fosfora, mangana i gvoždja</span>
                <h1 class="section-head__title">Hrskavi hleb od 100% ovsa</h1>
            </div>
            <div class="products-sec__container">
                <?php
                // Start the WooCommerce product loop
                while (have_posts()) : the_post();
                    $product = wc_get_product(get_the_ID());
                    $product_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
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
                                <h3 class="product-item__name"><?php echo esc_html($product_name); ?></h3>
                                <span class="product-item__price"><?php echo $product_price; ?></span>
                            </div>
                            <div class="product-item__btn">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <?php
    do_action('woocommerce_after_shop_loop');
else :
    do_action('woocommerce_no_products_found');
endif;
?>

<!-- ✅ Sada prikazujemo ostale ACF blokove tek nakon proizvoda -->
<?php if ($term && have_rows('content', $term)) : ?>
    <?php while (have_rows('content', $term)) : the_row(); ?>

        <?php if (get_row_layout() == 'text_two_rows') : ?>
            <?php get_template_part('template-views/blocks/text-two-rows/text-two-rows'); ?>
        <?php elseif (get_row_layout() == 'three_rows') : ?>
            <?php get_template_part('template-views/blocks/three-rows/three-rows'); ?>
        <?php elseif (get_row_layout() == 'half_sec') : ?>
            <?php get_template_part('template-views/blocks/half-sec/half-sec'); ?>
        <?php elseif (get_row_layout() == 'review') : ?>
            <?php get_template_part('template-views/blocks/review/review'); ?>
        <?php elseif (get_row_layout() == 'text_two_rows_sec') : ?>
            <?php get_template_part('template-views/blocks/text-two-rows/text-two-rows-sec'); ?>
        <?php elseif (get_row_layout() == 'accordion') : ?>
            <?php get_template_part('template-views/blocks/accordion/accordion'); ?>
        <?php elseif (get_row_layout() == 'info_sec') : ?>
            <?php get_template_part('template-views/blocks/info-sec/info-sec'); ?>
        <?php elseif (get_row_layout() == 'text_two_rows_img') : ?>
                <?php get_template_part('template-views/blocks/text-two-rows-img/text-two-rows-img'); ?>
        <?php elseif (get_row_layout() == 'accordion') : ?>
                <?php get_template_part('template-views/blocks/accordion/accordion'); ?>
        <?php elseif (get_row_layout() == 'cta') : ?>
            <?php get_template_part('template-views/blocks/cta/cta'); ?>
        <?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
