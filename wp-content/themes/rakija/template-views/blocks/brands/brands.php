<section class="brands">
    <div class="container">
        <div class="brands-grid">
            <?php
                // Dohvati kategoriju "Destilerije" po slugu (ili koristi naziv ako je sigurnije)
                $destilerije_term = get_term_by('slug', 'destilerije', 'product_cat');
                
                if ($destilerije_term) :
                    // Dohvati sve podkategorije kategorije "Destilerije"
                    $subcategories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => $destilerije_term->term_id
                    ));
            ?>
            
            <?php if (!empty($subcategories)) : ?>
                <?php foreach ($subcategories as $subcategory) :
                    $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                    $placeholder_url = get_stylesheet_directory_uri() . '/assets/images/project/placeholder-image.jpg';

                    $image_url = $thumbnail_id
                        ? wp_get_attachment_url($thumbnail_id)
                        : $placeholder_url;

                    $link = get_term_link($subcategory);
                ?>
                    <a href="<?php echo esc_url($link); ?>" class="subcategory-box">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($subcategory->name); ?>">
                        <?php if ($image_url === $placeholder_url) : ?>
                            <span class="subcategory-name"><?php echo esc_html($subcategory->name); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
