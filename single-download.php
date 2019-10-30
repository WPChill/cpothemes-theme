<?php get_header(); ?>

<?php if(have_posts()) while(have_posts()) : the_post(); ?>

<?php $post_id = get_the_ID();  ?>
<?php $download_id = get_post_meta($post_id, 'download_product', true);  ?>
<?php $external_url = get_post_meta(get_the_ID(), 'download_url', true); ?>
<?php wp_enqueue_style('cpotheme-fontawesome'); ?>

<section id="pagetitle" class="pagetitle">
	<div class="container">
		<span class="pagetitle-title heading"><?php the_title(); ?></span>
		<h1 class="pagetitle-subtitle"><?php echo get_post_meta(get_the_ID(), 'download_title', true); ?></h1>
	</div>
</section>

<div id="main" class="main">
	<div class="container">
		<div id="content" class="content content-wide">
			<?php $subscription_product = 26846; ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<a href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>" target="_blank" id="theme-thumbnail" class="theme-thumbnail">
					<div class="theme-thumbnail-image">
						<?php the_post_thumbnail('full', array('title' => '')); ?>
					</div>
					<div class="theme-thumbnail-overlay"></div>
					<div class="theme-thumbnail-content">
						<?php _e('View Theme Demo', 'cpotheme'); ?>
						<span><?php _e('See What It Can Do', 'cpotheme'); ?></span>
					</div>
				</a>
				<div class="clear"></div>
				
				<div class="content theme-content">
					<?php the_content(); ?>
				</div>
				
				<div class="sidebar theme-sidebar">					
					<?php if(get_post_meta(get_the_ID(), 'download_product', true) != 0): ?>
					<a class="button button-center button-large button-buy" id="button-buy" href="#purchase"><?php _e('Purchase', 'cpotheme'); ?> - <?php edd_price($download_id); ?></a>
					<?php endif; ?>
					
					<?php if($external_url != ''): ?>
					<a class="button button-center button-large button-buy" id="button-download" target="_blank" href="<?php echo $external_url; ?>"><?php _e('Free Download', 'cpotheme'); ?></a>
					<?php endif; ?>
					
					<a class="button button-center button-large button-try" id="button-try" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>"><?php _e('View Demo', 'cpotheme'); ?></a>
					
					<div class="theme-details">
						<div class="theme-field">
							<b><?php _e('Released', 'cpotheme'); ?></b> <?php the_date(); ?>
						</div>
						<div class="theme-field">
							<b><?php _e('Requires', 'cpotheme'); ?></b> WordPress 4.0+
						</div>
						<!--<p><a href="#changelog" rel="gallery[changelog]"><?php _e('View Changelog', 'cpotheme'); ?></a></p>-->
					</div>
					<!--<div id="changelog">
						<div class="changelog">
							<?php echo nl2br(get_post_meta(get_the_ID(), 'download_changelog', true)); ?>
						</div>
					</div>-->
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>



<?php $args = array(
'post_type' => 'attachment', 
'posts_per_page' => 4, 
'post_status' => null, 
'post_mime_type' => 'image', 
'exclude' => get_post_thumbnail_id(), 
'post_parent' => $post_id);
$attachments = get_posts($args); $feature_count = 0;
if(sizeof($attachments) == 4):
wp_enqueue_style('cpotheme-magnific');
wp_enqueue_script('cpotheme-magnific'); ?>
<div class="image-gallery">
	<div class="row">
		<?php foreach($attachments as $attachment): ?>
		<?php if($feature_count % 4 == 0 && $feature_count > 0) echo '</div><div class="row">'; ?>
		<?php $feature_count++; ?>
		<div class="column column-fit col4<?php if($feature_count % 4 == 0) echo ' col-last'; ?>">
			<div class="image-gallery-item" style="margin:0;">
				<?php $source = wp_get_attachment_image_src($attachment->ID, 'portfolio'); ?>
				<?php $original_source = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
				<a class="theme-gallery-item" href="<?php echo esc_url($original_source[0]); ?>" data-gallery="gallery">
					<img src="<?php echo esc_url($source[0]); ?>" style="display:block;"/>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
</div>
<?php endif; ?>


<?php $theme_features = get_post_meta($post_id, 'download_features', true); ?>
<?php if(is_array($theme_features) && current_user_can('edit_theme_options')): $feature_count = 0; ?>
<div id="themefeatures" class="themefeatures">
	<div class="container">
		<h2 class="section-heading"><?php printf(__('%s Highlights', 'cpotheme'), get_the_title()); ?></h2>
		<div class="section-subheading"><?php printf(__('Take a look at what %s can offer you.', 'cpotheme'), get_the_title()) ?></div>
		<div class="row">
			<?php foreach($theme_features as $current_feature): ?>
			<?php if($feature_count % 3 == 0 && $feature_count > 0) echo '</div><div class="row">'; ?>
			<?php $feature_count++; ?>
			<div class="column column-early col3<?php if($feature_count % 3 == 0) echo ' col-last'; ?>">
				<div class="feature">
					<div class="feature-icon"></div>
					<div class="feature-body">
						<h3 class="feature-title">
							<?php echo $current_feature['title']; ?>
						</h3>
						<div class="feature-content">
							<?php echo $current_feature['content']; ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<?php endforeach; ?>
			<div class='clear'></div>
		</div>
	</div>
</div>
<?php endif; ?>


<?php $feature_posts = new WP_Query('post_type=cpo_themefeature&posts_per_page=-1&orderby=menu_order&order=ASC'); ?>
<?php if($feature_posts->posts): $feature_count = 0; ?>
<div id="corefeatures" class="corefeatures section">
	<div class="container">
		<h2 class="section-heading"><?php _e('Core Features', 'cpotheme'); ?></h2>
		<div class="section-subheading"><?php _e('All premium WordPress themes come loaded with these useful features.', 'cpotheme'); ?></div>
		<?php foreach($feature_posts->posts as $post): setup_postdata($post); ?>
		<?php $feature_count++; ?>
		<?php $feature_classes = ''; ?>
		<?php if($feature_count % 2 != 0) $feature_classes .= 'feature-even';  ?>
		<?php if($feature_count >= 4): ?>
		<?php $feature_classes .= ' feature-vertical column col3'; ?>
		<?php if(($feature_count - 3) % 3 == 0) $feature_classes .= ' col-last'; ?>
		<?php endif; ?>
		<div class="feature <?php echo $feature_classes; ?>">
			<div class="feature-image">
				<?php the_post_thumbnail('full', array('title' => '')); ?>
			</div>
			<div class="feature-content">
				<?php the_content(); ?>
			</div>
			<div class='clear'></div>
		</div>
		<?php endforeach; ?>
		<div class='clear'></div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php endif; ?>


<div id="purchase" class="purchase">
	<div class="container">
		<div class="purchase-wrapper">
			<?php $pricing_columns = 2; ?>
			
			<?php if($external_url != ''): ?>
			<?php $pricing_columns++; ?>
			<div class="column col<?php echo $pricing_columns; ?>">
				<h3 class="purchase-title"><?php the_title(); ?></h3>
				<div class="purchase-price"><?php _e('Free', 'cpotheme'); ?></div>
				<div class="purchase-content">
					<?php _e('Download the free version of this theme for free, then upgrade to the Pro version later on.', 'cpotheme'); ?>
					<ul>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Unlimited theme usage', 'cpotheme'); ?></li>
						<li><span class="icon-remove">&#xf00d;</span> <?php _e('Only basic features', 'cpotheme'); ?></li>
						<li><span class="icon-remove">&#xf00d;</span> <?php _e('No access to support', 'cpotheme'); ?></li>
						<li><span class="icon-remove">&#xf00d;</span> <?php _e('No updates, only bugfixes', 'cpotheme'); ?></li>
						<li><span class="icon-remove">&#xf00d;</span> <?php printf(__('Access only %s WordPress theme', 'cpotheme'), get_the_title()); ?></li>
					</ul>
				</div>
				<div class="purchase-button">
					<?php if($external_url != '' && is_user_logged_in()): ?>
					<a class="button button-medium button-try" id="button-download-footer" href="https://cpothemes.com/download-file.php?file=<?php echo $external_url; ?>&key=<?php echo md5(date('Ymd')); ?>"><?php _e('Download For Free', 'cpotheme'); ?></a>
					<?php else: ?>
					<a class="button button-medium button-try" id="button-gologin-footer" href="<?php echo cpotheme_get_option('url_login'); ?>"><?php _e('Log In To Download', 'cpotheme'); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="column col<?php echo $pricing_columns; ?>">
				<h3 class="purchase-title"><?php the_title(); ?> Pro</h3>
				<div class="purchase-price"><span>$</span>49<span class="description"><?php _e('One Time Fee', 'cpotheme'); ?></span></div>
				<div class="purchase-content">
					<?php _e('Get a copy of this theme for a single payment, as well as one year of free updates and premium support.', 'cpotheme'); ?>
					<ul>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Unlimited theme usage', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Premium features and options', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Premium support for one year', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Free updates and bugfixes for one year', 'cpotheme'); ?></li>
						<li><span class="icon-remove">&#xf00d;</span> <?php printf(__('Access only %s WordPress theme', 'cpotheme'), get_the_title()); ?></li>
					</ul>
				</div>
				<div class="purchase-button">
					<?php $edd_options = edd_get_settings(); ?>
					<?php $button_link = get_permalink($edd_options['purchase_page']); ?>
					<a class="button button-medium button-purchase" id="button-buy-footer" href="<?php echo $button_link; ?>?edd_action=add_to_cart&download_id=<?php echo get_post_meta($post_id, 'download_product', true); ?>"><?php _e('Purchase', 'cpotheme'); ?> <?php the_title(); ?></a>
				</div>
			</div>
			<div class="column col<?php echo $pricing_columns; ?> col-last">
				<h3 class="purchase-title"><?php _e('Subscription', 'cpotheme'); ?></h3>
				<div class="purchase-price"><span>$</span>119<span class="description"><?php _e('Per Year', 'cpotheme'); ?></span></div>
				<div class="purchase-content">
					<?php _e('Become a subscriber and access every theme in our collection, including future releases. Subscribers get priority support.', 'cpotheme'); ?>
					<ul>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Unlimited theme usage', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Premium features and options', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Access all existing themes', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Premium support for all subscribers', 'cpotheme'); ?></li>
						<li><span class="icon-check">&#xf00c;</span> <?php _e('Access new releases every month', 'cpotheme'); ?></li>
					</ul>
				</div>
				<div class="purchase-button">
					<a class="button button-medium button-subscribe" id="button-subscribe-footer" href="<?php echo cpotheme_get_option('url_subscribe'); ?>"><?php _e('Subscribe', 'cpotheme'); ?></a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php get_footer(); ?>