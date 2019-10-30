<?php $query = new WP_Query('post_type=cpo_testimonial&posts_per_page=3'); ?>
<?php if ($query->posts): $feature_count = 0; ?>
<?php wp_enqueue_script('cpotheme_cycle'); ?>
<div id="testimonials" class="testimonials section">
	<div class="container">
		<h2 class="section-heading"><?php _e('What People Say About Us', 'cpotheme'); ?></h2>
		<div class="section-subheading"><?php _e('Over 10000 theme downloads in more than 30 countries.', 'cpotheme'); ?></div>
		<div class="testimonial-list cycle-slideshow" data-cycle-pause-on-hover="true" data-cycle-slides=".testimonial" data-cycle-prev=".testimonial-prev" data-cycle-next=".testimonial-next" data-cycle-timeout="6000" data-cycle-speed="1000" data-cycle-fx="fade">
			<?php foreach ($query->posts as $post): setup_postdata($post); ?>
				<?php get_template_part('element', 'testimonial'); ?>
			<?php endforeach; ?>
		</div>
		<!--<div class="testimonial-prev"></div>
		<div class="testimonial-next"></div>-->
		<div class='clear'></div>
	</div>
</div>
<?php endif; ?>