<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>  
    <?php wp_head(); ?>
<meta name="google-site-verification" content="cs6k-HQM3Zk3d70r5Oe8gVUTGdEsmbm5cULaicYH-M4" />
</head>

<body <?php body_class(); ?>>
	<div class="outer asdasdasd" id="top">
		<?php do_action('cpotheme_before_wrapper'); ?>
		<div class="wrapper">
			<div id="topbar" class="topbar dark">
				<div class="container">
					<?php do_action('cpotheme_top'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<header id="header" class="header">
				<div class="container">
					<?php do_action('cpotheme_header'); ?>
					<div class='clear'></div>
				</div>
			</header>
			<?php do_action('cpotheme_before_main'); ?>
			<div class="clear"></div>