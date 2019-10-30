<?php
/*
* Template Name: Checkout page
*/
?>



<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?> id="top">


<div class="check-out-page">

    <div class="header--checkout">
        <div class="container">
			<div class="row sigma-vcenter">
				<div class="column header--checkout__first-col">
					<a href="<?php echo get_site_url(); ?>">
						<img style="max-height:100px;" alt="CPO Themes Logo" src="https://mk0cpothemes5l2l62gf.kinstacdn.com/wp-content/uploads/cpo-logo-header.png"/>
					</a>
				</div>
				<div class="column header--checkout__second-col">
					<div class="checkout-steps">
						<div class="checkout-steps__pricing-step">
							<div class="checkout-steps__label">Choose Plan</div>
						</div><!-- checkout-steps__pricing-step -->
						<div class="checkout-steps__line"></div>
						<div class="checkout-steps__checkout-step">
							<div class="checkout-steps__label">Payment Details</div>
						</div><!-- checkout-steps__checkout-step -->
						<div class="checkout-steps__line"></div>
						<div class="checkout-steps__download-step">
							<div class="checkout-steps__label">Download Files</div>
						</div><!-- checkout-steps__download-step -->
					</div><!-- checkout-steps -->
				</div>
			</div>
        </div>
	</div><!-- header--checkout -->

	<?php if (function_exists('edd_get_cart_contents') && edd_get_cart_contents()) : ?>

		<?php
            $payment_mode = edd_get_chosen_gateway();
            $form_action  = esc_url(edd_get_checkout_uri('payment-mode=' . $payment_mode));
        ?>

		<div class="container">

			<div class="row">
				<div class="column col1 checkout-page-title">
					<h1 class="text-center">Complete Your Purchase</h1>
				</div>
			</div><!-- row -->

			<div class="row">

				<div class="column checkout-page-first-col">

					<?php edd_checkout_cart(); ?>

					<div class="checkout-badges">
						<div>
							<img title="SSL Encrypted Payment" class="checkout-badges__ssl" src="<?php echo get_template_directory_uri(); ?>/images/checkout-badges/ssl.svg" />
						</div>
						<div>
							<img title="Norton Secured Transaction" class="checkout-badges__norton" src="<?php echo get_template_directory_uri(); ?>/images/checkout-badges/norton-secured.svg" />
						</div>
						<div>
							<img title="McAfee Secured Transaction" class="checkout-badges__mcafee" src="<?php echo get_template_directory_uri(); ?>/images/checkout-badges/mcafee.svg" />
						</div>
					</div><!-- row -->

					<div class="clear"></div>

					<div class="cpo-testimonial">

						<div class="cpo-testimonial-content">
							<div class="cpo-testimonial-stars"></div>
							We have been thrilled to add the CPOThemes collection to our library. Each theme is beautiful, unique and has lots of great features that our clients love. The ability to easily create portfolios, team pages, services, sliders and so much more means we can create super-high quality sites faster than ever.
						</div>
						<div class="cpo-testimonial-author">
							<img src="https://staging-cpothemes.kinsta.cloud/wp-content/uploads/2015/01/wesley-jordan.jpg" class="cpo-testimonial-image">
							<div class="cpo-testimonial-author-meta">
								<div class="cpo-testimonial-author-name">Wesley Jordan</div>
								<div class="cpo-testimonial-author-position">Wealthbridge Marketing</div>
							</div>
						</div>
					</div>

				</div><!-- column -->

				<div class="column checkout-page-second-col">

					<div id="edd_checkout_form_wrap" class="edd_clearfix">
						<?php do_action('edd_before_purchase_form'); ?>
						<form id="edd_purchase_form" class="edd_form" action="<?php echo $form_action; ?>" method="POST">
							<?php
                            /**
                             * Hooks in at the top of the checkout form
                             *
                             * @since 1.0
                             */
                            do_action('edd_checkout_form_top');

                            if (edd_is_ajax_disabled() && ! empty($_REQUEST['payment-mode'])) {
                                do_action('edd_purchase_form');
                            } elseif (edd_show_gateways()) {
                                do_action('edd_payment_mode_select');
                            } else {
                                do_action('edd_purchase_form');
                            }

                            /**
                             * Hooks in at the bottom of the checkout form
                             *
                             * @since 1.0
                             */
                            do_action('edd_checkout_form_bottom');


                            ?>
						</form>
						<?php do_action('edd_after_purchase_form'); ?>
					</div><!--end #edd_checkout_form_wrap-->

				</div><!-- column -->

			</div><!-- row -->

		</div><!-- container -->

	<?php else: ?>

		<div class="container">
			<div class="row">
				<div class="column col1 checkout-page-title">
					<h1 class="text-center">Your cart is empty</h1>
				</div>
			</div><!-- row -->
		</div>

	<?php endif; ?>

</div>

<?php wp_footer(); ?>
