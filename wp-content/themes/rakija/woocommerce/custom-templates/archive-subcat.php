<?php
/**
 * Custom template za podkategorije unutar Destilerije
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$term = get_queried_object();
?>

<div class="custom-category-wrapper">
	<div class="container">
		<h1 class="category-title"><?php echo esc_html($term->name); ?></h1>

		<?php if (term_description()) : ?>
			<div class="category-description">
				<?php echo term_description(); ?>
			</div>
		<?php endif; ?>

		<div class="product-listing">
			<?php
				if ( woocommerce_product_loop() ) {
					woocommerce_product_loop_start();

					while ( have_posts() ) {
						the_post();
						wc_get_template_part( 'content', 'product' );
					}

					woocommerce_product_loop_end();
					woocommerce_pagination();

				} else {
					do_action( 'woocommerce_no_products_found' );
				}
			?>
		</div>
	  </div>
</div>

<?php
get_footer( 'shop' );
