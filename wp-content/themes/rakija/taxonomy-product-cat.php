<?php
/**
 * Custom handler for product categories to differentiate between parent and child category templates
 */

defined( 'ABSPATH' ) || exit;

$term = get_queried_object();

if ( isset( $term->term_id ) && $term->taxonomy === 'product_cat' ) {
    if ( $term->parent == 0 ) {
        // Glavna kategorija – koristi standardni WooCommerce template
        wc_get_template( 'archive-product.php' );
    } else {
        // Podkategorija – koristi drugi template
        get_template_part( 'woocommerce/custom-templates/archive', 'product-subcategory' );
    }
}
