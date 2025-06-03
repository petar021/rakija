<?php
$term = get_queried_object();

// Proveri da li je to glavna (parent) kategorija
if (isset($term->term_id) && $term->taxonomy === 'product_cat' && $term->parent == 0) :

    if (have_rows('content_blocks', 'product_cat_' . $term->term_id)) :
        while (have_rows('content_blocks', 'product_cat_' . $term->term_id)) : the_row();
            if (get_row_layout() === 'basic_block') :
                $right_content = get_sub_field('content');
                ?>
                <div class="basic-block">
                    <div class="container-small">
                        <div class="entry-content">
                            <?php 
                                $content = get_sub_field('content');

                                if (!empty($content)) : ?>
                                <?php echo $content; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- .basic-block -->
                <?php
            endif;
        endwhile;
    endif;

endif;
?>