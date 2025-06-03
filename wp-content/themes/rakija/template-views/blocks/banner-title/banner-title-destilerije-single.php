<?php
$term = get_queried_object();

// Parent kategorija (ako postoji)
$parent_term = $term->parent ? get_term($term->parent, 'product_cat') : null;

// ACF fleksibilni sadržaj (pretpostavljamo da koristiš ACF sa taxonomy termovima)
$acf_flex_content = get_field('content', 'product_cat_' . $term->term_id);

// Thumbnail slika
$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
$image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : get_stylesheet_directory_uri() . '/assets/images/project/placeholder-image.jpg';
?>

<section class="banner-title">
    <div class="container">
        <nav class="breadcrumb" aria-label="breadcrumb">
            <ul>
                <?php if ($parent_term): ?>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>destilerije"><?php echo esc_html($parent_term->name); ?></a></li>
                <?php endif; ?>
                <li><?php echo esc_html($term->name); ?></li>
            </ul>
        </nav>

        <h1 class="page-title"><?php echo esc_html($term->name); ?></h1>

        <div class="banner-title__wrapper">
            <div class="banner-title__left">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term->name); ?>">
            </div>
            <div class="banner-title__right">
                
                <?php
                    $term = get_queried_object();
                    $content_blocks = get_field('content_blocks', 'product_cat_' . $term->term_id);

                    if (!empty($content_blocks)) {
                        foreach ($content_blocks as $block) {
                            if ($block['acf_fc_layout'] === 'banner_title') {
                                echo wp_kses_post($block['right_content']);
                            }
                        }
                    }
                ?>

            </div>
        </div>
    </div>
</section>
