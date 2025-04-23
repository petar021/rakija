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
				<h1>Ups! Izgleda da ste zalutali...</h1>
				<p>Stranica koju tražite nije pronađena. Možda je premestili, obrisali ili se dogodila greška u adresi.</p>
				<p>Ne brinite, vratite se na <a href="<?php echo esc_url( home_url( '/' ) ); ?>">početnu stranicu</a> ili istražite našu <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ponudu</a> - sigurni smo da ćete pronaći nešto za uživanje!</p>
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
