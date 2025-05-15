<?php
/**
 * Template Name: Landing Page
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
			get_template_part( 'template-views/blocks/hero/fe-hero' );
			get_template_part( 'template-views/blocks/three-column-cat/fe-three-column-cat' );
			get_template_part( 'template-views/blocks/products/fe-products' );
			get_template_part( 'template-views/blocks/image-block/fe-image-block' );
			get_template_part( 'template-views/blocks/two-column-brands/fe-two-column-brands' );
			get_template_part( 'template-views/blocks/reviews/reviews' );
			get_template_part( 'template-views/blocks/three-column-posts/fe-three-column-posts' );
		?>
	</main>
</div>

<?php
get_footer();
