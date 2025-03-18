<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NM_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-footer__top">
			
		</div>
		<div class="site-footer__bottom">
			<div class="site-footer__bottom-left">
				<p class="site-footer__copyright">Rakija House &copy; <?php echo date('Y'); ?> All Rights Reserved.</p>
			</div>
			<div class="site-footer__bottom-right">
				<p>SEO / Design / Development
					<a href="https://wearebaseline.com/" target="_blank">
						<img class="site-footer__logo-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/baseline-logo.svg" alt="baseline studio">
					</a>
				</p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
