<?php
/**
 * The template for displaying all pages
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
    <main id="primary" class="site-main">
        <div class="container">
            <div class="page-content">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                endwhile; // End of the loop.
                ?>
            </div>
        </div>
    </main><!-- #main -->
<?php
get_footer();