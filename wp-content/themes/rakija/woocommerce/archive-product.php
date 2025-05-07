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
            <div class="products__wrapper">
                <div class="products__filtration">
                    <div class="products__filtration-cta">
                        <span class="font-filter"></span>
                        <span>Filter</span>
                    </div>
                    <div class="custom-filter">
                        <!-- Filter 1: Glavne kategorije -->
                        <div class="filter-section" data-filter="rakije-subcategories">
                            <h2 class="filter-section__title">Voće</h2>

                            <?php
                            $rakije_term = get_term_by('slug', 'rakije', 'product_cat');

                            if ($rakije_term) :
                                $subcategories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => $rakije_term->term_id,
                                ));

                                $sub_count = 0;
                            ?>

                                <!-- Checkbox: Svi proizvodi koji pripadaju Rakije ili njenim podkategorijama -->
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="filter_all_rakije" checked>
                                    <span class="checkmark"></span>
                                    Svi proizvodi
                                </label>

                                <?php
                                if (!empty($subcategories) && !is_wp_error($subcategories)) :
                                    foreach ($subcategories as $subcategory) :
                                        $sub_count++;
                                        $hidden_class = $sub_count > 7 ? 'hidden-filter' : '';
                                        ?>
                                        <label class="custom-checkbox <?php echo $hidden_class; ?>">
                                            <input type="checkbox" name="rakije_subcategory[]" value="<?php echo esc_attr($subcategory->term_id); ?>">
                                            <span class="checkmark"></span>
                                            <?php echo esc_html($subcategory->name); ?>
                                        </label>
                                    <?php endforeach;
                                endif;
                                ?>

                                <?php if ($sub_count > 7): ?>
                                    <button class="show-more-btn" data-target="rakije-subcategories">Prikaži sve</button>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>

                        <!-- Filter 2: Podkategorije destilerije -->
                        <div class="filter-section" data-filter="subcategories">
                            <h2 class="filter-section__title">Destilerije</h2>

                            <?php
                            $destilerije = get_term_by('slug', 'destilerije', 'product_cat');
                            $subcategories = $destilerije ? get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                'parent' => $destilerije->term_id
                            )) : [];

                            $sub_count = 0;
                            ?>

                            <!-- Prvi checkbox: svi dostupni proizvodi -->
                            <label class="custom-checkbox">
                                <input type="checkbox" name="filter_all_destilerije" checked>
                                <span class="checkmark"></span>
                                Svi dostupni
                            </label>

                            <?php
                            if (!empty($subcategories) && !is_wp_error($subcategories)) :
                                foreach ($subcategories as $subcategory) :
                                    $sub_count++;
                                    $hidden_class = $sub_count > 7 ? 'hidden-filter' : '';
                                    ?>
                                    <label class="custom-checkbox <?php echo $hidden_class; ?>">
                                        <input type="checkbox" name="sub_category[]" value="<?php echo esc_attr($subcategory->term_id); ?>">
                                        <span class="checkmark"></span>
                                        <?php echo esc_html($subcategory->name); ?>
                                        (<?php echo intval($subcategory->count); ?>)
                                    </label>
                                <?php endforeach;
                            endif;
                            ?>

                            <?php if ($sub_count > 7): ?>
                                <button class="show-more-btn" data-target="subcategories">Prikaži sve</button>
                            <?php endif; ?>
                        </div>


                        <div class="filter-section price-range-filter">
                            <h2 class="filter-section__title">Cena</h2>
                            
                            <div class="price-slider-wrapper">
                                <div class="price-slider-track"></div>
                                <div class="price-slider-range"></div>
                                <input type="range" min="0" max="10000" value="0" id="min-price" class="price-slider">
                                <input type="range" min="0" max="10000" value="10000" id="max-price" class="price-slider">
                            </div>

                            <div class="price-inputs">
                                <label>
                                    <input type="number" id="min-price-input" value="1000" min="0" max="10000">
                                </label>
                                <label>
                                    <input type="number" id="max-price-input" value="7000" min="0" max="10000">
                                </label>
                            </div>
                        </div>

                        <div class="products__filtration-cta bottom">
                            <span>Primeni filter</span>
                        </div>
                    </div>
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
                    <div class="products__pagination">
                        <?php
                            echo paginate_links(array(
                                'total'     => $wp_query->max_num_pages,
                                'prev_text' => '<span class="font-arrow-small prev"></span>',
                                'next_text' => '<span class="font-arrow-small next"></span>',
                            ));
                        ?>
                    </div>
                </div>
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
