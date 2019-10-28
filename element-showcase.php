<div class="showcase-item">
	<div class="showcase-image">
		<div class="showcase-overlay">
			<?php $url = get_post_meta(get_the_ID(), 'showcase_url', true); ?>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url($url); ?>" >
				<?php _e('Visit Site', 'cpotheme'); ?>
			</a>
		</div>
		<?php the_post_thumbnail('theme', array('title' => '')); ?>
	</div>
	<div class="showcase-body">
		<h3 class="showcase-title"><?php the_title(); ?></h3>
		<div class="showcase-meta">
			<?php $theme = get_post_meta(get_the_ID(), 'showcase_theme', true); ?>
			<?php if($theme): ?>
			<a href="<?php echo get_permalink($theme); ?>">
				<?php printf(__('Created with %s', 'cpotheme'), cpotheme_metadata_themelist_optional($theme)); ?>
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>