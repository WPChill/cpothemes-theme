<?php /* Template Name: Themes */ ?>
<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>

<div id="main" class="main sidebar-none">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
					<?php cpotheme_post_pagination(); ?>
				</div>
			</div>
			<?php comments_template('', true); ?>
			<?php endwhile; ?>
			<?php do_action('cpotheme_after_content'); ?>
			
			<ul class="menu-portfolio">
				<?php wp_list_categories("taxonomy=cpo_theme_category&title_li="); ?>
			</ul>
			
			<?php $feature_posts = new WP_Query('post_type=cpo_theme&posts_per_page=-1'); ?>
			<?php if($feature_posts->post_count > 0): $feature_count = 0; ?>
			<div id="themes" class="themes">
				<?php while($feature_posts->have_posts()): $feature_posts->the_post(); ?>
				<?php if($feature_count % 3 == 0 && $feature_count != 0) echo '<div class="col-divide"></div>'; $feature_count++; ?>
				<div class="column col3<?php if($feature_count % 3 == 0) echo ' col-last'; ?>">
					<?php get_template_part('element', 'theme'); ?>
				</div>
				<?php if($feature_count % 9 == 0 && $feature_count != 0 && $feature_count < $feature_posts->post_count) 
					get_template_part('element', 'ad'); ?>
				<?php endwhile; ?>
				<div class='clear'></div>
			</div>
			<?php endif; ?>
			
		</section>
		<?php //get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>