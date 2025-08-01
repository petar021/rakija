<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description product__short-description entry-content">
	<?php echo $short_description; // WPCS: XSS ok. ?>

	<!-- <div class="product-info-box">
		<div class="broduct-info-box__container">
			<div class="product-info-box__item-green">
				<p>Sadrži:</p>
				<ul>
					<li>Beta Glukan</li>
					<li>Celo zrno</li>
					<li>Nizak glikemijski index</li>
					<li>Antioxidant</li>
					<li>Rastvorljiva vlakna</li>
					<li>Visok sadržaj proteina</li>
					<li>Zdrave ugljene hidrate</li>
				</ul>
			</div>
			<div class="product-info-box__item-red">
				<p>Ne Sadrži:</p>
				<ul>
					<li>Gluten</li>
					<li>Brašno i ulje</li>
					<li>Šećer</li>
					<li>Kvasac i sredstva za podizanje</li>
					<li>Konzervanse i emulgatore</li>
					<li>Veštačke boje i arome</li>
				</ul>
			</div>
		</div>
	</div> -->
</div>
