<section class="banner-title">
    <div class="container">
        <div class="banner-title__wrapper">
            <div class="banner-title__left">
                <?php 
                    $title = get_sub_field('title');

                    if (!empty($title)) : ?>
                    <h1 class="page-title"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                <?php 
                    $title_description = get_sub_field('title_description');

                    if (!empty($title_description)) : ?>
                    <span><?php echo esc_html($title_description); ?></span>
                <?php endif; ?>
            </div>
            <div class="banner-title__right">
                <?php 
                    $right_content = get_sub_field('right_content');

                    if (!empty($right_content)) : ?>
                    <p><?php echo esc_html($right_content); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>