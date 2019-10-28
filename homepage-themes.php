<?php $query = new WP_Query('post_type=cpo_theme&posts_per_page=6'); ?>
<?php if($query->posts): $feature_count = 0; ?>
<div id="themes" class="themes">
	<div class="container">
		<?php foreach($query->posts as $post): setup_postdata($post); ?>
		<?php $feature_count++; ?>
		<div class="column col3<?php if($feature_count % 3 == 0) echo ' col-last'; ?>">
			<?php get_template_part('element', 'theme'); ?>
		</div>
		<?php if($feature_count % 3 == 0) echo '<div class="col-divide"></div>'; ?>
		<?php endforeach; ?>
		<div class='clear'></div>
	</div>
</div>
<?php endif; ?>