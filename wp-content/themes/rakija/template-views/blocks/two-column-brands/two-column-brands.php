<section class="two-column-brands">
    <div class="container">
        <div class="two-column-brands__wrapper">
            <div class="two-column-brands__content">
                <?php 
                    $title = get_sub_field('title');

                    if (!empty($title)) : ?>
                    <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php 
                    $content = get_sub_field('content');

                    if (!empty($content)) : ?>
                    <p><?php echo esc_html($content); ?></p>
                <?php endif; ?>
                <?php
                    $link = get_sub_field('link');
                ?>

                    <?php if ($link): ?>
                        <a 
                            href="<?php echo esc_url($link['url']); ?>" 
                            class="btn-icon" 
                            target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                            >
                            <span class="font-eye"></span>
                            <?php echo esc_html($link['title']); ?> 
                        </a>
                    <?php endif; ?>
            </div>
            <dvi class="two-column-brands__logos">
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-09.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-10.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-11.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-12.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-13.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-14.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-15.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-16.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-17.png" alt="">
                </a>
                <a href="javascript:;">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-18.png" alt="">
                </a>
            </dvi>
        </div>
    </div>
</section>