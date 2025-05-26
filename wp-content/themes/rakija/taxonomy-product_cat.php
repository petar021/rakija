<?php
$is_ajax = isset($_GET['ajax_filter']) && $_GET['ajax_filter'] === '1';

$term = get_queried_object();
$term_id = $term->term_id;

if ($is_ajax && isset($term) && $term instanceof WP_Term) {
    $_GET['main_category'] = $term->term_id;
}

function render_products_grid($term_id) {
    $meta_query = [];

    $main_cat_id = isset($_GET['main_category']) ? intval($_GET['main_category']) : $term_id;

    $tax_query = [
        'relation' => 'AND',
        [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => [$main_cat_id],
            'include_children' => true,
        ]
    ];

    if (!empty($_GET['rakije_subcategory']) && $_GET['rakije_subcategory'] !== 'all') {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => [intval($_GET['rakije_subcategory'])],
            'include_children' => true,
        ];
    }

    if (!empty($_GET['sub_category']) && $_GET['sub_category'] !== 'all') {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => [intval($_GET['sub_category'])],
            'include_children' => true,
        ];
    }

    $price_min = isset($_GET['price_min']) ? floatval($_GET['price_min']) : 0;
    $price_max = isset($_GET['price_max']) ? floatval($_GET['price_max']) : 10000;

    $meta_query[] = [
        'key'     => '_price',
        'value'   => $price_min,
        'compare' => '>=',
        'type'    => 'NUMERIC'
    ];
    $meta_query[] = [
        'key'     => '_price',
        'value'   => $price_max,
        'compare' => '<=',
        'type'    => 'NUMERIC'
    ];

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
        'meta_query'     => $meta_query,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        echo '<div class="products-wrapper">';
        while ($query->have_posts()) : $query->the_post();
            $product = wc_get_product(get_the_ID());
            $price = $product->get_price();
            $zapremina = get_field('zapremina');
            $terms = get_the_terms(get_the_ID(), 'product_cat');
            $brand = $terms && !is_wp_error($terms) ? $terms[0]->name : '';
            ?>
            <div class="product-box">
                <div class="product-box__top">
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price"><?php echo esc_html($price); ?></span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat"><?php echo esc_html($brand); ?></span>
                    <a href="<?php the_permalink(); ?>" class="product-title-link">
                        <h3 class="product-title"><?php the_title(); ?></h3>
                    </a>
                    <span class="product-tax"><?php echo esc_html($zapremina ?: ''); ?></span>
                    <a href="?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>" class="add-to-cart-btn ajax_add_to_cart" data-product_id="<?php echo esc_attr(get_the_ID()); ?>">
                        <span class="font-cart"></span>
                    </a>
                </div>
            </div>
            <?php
        endwhile;
        echo '</div>';
    else :
        echo '<p>Nema proizvoda.</p>';
    endif;

    wp_reset_postdata();
}

if ($is_ajax) {
    status_header(200);
    echo '<div id="filtered-products">';
    render_products_grid($term_id);
    echo '</div>';
    exit;
}

get_header();
?>

<section class="products">
    <div class="products-sec" data-category-id="<?php echo esc_attr($term_id); ?>">
        <div class="container">
            <div class="filter__wrapper">
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
                            <form id="product-filter-form">
                                <div class="filter-section" data-filter="voce">
                                    <h2>Voće</h2>
                                    <label class="custom-radio custom-checkbox ">
                                        <input type="radio" name="rakije_subcategory" value="all" checked>
                                        <span class="checkmark"></span>
                                        Svi proizvodi
                                    </label>
                                    <?php
                                    $subcats = get_terms([
                                        'taxonomy' => 'product_cat',
                                        'parent'   => $term_id,
                                        'hide_empty' => true
                                    ]);
                                    foreach ($subcats as $subcat) {
                                        echo '<label class="custom-radio custom-checkbox ">
                                            <input type="radio" name="rakije_subcategory" value="' . esc_attr($subcat->term_id) . '">
                                            <span class="checkmark"></span>' . esc_html($subcat->name) . '
                                        </label>';
                                    }
                                    ?>
                                </div>

                                <div class="filter-section" data-filter="destilerije">
                                    <h2>Destilerije</h2>
                                    <label class="custom-radio custom-checkbox">
                                        <input type="radio" name="sub_category" value="all" checked>
                                        <span class="checkmark"></span>
                                        Svi dostupni
                                    </label>
                                    <?php
                                    $destilerije = get_term_by('slug', 'destilerije', 'product_cat');
                                    if ($destilerije) {
                                        $dest_subcats = get_terms([
                                            'taxonomy' => 'product_cat',
                                            'parent'   => $destilerije->term_id,
                                            'hide_empty' => true
                                        ]);
                                        foreach ($dest_subcats as $subcat) {
                                            echo '<label class="custom-radio custom-checkbox">
                                                <input type="radio" name="sub_category" value="' . esc_attr($subcat->term_id) . '">
                                                <span class="checkmark"></span>' . esc_html($subcat->name) . '
                                            </label>';
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="filter-section price-range-filter">
                                    <h2>Cena</h2>
                                    <div class="price-slider-wrapper">
                                        <div class="price-slider-track"></div>

                                        <!-- <input type="number" name="price_min" id="min-price-input" value="0">
                                        <input type="number" name="price_max" id="max-price-input" value="10000"> -->

                                        <input type="range" name="price_min" min="0" max="10000" value="0" id="min-price" class="price-slider">
                                        <input type="range" name="price_max" min="0" max="10000" value="10000" id="max-price" class="price-slider">
                                    </div>
                                    <div class="price-inputs">
                                        <label>
                                            <input type="number" name="price_min" id="min-price-input" value="0" min="0" max="10000">
                                        </label>
                                        <label>
                                            <input type="number" name="price_max" id="max-price-input" value="10000" min="0" max="10000">
                                        </label>
                                    </div>
                                </div>

                                <div class="products__filtration-cta bottom">
                                    <span>Primeni filter</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="products__wrapper-right">
                    <div class="products-sec__top">
                        <span class="products-number">440 proizvoda</span>
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
                    <div id="filtered-products">
                        <?php render_products_grid($term_id); ?>
                    </div>
                </div>
            </div>
            <div>paginacija</div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
