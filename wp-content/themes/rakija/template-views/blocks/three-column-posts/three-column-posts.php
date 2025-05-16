<?php


        if (get_row_layout() == 'three_column_posts') :
            $show_posts = get_sub_field('show_posts');

            if ($show_posts) {
                $posts = $show_posts;
            } else {
                $posts = get_posts([
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'post_type' => 'post',
                ]);
            }
?>
<section class="three-column-posts">
    <div class="container">
        <?php 
            $title = get_sub_field('title');

            if (!empty($title)) : ?>
            <h2 class="section-title section-title--center"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php 
            $content = get_sub_field('content');

            if (!empty($content)) : ?>
            <p class="title-description"><?php echo esc_html($content); ?></p>
        <?php endif; ?>
        <div class="three-column-posts__wrapper">
            <?php
            global $post; // obavezno!!!
            $original_post = $post; // cuvamo originalno stanje

            foreach ($posts as $post) :
                setup_postdata($post); ?>
                <div class="three-column-posts__box">
                    <div class="three-column-posts__box-top">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.jpg" alt="">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="three-column-posts__box-bottom">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn-icon btn-icon__white btn-icon__center">
                            <span class="font-eye"></span>Pročitaj
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php
            wp_reset_postdata();
            $post = $original_post; // VRACAMO post kako je bio
            ?>
        </div>
    </div>
</section>
<?php
        endif;

?>
