<?php global $current_user; get_currentuserinfo(); ?> 
<div class="user-account">
	<div class="user-avatar"><?php echo get_avatar($current_user->user_email, 120); ?></div>
	<div class="user-body">
		<div class="user-name"><?php echo $current_user->display_name; ?></div>
		<div class="user-field user-username"><?php echo $current_user->user_login; ?></div>
		<div class="user-field">
			<a href="<?php bloginfo('url'); ?>/wp-login.php?action=logout" class="user-logout">
				<?php _e('Log Out', 'cpotheme'); ?>
			</a>
		</div>
	</div>
</div>