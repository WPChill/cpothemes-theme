<?php $external_url = get_post_meta(get_the_ID(), 'plugin_external', true); ?>
<div class="item">
	<div class="theme-thumbnail">
		<a href="<?php the_permalink(); ?>" >
			<?php the_post_thumbnail('medium', array('title' => '')); ?>
		</a>
		<?php if ($external_url != ''): ?>
		<div class="free-theme-tag"></div>
		<?php endif; ?>
	</div>
	<div class="theme-content">
		<h3 class="theme-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<div class="theme-meta"><?php echo get_post_meta(get_the_ID(), 'plugin_title', true); ?></div>
	</div>
</div>