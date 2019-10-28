<?php /* Template Name: Support - Docs */ ?>
<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>

<div id="main" class="main">
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
			
			<div class="widget_search support-search">
				<form role="search" method="get" id="search-form" class="search-form" action="<?php echo home_url('/'); ?>">
					<input type="text" placeholder="<?php _e('Search the Documentation...', 'cpotheme'); ?>" value="<?php if(isset($_GET['s'])) echo esc_attr($_GET['s']); ?>" name="s" id="s" />
					<input type="hidden" value="cpo_support" name="post_type" id="post_type" />
					<input type="submit" id="search-submit" value="<?php _e('Search', 'cpotheme'); ?>" />
				</form>
			</div>
			
			<div id="docs" class="docs">
				<?php $feature_posts = get_terms('cpo_support_category'); ?>
				<?php foreach($feature_posts as $term): $feature_count++; ?>				
				<div class="column col2<?php if($feature_count % 2 == 0 && $feature_count != 0) echo ' col-last';  ?>">
					<div class="docs-item content-block">
						<div class="docs-count">
							<?php echo $term->count; ?>
						</div>
						<h4 class="docs-title">
							<a href="<?php echo get_term_link($term); ?>">
								<?php echo $term->name; ?>
							</a>
						</h4>
						<div class="docs-content">
							<?php echo $term->description; ?>
						</div>
						<a class="button button-small" href="<?php echo get_term_link($term); ?>"><?php _e('View Documentation', 'cpotheme'); ?></a>
					</div>
				</div>
				<?php endforeach; ?>
				<div class='clear'></div>
			</div>
			
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>