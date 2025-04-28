<?php
// Uzimamo ACF polja
$display_type = get_field('display_type'); // checkbox polje
$selected_posts = get_field('selected_posts'); // relationship polje

// Trenutna strana za paginaciju
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Osnovni WP_Query argumenti
$args = [
    'post_type' => 'post',
    'posts_per_page' => 9,
    'paged' => $paged,
];

// Ako je Display Type čekiran i postoje Selected Posts -> prikazujemo samo njih
if (!empty($display_type) && !empty($selected_posts)) {
    $args['post__in'] = wp_list_pluck($selected_posts, 'ID');
    $args['orderby'] = 'post__in'; // čuva redosled iz relationship polja
}

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
<section class="three-column-posts gray">
    <div class="container">
        <div class="three-column-posts__wrapper">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="three-column-posts__box">
                    <div class="three-column-posts__box-top">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-03.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="three-column-posts__box-bottom">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn-icon btn-icon__white btn-icon__center btn-icon__gray">
                            <span class="font-eye"></span>Pročitaj
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="three-column-posts__pagination">
            <nav class="pagination" role="navigation">
                <?php
                $big = 999999999; // potrebno za ispravan rad paginacije

                $pagination_links = paginate_links([
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $query->max_num_pages,
                    'type' => 'array', // Ovo nam omogućava da dobijemo listu linkova
                    'prev_text' => '<span class="font-arrow-small"></span>',
                    'next_text' => '<span class="font-arrow-small"></span>',
                ]);

                if (!empty($pagination_links)) : ?>
                    <ul class="page-numbers">
                        <?php foreach ($pagination_links as $link) : ?>
                            <li><?php echo str_replace('page-numbers', 'page-numbers', $link); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</section>

    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p>Trenutno nema dostupnih postova.</p>
<?php endif; ?>


