<?php
/**
 * Template View for displaying Blocks
 *
 * @package NM_Theme
 */
?>

<section class="basic-block wishlist">
    <div class="container">
        <?php if( get_row_layout() == 'wishlist_block' ): ?>
            <?php
                $shortcode = get_sub_field('shortcode');
                if ($shortcode) {
                    echo do_shortcode($shortcode);
                }
            ?>
        <?php endif; ?>
    </div>
</section><!-- .basic-block -->