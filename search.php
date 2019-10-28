<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<article class="search-result" id="post-<?php the_ID(); ?>"> 			
				<h4 class="search-title heading">
					<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Go to %s', 'cpotheme'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h4>
				<div class="search-byline">
					<?php the_permalink(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<?php cpotheme_numbered_pagination(); ?>
			<?php endif; ?>
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
