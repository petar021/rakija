<?php
/**
 * Template Name: Flex Content
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NM_Theme
 */

get_header();
?>

<div id="primary-div" class="content-area">
    <main id="primary" class="site-main">
        <?php if (have_rows('content')) : ?>
            <?php while (have_rows('content')) : the_row(); ?>

                <?php if (get_row_layout() == 'hero') : ?>
                    <?php get_template_part('template-views/blocks/hero/hero'); ?>

                <?php elseif (get_row_layout() == 'image_block') : ?>
                    <?php get_template_part('template-views/blocks/image-block/image-block'); ?>

                <?php elseif (get_row_layout() == 'destilerije_categories') : ?>
                    <?php get_template_part('template-views/blocks/two-column-brands/two-column-brands'); ?>

                <?php elseif (get_row_layout() == 'banner_title') : ?>
                    <?php get_template_part('template-views/blocks/banner-title/banner-title'); ?>
                
                <?php elseif (get_row_layout() == 'text_image') : ?>
                    <?php get_template_part('template-views/blocks/text-image/text-image'); ?>
                
                <?php elseif (get_row_layout() == 'basic_block') : ?>
                    <?php get_template_part('template-views/blocks/basic-block/basic-block'); ?>
                
                <?php elseif (get_row_layout() == 'contact_form') : ?>
                    <?php get_template_part('template-views/blocks/contact-form/contact-form'); ?>
                
                <?php elseif (get_row_layout() == 'three_column_posts') : ?>
                    <?php get_template_part('template-views/blocks/three-column-posts/three-column-posts'); ?>

                <?php elseif (get_row_layout() == 'all_posts') : ?>
                    <?php get_template_part('template-views/blocks/three-column-posts/three-column-posts-blog'); ?>
                    
                <?php elseif (get_row_layout() == 'google_reviews') : ?>
                    <?php get_template_part('template-views/blocks/reviews/reviews'); ?>
                
                <?php elseif (get_row_layout() == 'three_column_categories') : ?>
                    <?php get_template_part('template-views/blocks/three-column-cat/three-column-cat'); ?>
                
                <?php elseif (get_row_layout() == 'products_display') : ?>
                    <?php get_template_part('template-views/blocks/products/products'); ?>
                
                <?php elseif (get_row_layout() == 'category_display') : ?>
                    <?php get_template_part('template-views/blocks/three-column-cat/three-column-cat'); ?>

                <?php endif; ?>

            <?php endwhile; ?>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>