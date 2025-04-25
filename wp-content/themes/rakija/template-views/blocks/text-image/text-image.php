<section class="text-image">
    <div class="container">
        <div class="text-image__wrapper">
            <?php if (have_rows('text_image_box')): ?>
                <?php while (have_rows('text_image_box')): the_row(); 
                    $image = get_sub_field('image');
                    $content = get_sub_field('content');
                ?>
                    <div class="text-image__box">
                        <div class="text-image__image">
                            <?php if ($image): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="text-image__content">
                            <p><?php echo esc_html($content); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
