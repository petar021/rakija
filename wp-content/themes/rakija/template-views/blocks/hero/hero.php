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
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>