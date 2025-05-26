<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package NM_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nm_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'nm_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nm_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'nm_theme_pingback_header' );

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Woocommerce remove unnecessary fields from the checkout form
 */
function custom_override_checkout_fields( $fields ) {
    // Uklanjanje nepotrebnih polja
    // unset( $fields['billing']['billing_last_name'] );
    unset( $fields['billing']['billing_state'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_company'] );
    unset( $fields['shipping']['shipping_state'] );
    // Promena oznake za polje imena
    $fields['billing']['billing_first_name']['label'] = 'Ime';
    // Dodavanje placeholder vrednosti
    $fields['billing']['billing_first_name']['placeholder'] = 'Unesite ime';
    $fields['billing']['billing_last_name']['placeholder'] = 'Unesite Prezime';
    $fields['billing']['billing_address_1']['placeholder'] = '';
    $fields['billing']['billing_city']['placeholder'] = 'Unesite grad';
    $fields['billing']['billing_postcode']['placeholder'] = 'Poštanski broj';
    $fields['billing']['billing_phone']['placeholder'] = 'Unesite broj telefona';
    $fields['billing']['billing_email']['placeholder'] = 'Unesite e-poštu';
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'custom_override_checkout_fields' );
add_filter( 'woocommerce_checkout_fields', 'custom_make_phone_required' );
function custom_make_phone_required( $fields ) {
    // Postavljamo polje telefona kao obavezno
    $fields['billing']['billing_phone']['required'] = true;
    // Uklanjamo "(opciono)" iz labela
    $fields['billing']['billing_phone']['label'] = __('Telefon', 'woocommerce');
    return $fields;
}
add_action( 'woocommerce_checkout_process', 'custom_validate_phone_field' );
function custom_validate_phone_field() {
    if ( empty( $_POST['billing_phone'] ) ) {
        wc_add_notice( __( 'Molimo unesite broj telefona.', 'woocommerce' ), 'error' );
    }
}

add_action('wp_footer', 'add_custom_mini_cart');
function add_custom_mini_cart() {
    ?>
    <div id="mini-cart" style="display:none;">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
}

add_filter( 'gettext', 'remove_nbsp_from_label', 20, 3 );
function remove_nbsp_from_label( $translated_text, $text, $domain ) {
    if ( strpos( $translated_text, 'Last name&nbsp;' ) !== false ) {
        $translated_text = str_replace( '&nbsp;', ' ', $translated_text );
    }
    return $translated_text;
}

// Maximum product number in Woo Archive page
add_filter('loop_shop_per_page', function($cols) {
    return 18;
}, 20);
