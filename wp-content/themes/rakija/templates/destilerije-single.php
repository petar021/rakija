<?php
/**
 * Template Name: Destilerije Single
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NM_Theme
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php // get content blocks
			$basic_block = get_field('basic_block');
			if ($basic_block) {
				get_template_part( 'template-views/blocks/basic-block/basic-block-destilerije' );
			}

			$banner_title_destilerije_single = get_field('banner-title-destilerije-single');
			if ($banner_title_destilerije_single) {
				get_template_part( 'template-views/blocks/banner-title/banner-title-destilerije-single' );
			}

			$products_destilerije_single = get_field('products-destilerije-single');
			if ($products_destilerije_single) {
				get_template_part( 'template-views/blocks/products/products-destilerije-single' );
			}
		?>
	</main>
</div>

<?php
get_footer();