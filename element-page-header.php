<?php if(!is_front_page()): ?>
<?php do_action('cpotheme_before_title'); ?>

<section id="pagetitle" class="pagetitle">
	<div class="container">
		<?php do_action('cpotheme_title'); ?>
		<?php if(is_page()): ?>
		<div class="pagetitle-subtitle">
			<?php echo get_post_meta($post->ID, 'page_subtitle', true); ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php do_action('cpotheme_after_title'); ?>
<?php endif; ?>