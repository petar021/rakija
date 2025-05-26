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
		</div>
	</div>
</div><!-- .basic-block -->
