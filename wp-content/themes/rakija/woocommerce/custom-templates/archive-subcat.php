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
		<?php
		$term = get_queried_object();

		if ( $term instanceof WP_Term ) {
			$parent_id = $term->parent;
			$parent_term = $parent_id ? get_term( $parent_id, 'product_cat' ) : null;
			?>
			<nav class="breadcrumb" aria-label="breadcrumb">
				<ul>
					<?php if ( $parent_term ) : ?>
						<li><a href="<?php echo get_term_link( $parent_term ); ?>"><?php echo esc_html( $parent_term->name ); ?></a></li>
					<?php endif; ?>
					<li><?php echo esc_html( $term->name ); ?></li>
				</ul>
			</nav>
		<?php } ?>

		<h1 class="category-title section-title"><?php echo esc_html($term->name); ?></h1>

		<?php if (term_description()) : ?>
			<div class="category-description">
				<?php echo term_description(); ?>
			</div>
		<?php endif; ?>

		<?php
		// Forma za sortiranje pre liste proizvoda
		?>
		<form class="woocommerce-ordering" method="get">
			<label for="orderby">6 proizvoda</label>
			<select class="js-example-basic-single" name="orderby">
				<option value="popularity" <?php selected( $_GET['orderby'] ?? '', 'popularity' ); ?>>Najpopularnije</option>
				<option value="date" <?php selected( $_GET['orderby'] ?? '', 'date' ); ?>>Najnovije</option>
				<option value="price" <?php selected( $_GET['orderby'] ?? '', 'price' ); ?>>Cena: rastuće</option>
				<option value="price-desc" <?php selected( $_GET['orderby'] ?? '', 'price-desc' ); ?>>Cena: opadajuće</option>
			</select>

			<?php
			// Zadrži sve postojeće GET parametre osim 'orderby'
			foreach ( $_GET as $key => $val ) {
				if ( 'orderby' === $key ) {
					continue;
				}
				if ( is_array( $val ) ) {
					foreach ( $val as $inner_val ) {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $inner_val ) . '">';
					}
				} else {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '">';
				}
			}
			?>
		</form>

		<script>
			jQuery(document).ready(function () {
				jQuery('.js-example-basic-single').select2();
			});
		</script>

		<div class="products-wrapper">
			<?php
			if ( woocommerce_product_loop() ) {

				woocommerce_product_loop_start(); // <ul class="products"> - možeš da ignorišeš ako ne koristiš listu

				while ( have_posts() ) {
					the_post();
					global $product;
				
					// Podaci iz WC
					$product_id = $product->get_id();
					$product_title = get_the_title();
					$product_link = get_permalink();
					$product_img = get_the_post_thumbnail_url( $product_id, 'medium' );
					$product_price = $product->get_price();
					$product_volume = $product->get_attribute('pa_zapremina');
					$add_to_cart_url = '?add-to-cart=' . $product_id;

					// Izvlačenje kategorija bez <a> tagova
					$terms = get_the_terms( $product_id, 'product_cat' );
					$product_cat = '';
					if ( $terms && ! is_wp_error( $terms ) ) {
						foreach ( $terms as $index => $term ) {
							if ( $index > 0 ) {
								$product_cat .= ', ';
							}
							$product_cat .= esc_html( $term->name );
						}
					}
					?>

					<div class="product-box">
						<div class="product-box__top">
							<a href="<?php echo esc_url( $product_link ); ?>">
								<img src="<?php echo esc_url( $product_img ); ?>" alt="<?php echo esc_attr( $product_title ); ?>">
							</a>
						</div>
						<div class="product-box__bottom">
							<div class="price-box">
								<span class="price"><?php echo wc_price( $product_price ); ?></span>
							</div>
							<?php if ( $product_cat ) : ?>
								<span class="product-cat"><?php echo $product_cat; ?></span>
							<?php endif; ?>

							<?php
							// Prikaz svih atributa osim kategorije
							$attributes = $product->get_attributes();
							if ( ! empty( $attributes ) ) :
								foreach ( $attributes as $attribute ) {
									if ( $attribute->get_visible() && ! $attribute->is_taxonomy() ) {
										$name = wc_attribute_label( $attribute->get_name() );
										$value = implode( ', ', $attribute->get_options() );
										echo '<span class="product-attr">' . esc_html( $name ) . ': ' . esc_html( $value ) . '</span>';
									} elseif ( $attribute->get_visible() && $attribute->is_taxonomy() ) {
										$terms = wc_get_product_terms( $product_id, $attribute->get_name(), array( 'fields' => 'names' ) );
										$name = wc_attribute_label( $attribute->get_name() );
										$value = implode( ', ', $terms );
										echo '<span class="product-attr">' . esc_html( $name ) . ': ' . esc_html( $value ) . '</span>';
									}
								}
							endif;
							?>

							<a href="<?php echo esc_url( $product_link ); ?>" class="product-title-link">
								<h3 class="product-title"><?php echo esc_html( $product_title ); ?></h3>
							</a>

							<?php if ( $product_volume ) : ?>
								<span class="product-tax"><?php echo esc_html( $product_volume ); ?></span>
							<?php endif; ?>

							<a href="<?php echo esc_url( $add_to_cart_url ); ?>" class="add-to-cart-btn">
								<span class="font-cart"></span>
							</a>
						</div>
					</div>

				
				<?php	} ?>
			<?php
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
