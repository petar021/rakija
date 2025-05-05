<?php
defined('ABSPATH') || exit;

if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
?>

<div class="product__gallery js-product-gallery">
    <!-- Glavni slider -->
    <div class="swiper product__gallery-main-slider js-product-main">
        <div class="swiper-wrapper">
            <?php if (!empty($attachment_ids)) : ?>
                <?php foreach ($attachment_ids as $attachment_id) : ?>
                    <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($attachment_id, 'single-product-img'); ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="swiper-slide">
                    <?php echo wp_get_attachment_image($post_thumbnail_id, 'single-product-img'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Thumbnail navigacija -->
    <?php if (!empty($attachment_ids)) : ?>
        <div class="swiper product__gallery-thumbs js-product-thumbs">
            <div class="swiper-wrapper">
                <?php foreach ($attachment_ids as $attachment_id) : ?>
                    <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
        <button class="modal-prev">&larr;</button>
        <button class="modal-next">&rarr;</button>
    </div>
</div>
