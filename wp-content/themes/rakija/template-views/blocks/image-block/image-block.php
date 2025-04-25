<section class="image-block">
    <div class="container">
        <?php 
            $image = get_sub_field('image');
        ?>
        <div class="image-block__wrapper" style="background-image: url('<?php echo esc_url($image['url']); ?>');">
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