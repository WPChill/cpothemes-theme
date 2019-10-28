<div class="testimonial">
	<div class="testimonial-body">
		<div class="column col4">
			<div class="testimonial-author">
				<h3 class="testimonial-title"><?php the_title(); ?></h3>
				<div class="testimonial-position"><?php echo get_post_meta(get_the_ID(), 'testimonial_description', true); ?></div>
				<?php the_post_thumbnail('thumbnail', array('class' => 'testimonial-image')); ?>
			</div>
		</div>
		<div class="column col4x3 col-last">
			<div class="testimonial-content">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>