<?php get_header(); ?>

<?php
    $term = get_queried_object(); // <-- OBAVEZNO

    if ($term && have_rows('content_blocks', 'product_cat_' . $term->term_id)) :
        while (have_rows('content_blocks', 'product_cat_' . $term->term_id)) : the_row();

            if (get_row_layout() == 'basic_block') :
                get_template_part('template-views/blocks/basic-block/basic-block');

            elseif (get_row_layout() == 'banner_title') :
                get_template_part('template-views/blocks/banner-title/banner-title');

            elseif (get_row_layout() == 'subcategory_display') :
                get_template_part('template-views/blocks/brands/brands');

            endif;

        endwhile;
    endif;
?>


<?php get_footer(); ?>
