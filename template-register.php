<?php /* Template Name: Dashboard: Register */ ?>
<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			<div id="register" class="register-form">
				<?php if(isset($_POST['user_register']) && !isset($_GET['register'])): ?>
				<div class="ctsc-message ctsc-message-error"><?php _e('All fields are required or the username you have chosen is already taken.', 'cpotheme'); ?></div>
				<?php endif; ?>
				
				<?php if(is_user_logged_in() || isset($_GET['register'])): ?>
				<div class="ctsc-message ctsc-message-ok">
					<?php _e('Thank you for creating an account. You can now access all free resources on this site!', 'cpotheme'); ?>
				</div>
				<div class="content-block">
					<?php get_template_part('element', 'user'); ?> 
				</div>
				<?php if(have_posts()) while(have_posts()): the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="page-content">
						<?php the_content(); ?>
					</div>
				</div>
				<?php endwhile; ?>
				
				
				<?php else: ?>
				
				<?php $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : ''; ?>
				<?php $user_first_name = isset($_POST['user_first_name']) ? trim($_POST['user_first_name']) : ''; ?>
				<?php $user_email = isset($_POST['user_email']) ? trim($_POST['user_email']) : ''; ?>
				<?php $user_password = isset($_POST['user_password']) ? trim($_POST['user_password']) : ''; ?>
				<?php $user_details = isset($_POST['user_details']) ? trim($_POST['user_details']) : ''; ?>
				<form id="wp_register_form"  name="registerform" action="<?php echo get_permalink(get_the_ID()); ?>" method="post">  
					<p>
						<div class="column col2">
							<input name="user_email" class="text" value="<?php echo esc_attr($user_email); ?>" type="text" placeholder="<?php _e('Your email address', 'cpotheme'); ?>" required>  
						</div>
						<div class="column col2 col-last">
							<input name="user_first_name" class="text" value="<?php echo esc_attr($user_first_name); ?>" type="text" placeholder="<?php _e('Your name...', 'cpotheme'); ?>" required>
						</div>
						<div class="clear"></div>
					</p>
					<p>
						<input name="user_name" class="text" value="<?php echo esc_attr($user_name); ?>" type="text" placeholder="<?php _e('Your desired username...', 'cpotheme'); ?>" required>
					</p>
					<p>
						<input name="user_password" class="text" value="<?php echo esc_attr($user_password); ?>" type="password" placeholder="<?php _e('Enter your desired password', 'cpotheme'); ?>" required>  
					</p>
					<p>
						<?php _e('How will you use our WordPress themes?', 'cpotheme'); ?>
						<select name="user_details" required>  
							<option value=""><?php _e('(Select One)', 'cpotheme'); ?></option>  
							<option value="personal" <?php if($user_details == 'personal') echo 'selected'; ?>><?php _e('I plan to use them for myself.', 'cpotheme'); ?></option>  
							<option value="professional" <?php if($user_details == 'professional') echo 'selected'; ?>><?php _e('I plan on using them for my clients.', 'cpotheme'); ?></option>  
						</select>  
					</p>
					<p>
						<input name="user_register" value="<?php _e('Create An Account', 'cpotheme'); ?>" type="submit" />  
					</p>
					<input name="user_check" class="text password" value="" type="text">  
				</form>  
				<?php endif; ?>
			</div>
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>