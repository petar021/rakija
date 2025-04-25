<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NM_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-article' ); ?>>
	<div class="container-small">
		<div class="breadcrumb">
			<nav class="breadcrumb-nav" role="navigation" aria-label="Breadcrumb">
				<ul class="breadcrumb-list">
					<li class="breadcrumb-item">
						<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Blog</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">
						<?php the_title(); ?>
					</li>
				</ul>
			</nav>
		</div>

		<div class="post-article__head">
			<h1 class="basic-block-title"><?php the_title(); ?></h1>
		</div>
		<div class="entry-content post-article__content">
			<?php the_content(); ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
