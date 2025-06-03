<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NM_Theme
 */

get_header(); ?>

<main class="search-results">
	<div class="container">
		<h1 class="search-title section-title">
			Rezultati pretrage za: "<?php echo get_search_query(); ?>"
		</h1>
 
		<?php if (have_posts()) : ?>
			<div class="search-results__list">
				<?php while (have_posts()) : the_post(); ?>
				<article class="search-result-item">
					<a href="<?php the_permalink(); ?>">
						<div class="search-result-thumbnail">
							<?php if (has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('medium'); ?>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/project/placeholder-image.jpg" alt="Fallback slika" />
							<?php endif; ?>
						</div>
						<h3><?php the_title(); ?></h3>
						<p><?php echo get_the_excerpt(); ?></p>
					</a>
				</article>

				<?php endwhile; ?>
			</div>

			<div class="pagination">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<div class="no-results">
				<h2>Nažalost, nema rezultata za tvoju pretragu.</h2>
				<p>Pokušaj ponovo sa drugim pojmom.</p>
			</div>
		<?php endif; ?>
	 </div>
 </main>
 
 <?php get_footer(); ?>
 
