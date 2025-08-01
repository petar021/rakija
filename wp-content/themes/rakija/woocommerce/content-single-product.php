<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product; 
	

	if ( post_password_required() ) {
		echo get_the_password_form(); // WPCS: XSS ok.
		return;
	}
	?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
		<div class="container">
			<?php /**
			 * Hook: woocommerce_before_single_product.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 */
			do_action( 'woocommerce_before_single_product' );
			?>
		</div>

		<div class="product-breadcrumb">
			<div class="container">
				<?php
				/**
				 * WooCommerce breadcrumb
				 */
				woocommerce_breadcrumb();
				?>
			</div>
		</div>

		<div class="product__main">
			<div class="container">
				<div class="product__main-wrap">
					<div class="product__main-gallery">
						<?php
						/**
						 * Hook: woocommerce_before_single_product_summary.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div>

					<div class="product__main-summary">
						<div class="product__main-summary-wrap">
							<?php
							remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
							/**
							 * Hook: woocommerce_single_product_summary.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
								do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
			$basic_block = get_field('basic_block');
			if ($basic_block) {
				get_template_part( 'template-views/blocks/basic-block/basic-block' );
			}
		?>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		//do_action( 'woocommerce_after_single_product_summary' );
		?>

		<?php woocommerce_output_related_products(); ?>

		<?php if (get_field("content")) : ?>
			<section class="basic-block">
				<div class="container-small">
					<div class="entry-content">
						<?php the_field("content"); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
	</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>

