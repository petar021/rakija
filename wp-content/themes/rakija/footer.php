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
			<div class="container">
				<div class="site-footer__top-box">
					<div class="site-footer__top-left">
						<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img class="site-footer__logo-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer-logo.svg" alt="baseline studio">
						</a>
						<div class="contact-box">
							<a href="tel:+381659505568" class="phone"><span class="font-phone"></span> +381 65 950 55 68</a>
							<a href="https://www.google.com/maps/place/Rakija+House+-+prodavnica+doma%C4%87ih+rakija+iz+Srbije/@45.2570514,19.8393177,17z/data=!3m1!4b1!4m6!3m5!1s0x475b116dddbbcedd:0xddb2fc1eb87543ee!8m2!3d45.2570477!4d19.8418926!16s%2Fg%2F11v4h_18hk?entry=ttu&g_ep=EgoyMDI1MDMxMi4wIKXMDSoJLDEwMjExNDUzSAFQAw%3D%3D" target="_blank" class="location"><span class="font-pin"></span> Njegoševa 15, 21000 Novi Sad</a>
							<a href="mailto:rakijahouse2023@gmail.com" class="phone"><span class="font-at"></span> rakijahouse2023@gmail.com</a>
						</div>
					</div>
					<div class="site-footer__top-center">
						<a href="https://www.google.com/maps/place/Rakija+House+-+prodavnica+doma%C4%87ih+rakija+iz+Srbije/@45.2570514,19.8393177,17z/data=!3m1!4b1!4m6!3m5!1s0x475b116dddbbcedd:0xddb2fc1eb87543ee!8m2!3d45.2570477!4d19.8418926!16s%2Fg%2F11v4h_18hk?entry=ttu&g_ep=EgoyMDI1MDMxMi4wIKXMDSoJLDEwMjExNDUzSAFQAw%3D%3D" target="_blank">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/map.png" alt="location">
						</a>
					</div>
					<div class="site-footer__top-right">
						<ul>
							<li>
								<a href="javascript:;">Rakija</a>
							</li>
							<li>
								<a href="javascript:;">Liker</a>
							</li>
							<li>
								<a href="javascript:;">Džin</a>
							</li>
							<li>
								<a href="javascript:;">Destilerije</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="javascript:;">O nama</a>
							</li>
							<li>
								<a href="javascript:;">Blog</a>
							</li>
							<li>
								<a href="javascript:;">Kontakt</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="javascript:;">Informacije o isporuci</a>
							</li>
							<li>
								<a href="javascript:;">Politika privatnosti</a>
							</li>
							<li>
								<a href="javascript:;">Opšti uslovi korišćenja</a>
							</li>
						</ul>
						<div class="social-box">
							<h5>Pratite nas</h5>
							<a href="https://www.facebook.com/rakijahouse1" target="_blank">
								<span class="font-facebook"></span>
							</a>
							<a href="https://www.instagram.com/rakija_house/" target="_blank">
								<span class="font-instagram"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-footer__bottom">
			<div class="container">
				<div class="site-footer__bottom-box">
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
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
