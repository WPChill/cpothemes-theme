<?php get_header(); ?>

<?php if(have_posts()) while(have_posts()) : the_post(); ?>

<?php $post_id = get_the_ID();  ?>
<?php $download_id = get_post_meta($post_id, 'download_product', true);  ?>
<?php //cpotheme_eddeet_detail($download_id); ?>
<?php $external_url = get_post_meta(get_the_ID(), 'download_url', true); ?>


<section id="pagetitle" class="pagetitle">
	<div class="container">
		<span class="pagetitle-title heading"><?php the_title(); ?></span>
		<h1 class="pagetitle-subtitle"><?php echo get_post_meta(get_the_ID(), 'plugin_title', true); ?></h1>
	</div>
</section>


<div id="main" class="main">
	<div class="container">
		<div id="content" class="content content-wide">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php $external_url = get_post_meta(get_the_ID(), 'plugin_url', true); ?>
				<?php if($external_url != ''): ?>
				<div class="plugin-links">					
					<?php if($external_url != ''): ?>
					<?php if(is_user_logged_in()): //FREE PLUGIN ?>
					<a class="button button-large" id="button-external" target="_blank" href="<?php echo esc_url($external_url); ?>"><?php _e('Free Download', 'cpotheme'); ?></a>
					<?php else: //LOGIN REQUIRED ?>
					<a class="button button-large" id="button-gologin" href="https://cpothemes.com/dashboard"><?php _e('Log In To Download', 'cpotheme'); ?></a>
					<?php endif; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
				<a href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>" target="_blank" id="plugin-thumbnail" class="plugin-thumbnail">
					<?php the_post_thumbnail('full', array('title' => '')); ?>
				</a>
				
				<div class="clear"></div>
				<div class=" plugin-content">
					<?php the_content(); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>


<?php get_footer(); ?>