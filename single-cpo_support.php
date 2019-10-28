<?php get_header(); ?>

<?php if(have_posts()) while(have_posts()): the_post(); ?>
<section id="pagetitle" class="pagetitle">
	<div class="container">
		<h1 class="pagetitle-title heading"><?php the_title(); ?></h1>
		<div class="pagetitle-subtitle"><?php if(has_excerpt()) echo get_the_excerpt(); ?></div>			
	</div>
</section>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php $categories = get_the_terms(get_the_ID(), 'cpo_support_category'); ?>
				<?php foreach($categories as $current_category): ?>
				<a class="button-back button button-small" href="<?php echo get_term_link($current_category, 'cpo_support_category'); ?>"><span class="icon-angle-double-left"></span> <?php printf(__('Back to %s'), $current_category->name); ?></a>
				<?php endforeach; ?>
				
				<div class="page-content">
					<?php the_content(); ?>
					<?php cpotheme_post_pagination(); ?>
				</div>
			</div>
			<?php comments_template('', true); ?>
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>