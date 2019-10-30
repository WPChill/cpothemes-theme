<?php $download_id = get_post_meta(get_the_ID(), 'download_product', true);  ?>
<?php $external_url = get_post_meta(get_the_ID(), 'download_url', true); ?>
<?php cpotheme_eddeet_impression($download_id); ?>

<div class="item">
	<div class="theme-thumbnail">
		<a href="<?php the_permalink(); ?>" >
			<?php the_post_thumbnail('medium', array('title' => '')); ?>
		</a>
		<?php if ($external_url != ''): ?>
		<div class="free-theme-tag"><?php _e('Free Theme', 'cpotheme'); ?></div>
		<?php endif; ?>
	</div>
	<div class="theme-content">
		<h3 class="theme-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="theme-meta"><?php echo get_the_term_list(get_the_ID(), 'cpo_theme_category', '', ', ', ''); ?></div>
	</div>
</div>