<section class="three-column-cat">
    <div class="container">
        <div class="three-column-cat__wrapper">
        
            <?php
            $include_slugs = array('gin-dzin', 'likeri', 'rakija');

            // Dohvati sve top-level kategorije
            $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'parent' => 0,
                'orderby' => 'name',
                'order'   => 'DESC',
            ));

            // Preslikavanje slugova u željene naslove
            $custom_titles = array(
                'rakija'   => 'Rakije',
                'likeri'   => 'Likeri',
                'gin-dzin' => 'Dzinovi',
            );

            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                foreach ($product_categories as $category) :
                    if (!in_array($category->slug, $include_slugs)) {
                        continue;
                    }

                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id
                        ? wp_get_attachment_url($thumbnail_id)
                        : get_stylesheet_directory_uri() . '/assets/images/project/placeholder-image.jpg';

                    $category_link = get_term_link($category);
                    ?>
                    <a href="<?php echo esc_url($category_link); ?>">
                        <div class="three-column-cat__box">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" />
                            <h2 class="three-column-cat__title"><?php echo esc_html($custom_titles[$category->slug] ?? $category->name); ?></h2>
                            <div class="btn-icon">
                                <span class="font-eye"></span>
                                Pogledaj sve
                            </div>
                        </div>
                    </a>
                    <?php
                endforeach;
            endif;
            ?>

        </div>
    </div>
</section>
