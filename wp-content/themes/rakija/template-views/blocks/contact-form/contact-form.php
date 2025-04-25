<section class="banner-title gray">
    <div class="container">
        <div class="banner-title__wrapper">
            <div class="banner-title__left">
                <?php 
                    $title = get_sub_field('title');

                    if (!empty($title)) : ?>
                    <h1 class="page-title"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
            </div>
            <div class="banner-title__right">
                <?php 
                    $content = get_sub_field('content');

                    if (!empty($content)) : ?>
                    <p><?php echo esc_html($content); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="contact-form-block">
    <div class="container">
        <div class="contact-form-wrapper">
            <div class="contact-form-left">
                <div class="contact-form-left-top">
                    <?php if (have_rows('contact_box')): ?>
                        <?php while (have_rows('contact_box')): the_row(); 
                            $phone = get_sub_field('phone');
                            $address = get_sub_field('address');
                            $address_link = get_sub_field('address_link');
                        ?>
                            <div class="contact-box">
                                <?php if ($phone): ?>
                                    <a href="tel:<?php echo preg_replace('/\s+/', '', $phone); ?>" class="phone">
                                        <span class="font-phone"></span> <?php echo esc_html($phone); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ($address && $address_link): ?>
                                    <a href="<?php echo esc_url($address_link); ?>" target="_blank" class="location">
                                        <span class="font-pin"></span> <?php echo esc_html($address); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="contact-form-left-bottom">
                    <?php echo do_shortcode('[contact-form-7 id="6dae232" title="Contact form 1"]') ?>
                </div>
            </div>
            <div class="contact-form-right">
                <?php $map = get_sub_field('map'); ?>
                <?php $map_image = get_sub_field('map_image'); ?>
                <?php if ($map && $map_image ): ?>
                    <a href="<?php echo esc_url($map); ?>" target="_blank" class="location">
                        <img src="<?php echo esc_url($map_image['url']); ?>" alt="<?php echo esc_attr($map_image['alt']); ?>">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>