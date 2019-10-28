<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content content-blog">
			<?php do_action('cpotheme_before_content'); ?>
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<?php get_template_part('element', 'blog'); ?>
			<?php comments_template('', true); ?>
			<?php endwhile; ?>
			<?php do_action('cpotheme_after_content'); ?>
			<script>
				ga('set', 'contentGroup1', 'Blog Posts'); 
			</script>
		</section>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>