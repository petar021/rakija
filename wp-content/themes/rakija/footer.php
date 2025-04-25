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
							<?php 
								$footer_logo = get_field('footer_logo', 'option');

								if (!empty($footer_logo)) : ?>
									<img class="site-footer__logo-img" 
										src="<?php echo esc_url($footer_logo['url']); ?>" 
										alt="<?php echo esc_attr(get_bloginfo('name') . ' Logo'); ?>" 
										title="<?php echo esc_attr(get_bloginfo('name')); ?>">
							<?php endif; ?>
						</a>
						<div class="contact-box">
							<?php
								$phone = get_field('phone', 'option');
							?>
							<?php if ($phone): ?>
								<a 
									href="tel:<?php echo $phone; ?>" 
									class="phone"
									>
									<span class="font-phone"></span>
									<?php echo esc_html($phone); ?> 
								</a>
							<?php endif; ?>

							<?php
								// Dohvati ACF polje tipa Link sa Options Page
								$link = get_field('address', 'option');

								// Proveri da li polje ima vrednost
								if ($link && is_array($link)): 
									// Ekstraktuj putanju iz URL-a (bez domena)
									$url_path = parse_url($link['url'], PHP_URL_PATH);
								?>
								<a href="https://www.google.com/maps/place<?php echo esc_attr($url_path); ?>" target="_blank" class="location">
									<span class="font-pin"></span> <?php echo esc_html($link['title']); ?>
								</a>
							<?php endif; ?>
							
							<?php
								// Dobavljanje email-a iz ACF options page
								$email = get_field('email', 'option');
							?>
							<?php if ($email): ?>
								<a 
									href="mailto:<?php echo $email; ?>" 
									class="location"
								>
									<span class="font-at"></span>
									<?php echo esc_html($email); ?> 
								</a>
							<?php endif; ?>
						</div>
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
						<p>Website & SEO
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
