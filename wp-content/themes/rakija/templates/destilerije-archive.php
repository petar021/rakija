<?php
/**
 * Template Name: Destilerije Archive
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if (have_rows('content')) : ?>
            <?php while (have_rows('content')) : the_row(); ?>

                <?php if (get_row_layout() == 'banner_title') : ?>
                    <?php get_template_part('template-views/blocks/banner-title/banner-title-destilerije'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() == 'brands') : ?>
                    <?php get_template_part('template-views/blocks/brands/brands'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() == 'basic_block') : ?>
                    <?php get_template_part('template-views/blocks/basic-block/basic-block-destilerije'); ?>
                <?php endif; ?>

            <?php endwhile; ?>
        <?php endif; ?>
	</main>
</div>

<?php get_footer(); ?>
