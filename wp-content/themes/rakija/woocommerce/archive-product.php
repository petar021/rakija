<?php
defined('ABSPATH') || exit;

get_header('shop'); ?>

<?php // get content blocks
	get_template_part( 'template-views/blocks/banner-title/banner-title-category' );
?>

<div class="woocommerce-products-page">
    <div class="products-sidebar">

		<div class="products__filtration">
			<div class="products__filtration-cta">
				<span class="font-filter"></span>
				<span>Filter</span>
			</div>
			<div class="custom-filter__close"> 
				<span></span>
				<span></span>
			</div>
			<div class="custom-filter">
				<div>
					<?php
						$queried_object = get_queried_object();

						if (is_tax('product_cat')) {
							$term_slug = $queried_object->slug;

							if ($term_slug === 'rakija') {
								// Filteri za rakiju
								echo do_shortcode('[searchandfilter field="Rakije & Destilerije"]');
								// echo do_shortcode('[searchandfilter field="Destilerije Duplicate"]');
								// echo do_shortcode('[searchandfilter field="Destilerije Duplicate (copy)"]');
								
								// echo do_shortcode('[searchandfilter field="Price Range - Slider"]');
							} elseif ($term_slug === 'gin-dzin') {
								// Filteri za gin
								echo do_shortcode('[searchandfilter field="Gin & Destilerije"]'); // primer shortcoda, zameni stvarnim
								// echo do_shortcode('[searchandfilter field="Destilerije Duplicate (copy)"]');
								// echo do_shortcode('[searchandfilter field="Price Range - Slider"]');
							} elseif ($term_slug === 'likeri') {
								// Filteri za likere
								// echo do_shortcode('[searchandfilter field="Likeri"]'); // primer shortcoda, zameni stvarnim
								// echo do_shortcode('[searchandfilter field="Destilerije Duplicate (copy)"]');
								echo do_shortcode('[searchandfilter field="Likeri & Destilerije"]');
							} elseif ($term_slug === 'poklon-pakovanja') {
								// Filteri za likere
								echo do_shortcode('[searchandfilter field="Poklon Pakovanja"]'); // primer shortcoda, zameni stvarnim
								echo do_shortcode('[searchandfilter field="Destilerije Duplicate (copy)"]');
								echo do_shortcode('[searchandfilter field="Price Range - Slider"]');
							}
							else {
								// Default filteri za sve ostale kategorije
								echo do_shortcode('[searchandfilter field="Destilerije"]');
								echo do_shortcode('[searchandfilter field="Price Range - Input"]');
							}
						}
					?>
				</div>

			<div class="products__filtration-cta bottom">
				<span>Primeni filter</span>
			</div>
		</div>

		</div>
    </div>

    <div class="products-main">
        <?php if (woocommerce_product_loop()) : ?>

            <?php do_action('woocommerce_before_shop_loop'); ?>

            <div class="products-grid">
                <?php woocommerce_product_loop_start(); ?>

                <?php while (have_posts()) : the_post(); ?>
                    <?php wc_get_template_part('content', 'product'); ?>
                <?php endwhile; ?>

                <?php woocommerce_product_loop_end(); ?>
            </div>

        <?php else : ?>
            <?php do_action('woocommerce_no_products_found'); ?>
        <?php endif; ?>
    </div>
	<div class="pagination three-column-posts__pagination">
		<?php do_action('woocommerce_after_shop_loop'); ?>
	</div>
</div>

<?php // get content blocks
	get_template_part( 'template-views/blocks/basic-block/basic-block-category' );
?>

<?php get_footer('shop'); ?>
