<?php wp_enqueue_style('cpotheme-fontawesome'); ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="post-image">
		<?php cpotheme_postpage_image(); ?>
    </div>
    <div class="post-body">
		<?php cpotheme_postpage_title(); ?>
        <div class="post-byline">
			<?php cpotheme_postpage_date(); ?>
			<?php cpotheme_postpage_author(); ?>
			<?php cpotheme_postpage_categories(); ?>
			<?php if (is_singular('post')) {
    cpotheme_postpage_comments();
} ?>
        </div>

		<?php if (is_singular('post')): ?>
            <div class="post-content">
				<?php cpotheme_postpage_content(); ?>
            </div>
			<?php cpotheme_author(); ?>
		<?php endif; ?>
    </div>
    <div class="clear"></div>
</article>