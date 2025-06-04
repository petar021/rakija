<section class="banner-title">
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