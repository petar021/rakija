<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package NM_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="error-left">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/casa.png" alt="">
			</div>
			<div class="error-right">
				<?php 
					$error_title = get_field('error_title', 'option');

					if (!empty($error_title)) : ?>
					<h1><?php echo esc_html($error_title); ?></h1>
				<?php endif; ?>
				<?php 
					$error_content = get_field('error_content', 'option'); 

					if (!empty($error_content)) : ?>
						<?php echo wp_kses_post($error_content); ?>
				<?php endif; ?>
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
