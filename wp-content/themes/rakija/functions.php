
<?php
/**
 * NM Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NM_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nm_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on NM Theme, use a find and replace
		* to change 'nm_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nm_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nm_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nm_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nm_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nm_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nm_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'nm_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nm_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nm_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nm_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nm_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nm_theme_scripts() {
	wp_enqueue_style( 'nm_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'nm_theme-script', get_template_directory_uri() . '/dist/site.min.js', _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nm_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }
add_action( 'after_setup_theme', function() {
    add_theme_support( 'woocommerce' );
});

/**
 * Woocommerce disable css
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_action( 'woocommerce_single_product_summary', 'custom_display_product_details', 6 );
function custom_display_product_details() {
	// Kategorije
	$terms = get_the_terms( get_the_ID(), 'product_cat' );
	$category_links = [];

	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$url = get_term_link( $term );
			if ( ! is_wp_error( $url ) ) {
				$category_links[] = '<a href="' . esc_url( $url ) . '">' . esc_html( $term->name ) . '</a>';
			}
		}
	}

	// ACF polja
	$destilerija = get_field('destilerija');
	$sortiment = get_field('sortiment');
	$odlezao = get_field('period_odlezavanja');
	$alkohol = get_field('alkohol');
	$zapremina = get_field('zapremina');

	echo '<div class="product-meta-summary">';
		echo '<div class="product-meta-summary__top">';

			if ( ! empty( $category_links ) ) {
				echo '<div class="product-meta-summary__top"><span class="label">Kategorije:</span> ' . implode( ', ', $category_links ) . '</div>';
			}

			if ( $destilerija ) {
				echo '<p><span class="label">Destilerija:</span> ' . esc_html( $destilerija ) . '</p>';
			}
		echo '</div>';
		echo '<div class="product-meta-summary__bottom">';
			if ( $sortiment ) {
				echo '<p>Sortiment: <strong>' . esc_html( $sortiment ) . '</strong></p>';
			}

			if ( $odlezao ) {
				echo '<p>Period podležavanja: <strong>' . esc_html( $odlezao ) . '</strong></p>';
			}

			if ( $alkohol ) {
				echo '<p>Alkohol: <strong>' . esc_html( $alkohol ) . '</strong></p>';
			}

			if ( $zapremina ) {
				echo '<p>Zapremina: <strong>' . esc_html( $zapremina ) . '</strong></p>';
			}
		echo '</div>';

	echo '</div>';
}


// Hide shipping when free delivery is available
add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );

function hide_shipping_when_free_is_available( $rates, $package ) {
    // Proverite da li besplatna dostava postoji
    $free_shipping = false;

    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free_shipping = true;
            break;
        }
    }

    if ( $free_shipping ) {
        foreach ( $rates as $rate_id => $rate ) {
            if ( 'flat_rate' === $rate->method_id ) {
                unset( $rates[$rate_id] );
            }
        }
    }

    return $rates;
}

/**
 * Cart icon counter in header
 */
add_filter('woocommerce_add_to_cart_fragments', 'custom_woocommerce_header_add_to_cart_fragment');
function custom_woocommerce_header_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
    <span class="cart-count site-header__actions-link-sup js-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.js-cart-count'] = ob_get_clean();

    ob_start();
    ?>
    <div id="mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['#mini-cart'] = ob_get_clean();

    return $fragments;
}

function enqueue_qty_counter_script() {
    wp_enqueue_script(
        'qty-counter-script',
        get_template_directory_uri() . '/assets/js/_site/qty-counter.js',
        array('jquery'),
        _S_VERSION,
        true
    );

	// Dodaj atribut type="module" za skriptu
    add_filter('script_loader_tag', function ($tag, $handle, $src) {
        if ('qty-counter-script' === $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }, 10, 3);

    wp_localize_script('qty-counter-script', 'custom_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_qty_counter_script');



function custom_update_cart() {
    if (isset($_POST['form_data'])) {
        parse_str($_POST['form_data'], $form_data);

        foreach ($form_data['cart'] as $cart_key => $cart_value) {
            WC()->cart->set_quantity($cart_key, $cart_value['qty'], true);
        }
        WC()->cart->calculate_totals();

        // Prikupljanje celokupnog HTML sadržaja tabele korpe
        ob_start();
        wc_get_template('cart/cart.php');
        $cart_html = ob_get_clean();

        // Prikupljanje HTML sadržaja za ukupan iznos (totals)
        ob_start();
        woocommerce_cart_totals();
        $cart_totals_html = ob_get_clean();

        wp_send_json_success(array(
            'cart_html' => $cart_html,        // HTML za tabelu korpe
            'cart_totals' => $cart_totals_html, // HTML za ukupne cene
            'cart_count' => WC()->cart->get_cart_contents_count(), // Ukupan broj proizvoda
        ));
    } else {
        wp_send_json_error('Podaci nisu validni');
    }
}

add_action('wp_ajax_update_cart', 'custom_update_cart');
add_action('wp_ajax_nopriv_update_cart', 'custom_update_cart');

add_action( 'woocommerce_single_product_summary', 'custom_display_product_tax_note', 11 );
function custom_display_product_tax_note() {
    global $product;

    if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
        $product = wc_get_product( get_the_ID() );
    }

    $price_incl_tax = wc_get_price_including_tax( $product );
    $price_excl_tax = wc_get_price_excluding_tax( $product );
    $tax_amount = $price_incl_tax - $price_excl_tax;

    if ( $tax_amount > 0 ) {
        echo '<p class="price-note">Cena za paket, cena uključuje PDV (20%) ' . wc_price( $tax_amount ) . '</p>';
    }
}



// Omogući da get_queried_object() radi i kod AJAX filtera
add_action('init', function () {
	if (isset($_GET['ajax_filter']) && $_GET['ajax_filter'] == 1) {
		do_action('wp');
	}
});


add_filter('template_include', function($template) {
    if (isset($_GET['ajax_filter']) && $_GET['ajax_filter'] === '1') {
        status_header(200);
        nocache_headers();
    }
    return $template;
});
