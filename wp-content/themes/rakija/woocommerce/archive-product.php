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
            <div class="products__wrapper">
                <div class="products__wrapper-left">
                    <div class="products__filtration">
                        <div class="products__filtration-cta">
                            <span class="font-filter"></span>
                            <span>Filter</span>
                        </div>
                        <div class="custom-filter">
                            <div class="custom-filter__close"> 
                                <span></span>
                                <span></span>
                            </div>
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
                </div>
                <div class="products__wrapper-right">
                    <div class="products-sec__top">
                        <span>440 proizvoda</span>
                        <form class="woocommerce-ordering" method="get">
                            <select class="js-example-basic-single" name="state">
                                <option value="A">Najpopularnije</option>
                                <option value="B">Najnovije</option>
                                <option value="C">Cena: rastuće</option>
                                <option value="D">Cena: opadajuće</option>
                            </select>
                            <script>
                                // In your Javascript (external .js resource or <script> tag)
                                jQuery(document).ready(function() {
                                    jQuery('.js-example-basic-single').select2();
                                });
                            </script>
                            <!-- Zadrži postojeće GET parametre (osim 'orderby') -->
                            <input type="hidden" name="paged" value="1" />
                        </form>
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
                                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                            $product_image_id = get_post_thumbnail_id(); // Dohvati ID istaknute slike proizvoda
                                            echo wp_get_attachment_image($product_image_id, 'product-item-img'); // Prikazuje sliku u definisanoj veličini
                                        ?>
                                    </a>
                                </div>
                                <div class="product-item__wrap">
                                    <div class="product-item__info">
                                        <!-- Cena proizvoda -->
                                        <span class="product-item__price"><?php echo $product_price; ?></span>

                                        <!-- Kategorija proizvoda -->
                                        <?php
                                        $categories = get_the_terms( get_the_ID(), 'product_cat' );
                                        $chosen_category = '';

                                        if ( $categories && ! is_wp_error( $categories ) ) {
                                            foreach ( $categories as $category ) {
                                                if ( $category->slug === 'destilerije' || term_is_ancestor_of( get_term_by( 'slug', 'destilerije', 'product_cat' ), $category, 'product_cat' ) ) {
                                                    $chosen_category = $category->name;
                                                    break;
                                                }
                                            }

                                            if ( ! $chosen_category ) {
                                                // Ako nije destilerija ni child, uzmi prvu dostupnu
                                                $chosen_category = $categories[0]->name;
                                            }
                                        }

                                        if ( $chosen_category ) : ?>
                                            <div class="product-item__category">
                                                <span>
                                                    <?php echo esc_html( $chosen_category ); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Ime proizvoda -->
                                        <a href="<?php the_permalink(); ?>">
                                            <h3 class="product-item__name"><?php echo esc_html( $product_name ); ?></h3>
                                        </a>

                                        <!-- Atributi proizvoda -->
                                        <?php
                                        $product = wc_get_product( get_the_ID() );
                                        $attributes = $product->get_attributes();

                                        $product_tags = get_the_terms( get_the_ID(), 'product_tag' );

                                        if ( $product_tags && ! is_wp_error( $product_tags ) ) : ?>
                                            <ul class="product-item__tags">
                                                <?php foreach ( $product_tags as $tag ) : ?>
                                                    <li><?php echo esc_html( $tag->name ); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>

                                    </div>

                                    <div class="product-item__btn">
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                        <span class="font-cart"></span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
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

    <?php
    do_action('woocommerce_after_shop_loop');
else :
    do_action('woocommerce_no_products_found');
endif;
?>

<!-- ✅ Sada prikazujemo ostale ACF blokove tek nakon proizvoda -->
<?php
$shop_page_id = wc_get_page_id('shop');

if ($shop_page_id && have_rows('content', $shop_page_id)) :
    while (have_rows('content', $shop_page_id)) : the_row();

        if (get_row_layout() == 'text_two_rows') :
            get_template_part('template-views/blocks/text-two-rows/text-two-rows');
        elseif (get_row_layout() == 'three_rows') :
            get_template_part('template-views/blocks/three-rows/three-rows');
        elseif (get_row_layout() == 'half_sec') :
            get_template_part('template-views/blocks/half-sec/half-sec');
        elseif (get_row_layout() == 'review') :
            get_template_part('template-views/blocks/review/review');
        elseif (get_row_layout() == 'text_two_rows_sec') :
            get_template_part('template-views/blocks/text-two-rows/text-two-rows-sec');
        elseif (get_row_layout() == 'accordion') :
            get_template_part('template-views/blocks/accordion/accordion');
        elseif (get_row_layout() == 'info_sec') :
            get_template_part('template-views/blocks/info-sec/info-sec');
        elseif (get_row_layout() == 'text_two_rows_img') :
            get_template_part('template-views/blocks/text-two-rows-img/text-two-rows-img');
        elseif (get_row_layout() == 'basic_block') :
            get_template_part('template-views/blocks/basic-block/basic-block');
        elseif (get_row_layout() == 'cta') :
            get_template_part('template-views/blocks/cta/cta');
        endif;

    endwhile;
endif;
?>


<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
