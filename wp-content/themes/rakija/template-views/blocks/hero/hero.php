<div class="hero">
    <div class="container">
        <div class="banner__container">
            <div class="hero__left">
                <?php 
                    $title = get_sub_field('title');

                    if (!empty($title)) : ?>
                    <h1 class="hero__title"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                <?php 
                    $title_desc = get_sub_field('title_description');

                    if (!empty($title_desc)) : ?>
                    <span class="hero__highlight"><?php echo esc_html($title_desc); ?></span>
                <?php endif; ?>
            </div>
            <div class="hero__right">
                <?php 
                    $content_right = get_sub_field('content_right');

                    if (!empty($title_desc)) : ?>
                    <p class="hero__subtitle"><?php echo esc_html($content_right); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="hero__images">
            <div class="hero__left">
                <div class="hero-image__left">
                    <div class="hero-image__left-main">
                        <?php 
                            $image_left = get_sub_field('image_left');

                            if (!empty($image_left)) : ?>
                                <img src="<?php echo esc_url($image_left['url']); ?>" alt="<?php echo esc_attr($image_left['alt'] ?? ''); ?>">
                        <?php endif; ?>
                        <div class="hero-image__left-logo">
                            <?php 
                                $image_left_logo = get_sub_field('image_left_logo');

                                if (!empty($image_left_logo)) : ?>
                                    <img src="<?php echo esc_url($image_left_logo['url']); ?>" alt="<?php echo esc_attr($image_left_logo['alt'] ?? ''); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="hero-image__left-text">
                            <?php 
                                $image_left_text = get_sub_field('image_left_text');

                                if (!empty($image_left_text)) : ?>
                                <p><?php echo esc_html($image_left_text); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__right">
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        <?php if (have_rows('hero_products_display')) : ?>
                            <?php while (have_rows('hero_products_display')) : the_row(); ?>
                                <?php
                                    $product = get_sub_field('hero_products'); // relationship field
                                    $custom_image = get_sub_field('custom_product_image'); // image array

                                    if ($product) :
                                    // Ako je relationship više vrednosti, koristi foreach:
                                    foreach ($product as $p) :
                                        $price = get_post_meta($p->ID, '_price', true);
                                        $distillery = get_the_terms($p->ID, 'pa_destilerija'); // custom taxonomy – proveri tačan slug
                                        $size = get_the_terms($p->ID, 'pa_tezina'); // ili 'pa_zapremina' ako koristiš to za veličinu
                                        $categories = get_the_terms($p->ID, 'product_cat');
                                        $tags = get_the_terms($p->ID, 'product_tag');
                                        $product_name = get_the_title($p->ID);
                                        $product_link = get_permalink($p->ID);
                                        ?>
                                        
                                        <div class="swiper-slide hero-image__right">
                                            <div class="hero-image__right-image">
                                                <a href="<?php echo get_permalink($p->ID); ?>">
                                                    <?php if ($custom_image) : ?>
                                                        <img src="<?php echo esc_url($custom_image['url']); ?>" alt="<?php echo esc_attr($custom_image['alt']); ?>">
                                                    <?php else : ?>
                                                        <?php echo get_the_post_thumbnail($p->ID, 'medium'); ?>
                                                    <?php endif; ?>
                                                </a>
                                            </div>

                                            <div class="hero-image__right-info">
                                                <div class="hero-image__right-info-price">
                                                    <span><?php echo wc_price($price); ?></span>
                                                </div>

                                                <div class="hero-image__right-info-distillery">
                                                    <span>
                                                        <?php 
                                                        if ($categories && !is_wp_error($categories)) {
                                                            $names = wp_list_pluck($categories, 'name');
                                                            echo esc_html(implode(', ', $names));
                                                        }
                                                        ?>
                                                    </span>
                                                </div>

                                                <div class="hero-image__right-info-product-name">
                                                    <a href="<?php echo get_permalink($p->ID); ?>">
                                                        <h3>
                                                                <?php echo esc_html($product_name); ?>
                                                        </h3>
                                                    </a>
                                                </div>

                                                <div class="hero-image__right-info-product-size">
                                                    <span>
                                                        <?php 
                                                        if ($tags && !is_wp_error($tags)) {
                                                            $names = wp_list_pluck($tags, 'name');
                                                            echo esc_html(implode(', ', $names));
                                                        }
                                                        ?>
                                                    </span>
                                                </div>

                                                <a href="<?php echo esc_url('?add-to-cart=' . $p->ID); ?>"
                                                    class="add-to-cart-btn button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_id="<?php echo esc_attr($p->ID); ?>"
                                                    data-quantity="1">
                                                    <span class="font-cart-plus"></span>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>