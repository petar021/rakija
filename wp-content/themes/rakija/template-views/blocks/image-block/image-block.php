<section class="image-block">
    <div class="container">
        <?php
            $image = get_sub_field('image'); // desktop
            $image_mobile = get_sub_field('image_mobile'); // mobile
        ?>
        <div class="image-block__wrapper">
            <div class="image-block__img-box">
                <img src="<?php echo esc_url($image['url']); ?>" class="desktop" alt="">
                <img src="<?php echo esc_url($image_mobile['url']); ?>" class="mobile" alt="">
            </div>
            <div class="image-block__content">
                <div class="image-block__content-left">
                    <?php 
                        $logo = get_sub_field('logo');

                        if (!empty($logo)) : ?>
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?? ''); ?>">
                    <?php endif; ?>
                </div>
                <div class="image-block__content-right">
                    <?php
                        $link = get_sub_field('link');
                    ?>

                    <?php if ($link): ?>
                        <a 
                            href="<?php echo esc_url($link['url']); ?>" 
                            class="btn-icon btn-icon__reverse" 
                            target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                            >
                            <span class="font-arrow-right"></span>
                            <?php echo esc_html($link['title']); ?> 
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>