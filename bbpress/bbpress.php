<?php get_header(); ?>

<section id="pagetitle" class="pagetitle">
	<div class="container">
		<span class="pagetitle-title heading">
			<?php _e('Support Forum', 'cpotheme'); ?>
		</span>
		<div class="pagetitle-subtitle">
			<?php _e('Get answers to any issues when using one of our WordPress themes.', 'cpotheme'); ?>
		</div>
	</div>
</section>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<h1 class="post-title"> <?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php cpotheme_post_pagination(); ?>
				</div>
			</div>
			<?php comments_template('', true); ?>
			<?php endwhile; ?>
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>