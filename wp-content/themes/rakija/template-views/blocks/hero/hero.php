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
                    <!-- <div class="swiper-wrapper">
                        <div class="swiper-slide hero-image__right">
                            <div class="hero-image__right-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-05.png" alt="">
                            </div>
                            <div class="hero-image__right-info">
                                <div class="hero-image__right-info-price">
                                    <span>3.350 RSD</span>
                                </div>
                                <div class="hero-image__right-info-distillery">
                                    <span>Zlatni Tok</span>
                                </div>
                                <div class="hero-image__right-info-product-name">
                                    <h3>Alba šljiva prepečenica</h3>
                                </div>
                                <div class="hero-image__right-info-product-size">
                                    <span>700ml</span>
                                </div>
                                <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                            </div>
                        </div>
                        <div class="swiper-slide hero-image__right">
                            <div class="hero-image__right-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-03-slide.png" alt="">
                            </div>
                            <div class="hero-image__right-info">
                                <div class="hero-image__right-info-price">
                                    <span>1.700 RSD</span>
                                </div>
                                <div class="hero-image__right-info-distillery">
                                    <span>Zlatna Kap</span>
                                </div>
                                <div class="hero-image__right-info-product-name">
                                    <h3>Rakija od domaće šljive Barrique</h3>
                                </div>
                                <div class="hero-image__right-info-product-size">
                                    <span>1000ml</span>
                                </div>
                                <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                            </div>
                        </div>
                        <div class="swiper-slide hero-image__right">
                            <div class="hero-image__right-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-02-slide.png" alt="">
                            </div>
                            <div class="hero-image__right-info">
                                <div class="hero-image__right-info-price">
                                    <span>3.350 RSD</span>
                                </div>
                                <div class="hero-image__right-info-distillery">
                                    <span>Zlatni Tok</span>
                                </div>
                                <div class="hero-image__right-info-product-name">
                                    <h3>Alba šljiva prepečenica</h3>
                                </div>
                                <div class="hero-image__right-info-product-size">
                                    <span>700ml</span>
                                </div>
                                <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                            </div>
                        </div>
                    </div> -->

                    <?php
                        if( have_rows('hero_products_display') ):
                            echo '<div class="swiper-wrapper">';
                            while( have_rows('hero_products_display') ): the_row();
                                $products = get_sub_field('hero_products');
                                $custom_image = get_sub_field('custom_product_image'); // polje tip image - array
                        
                                if( $products ):
                                    foreach( $products as $product ):
                                        $product_id = $product->ID;
                                        $wc_product = wc_get_product($product_id);
                                        if ( ! $wc_product ) continue;
                        
                                        $price = $wc_product->get_price();
                                        $categories = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'names']);
                                        $categories_list = implode(', ', $categories);
                                        $size = $wc_product->get_attribute('pa_zapremina');
                                        $product_url = get_permalink($product_id);
                        
                                        // Ako je custom image postavljen, uzmi njegovu URL, inače fallback na featured image
                                        if( $custom_image && isset($custom_image['url']) ) {
                                            $image_url = $custom_image['url'];
                                            $image_alt = $custom_image['alt'] ? $custom_image['alt'] : $product->post_title;
                                        } else {
                                            $image_url = get_the_post_thumbnail_url($product_id, 'full');
                                            $image_alt = $product->post_title;
                                        }
                                        ?>
                                        <div class="swiper-slide hero-image__right">
                                            <div class="hero-image__right-image">
                                                <a href="<?php echo esc_url($product_url); ?>">
                                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                </a>
                                            </div>
                                            <div class="hero-image__right-info">
                                                <div class="hero-image__right-info-price">
                                                    <span><?php echo wc_price($price); ?></span>
                                                </div>
                                                <div class="hero-image__right-info-distillery">
                                                    <span><?php echo esc_html($categories_list); ?></span>
                                                </div>
                                                <div class="hero-image__right-info-product-name">
                                                    <h3><a href="<?php echo esc_url($product_url); ?>"><?php echo esc_html($product->post_title); ?></a></h3>
                                                </div>
                                                <div class="hero-image__right-info-product-size">
                                                    <span><?php echo esc_html($size); ?></span>
                                                </div>
                                                <a href="<?php echo esc_url('?add-to-cart=' . $product_id); ?>" class="add-to-cart-btn"><span class="font-cart"></span></a>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            endwhile;
                            echo '</div>';
                        endif;
                    ?>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>