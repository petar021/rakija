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
						<?php if (have_rows('footer_navigation', 'option')) : ?>
							<?php while (have_rows('footer_navigation', 'option')) : the_row(); ?>
								<ul>
									<?php if (have_rows('navigation')) : ?>
										<?php while (have_rows('navigation')) : the_row(); ?>
											<?php
											$link = get_sub_field('link');
											if ($link):
												$url = $link['url'];
												$title = $link['title'];
												$target = $link['target'] ?: '_self';
											?>
												<li>
													<a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
														<?php echo esc_html($title); ?>
													</a>
												</li>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
								</ul>
							<?php endwhile; ?>
						<?php endif; ?>

						<?php
							$social_title = get_field('social_title', 'option');
							$facebook = get_field('facebook', 'option');
							$instagram = get_field('instagram', 'option');
						?>

						<div class="social-box">
							<?php if ($social_title): ?>
								<h5><?php echo esc_html($social_title); ?></h5>
							<?php endif; ?>
							<?php if ($facebook): ?>
								<a href="<?php echo esc_url($facebook['url']); ?>" target="<?php echo esc_attr($facebook['target'] ?: '_self'); ?>">
									<span class="font-facebook"></span>
								</a>
							<?php endif; ?>

							<?php if ($instagram): ?>
								<a href="<?php echo esc_url($instagram['url']); ?>" target="<?php echo esc_attr($instagram['target'] ?: '_self'); ?>">
									<span class="font-instagram"></span>
								</a>
							<?php endif; ?>
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
