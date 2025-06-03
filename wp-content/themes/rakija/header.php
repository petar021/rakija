<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NM_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png"/>

	<!-- Preload fonts -->
	<!-- <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Regular.woff2" as="font" crossorigin /> -->

	<?php wp_head(); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nm_theme' ); ?></a>
	<?php
		$classHeader = $classHeader ?? ''; // Ako promenljiva nije definisana, dodeljuje prazan string
	?>

	<div class="accept-block">
		<div class="accept-block__center-second">
			<?php 
				$footer_logo = get_field('footer_logo', 'option');

				if (!empty($footer_logo)) : ?>
					<img class="accept-block__logo-img" 
						src="<?php echo esc_url($footer_logo['url']); ?>" 
						alt="<?php echo esc_attr(get_bloginfo('name') . ' Logo'); ?>" 
						title="<?php echo esc_attr(get_bloginfo('name')); ?>">
			<?php endif; ?>
			<h2>Nemate dovoljno godina<br>da biste videli ovaj sajt</h2>
			<div class="accept-block__cta">
				<a href="javascript:;">Nazad</a>
			</div>
		</div>
		<div class="accept-block__center">
			<?php 
				$footer_logo = get_field('footer_logo', 'option');

				if (!empty($footer_logo)) : ?>
					<img class="accept-block__logo-img" 
						src="<?php echo esc_url($footer_logo['url']); ?>" 
						alt="<?php echo esc_attr(get_bloginfo('name') . ' Logo'); ?>" 
						title="<?php echo esc_attr(get_bloginfo('name')); ?>">
			<?php endif; ?>
			<h2>Da li imate više od 18 godina?</h2>
			<div class="accept-block__cta">
				<a href="javascript:;">Nemam</a>
				<a href="javascript:;">Imam više od 18 godina</a>
			</div>
		</div>
		<div class="accept-block__bottom-box">
			<div class="container">
				<div class="accept-block__bottom-left">
					<p class="accept-block__copyright">Rakija House &copy; <?php echo date('Y'); ?> All Rights Reserved.</p>
				</div>
				<div class="accept-block__bottom-right">
					<p>Website & SEO
						<a href="https://wearebaseline.com/" target="_blank">
							<img class="accept-block__logo-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/baseline-logo.svg" alt="baseline studio">
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<header id="masthead" class="site-header <?php echo $classHeader; ?>">
		<div class="container">
			<div class="site-header__container">
				<div class="site-header__branding">
					<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php 
							$header_logo = get_field('header_logo', 'option');
							if (!empty($header_logo)) : ?>
								<img 
									id="logo"
									class="site-header__logo-img"
									src="<?php echo esc_url($header_logo['url']); ?>" 
									alt="<?php echo esc_attr(get_bloginfo('name') . ' Logo'); ?>" 
									title="<?php echo esc_attr(get_bloginfo('name')); ?>"
								>
						<?php endif; ?>
					</a>
				</div>
				<div class="site-header__nav">
					<nav id="site-navigation" class="main-navigation">
						<div class="main-navigation__menu-wrap js-navigation">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'main-navigation__menu',
								)
							);
							?>
						</div>
						<button type="button" class="main-navigation__toggle js-menu-btn">
							<span class="main-navigation__toggle-stripe"></span>
							<span class="main-navigation__toggle-stripe"></span>
						</button>
					</nav><!-- #site-navigation -->
				</div>
				<div class="site-header__cart">
					<div class="site-header__cart-left">
						<button id="search-toggle" class="font-search" aria-label="Search"></button>
						<form id="search-form" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
							<input type="text" name="s" id="search-input" placeholder="Pretraži..." />
						</form>
					</div>
					<div class="site-header__cart-right">
						<a href="<?php echo wc_get_cart_url(); ?>" class="btn-icon"><span class="font-cart-plus"></span> Korpa</a>
						<span class="cart-count site-header__actions-link-sup js-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">
