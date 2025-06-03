<?php
/**
 * Template View for displaying Blocks
 *
 * @package NM_Theme
 */
?>

<div class="basic-block">
	<div class="container-small">
		<div class="entry-content">
			<?php 
				$content = get_sub_field('content');

				if (!empty($content)) : ?>
				<?php echo $content; ?>
			<?php endif; ?>

			<?php
				$term = get_queried_object();
				$content_blocks = get_field('content_blocks', 'product_cat_' . $term->term_id);

				if (!empty($content_blocks)) {
					foreach ($content_blocks as $block) {
						if ($block['acf_fc_layout'] === 'basic_block') {
							echo wp_kses_post($block['content']);
						}
					}
				}
			?>

		</div>
	</div>
</div><!-- .basic-block -->
