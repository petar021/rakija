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
                    <?php if (get_row_layout() === 'destilerije_categories') : ?>
                        <div class="two-column-brands__logos">
                            <?php if (have_rows('category_links')) : ?>
                                <?php while (have_rows('category_links')) : the_row(); ?>
                                    <?php
                                    $link = get_sub_field('link');
                                    $image = get_sub_field('image');
                                    if ($link && $image) :
                                        $url = $link['url'];
                                        $title = $link['title'] ?: '';
                                        $target = $link['target'] ?: '_self';
                                        ?>
                                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

        </div>
    </div>
</section>