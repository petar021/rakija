<?php
$term = get_queried_object();

// Proveri da li je to glavna (parent) kategorija
if (isset($term->term_id) && $term->taxonomy === 'product_cat' && $term->parent == 0) :

    if (have_rows('content_blocks', 'product_cat_' . $term->term_id)) :
        while (have_rows('content_blocks', 'product_cat_' . $term->term_id)) : the_row();
            if (get_row_layout() === 'banner_title') :
                $right_content = get_sub_field('right_content');
                ?>
                <section class="banner-title">
                    <div class="container">
                        <div class="banner-title__wrapper">
                            <div class="banner-title__left">
                                <h1 class="page-title"><?php echo esc_html($term->name); ?></h1>
                            </div>
                            <div class="banner-title__right">
                                <?php if (!empty($right_content)) : ?>
                                    <p><?php echo esc_html($right_content); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            endif;
        endwhile;
    endif;

endif;
?>
