<section class="brands">
    <div class="container">
        <div class="brands-grid">
            <?php
                // Dohvati trenutnu kategoriju
                $term = get_queried_object();

                // Dohvati sve podkategorije
                $subcategories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));
            ?>
            
            <?php if (!empty($subcategories)) : ?>
                <?php foreach ($subcategories as $subcategory) :
                    $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id
                        ? wp_get_attachment_url($thumbnail_id)
                        : get_stylesheet_directory_uri() . '/assets/images/project/placeholder-image.webp';

                    $link = get_term_link($subcategory);
                ?>
                    <a href="<?php echo esc_url($link); ?>" class="subcategory-box">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($subcategory->name); ?>">
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>