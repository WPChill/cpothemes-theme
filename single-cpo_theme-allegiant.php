<?php get_header(); ?>

<?php wp_enqueue_style('dashicons'); ?>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();

        $post_id = get_the_ID();
        $download_id = get_post_meta($post_id, 'download_product', true);
        $extended_id = 167536;
        $subscribe_id = 26846;
        cpotheme_eddeet_detail($download_id);
        $external_url = get_post_meta(get_the_ID(), 'download_url', true);
        $theme = get_the_title();

        $pro_link = get_permalink($edd_options['purchase_page']);
        $pro_link .= '?edd_action=add_to_cart&download_id=' . get_post_meta($post_id, 'download_product', true);

        $pro_price = edd_format_amount(edd_get_download_price($download_id), 0);


        wp_enqueue_style('cpotheme-fontawesome');
        ?>
        <header class="theme-lp-header cpo_theme"
                style="background-image:url('https://cpothemes.com/wp-content/uploads/allegiant-background-1.jpg')">
            <section id="pagetitle" class="pagetitle">
                <div class="container">
                    <span class="pagetitle-title heading"><?php the_title(); ?></span>
                    <h1 class="pagetitle-subtitle"><?php echo get_post_meta(get_the_ID(), 'download_title', true); ?></h1>
                </div>
            </section>

            <section class="theme-lp-content">
                <div class="row">
                    <div class="first-col">
                        <?php the_content(); ?>
                        <div class="theme-details">
                            <div class="theme-field">
                                <b><?php _e('Last Updated', 'cpotheme'); ?></b>: <?php _e('Last Month', 'cpotheme'); ?>
                            </div>
                            <div class="theme-field">
                                <b><?php _e('Requires', 'cpotheme'); ?></b>: WordPress 4.0+
                            </div>
                        </div>
                        <div class="cpo-theme-buttons v2">
                            <?php if ($external_url != ''): ?>
                                <a class="button button-download macho-event-targeting" data-eventcategory="click-free-download" data-eventaction="<?php the_title() ?>" data-eventlabel="cpothemes" id="button-download" target="_blank" rel="nofollow"
                                   href="<?php echo esc_url($external_url); ?>">
                                    <?php _e('Download LITE version', 'cpotheme'); ?>
                                </a>
                            <?php endif; ?>

                            <a href="#purchase" class="button button-buy smooth-scroll">Buy Now!</a>
                            <a class="button button-center button-large button-try macho-event-targeting" data-eventcategory="click-view-demo" data-eventaction="<?php the_title() ?>" data-eventlabel="cpothemes" id="button-try" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>">
                                <?php _e('See live version', 'cpotheme'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="second-col">
                        <div class="theme-thumbnail">
                            <?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array(
                                1500,
                                7000
                            ), false, ''); ?>
                            <?php $smartphone_url = get_post_meta($post_id, 'download_smartphone', true); ?>
                            <a href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>"
                               target="_blank" id="theme-desktop" class="theme-desktop">
                                <div class="theme-desktop-image"
                                     style="background-image:url(<?php echo $image_url[0]; ?>);"></div>
                                <div class="theme-desktop-content">
                                    <?php _e('View Theme Demo', 'cpotheme'); ?>
                                    <span><?php _e('See What It Can Do', 'cpotheme'); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </header>

        <section class="theme-lp-cta">
            <h2><?php echo esc_html(get_post_meta(get_the_ID(), 'download_cta_title', true)); ?></h2>
            <p><?php echo wp_kses_post(get_post_meta(get_the_ID(), 'download_cta_text', true)); ?></p>
        </section>
        <?php
    endwhile;
endif;

?>
    <section id="corefeatures" class="corefeatures section theme-lp-corefeatures">
        <div class="container">
            <h2 class="section-heading"><?php _e('Core Features', 'cpotheme'); ?></h2>
            <div class="section-subheading"><?php _e('All our themes come loaded with these helpful features.', 'cpotheme'); ?></div>
            <div class="row sigma-vcenter">
                <div class="column col2">
                    <img src="https://cpothemes.com/wp-content/uploads/feature-responsive.png"/>
                </div>
                <div class="column col2">
                    <h2>Responsive Design</h2>
                    <p>Allegiant’s responsive design ensures that no matter what device your visitors are using, your
                        site always looks great.</p>

                    <p>The way people access the Internet is changing - it’s essential that your site looks just as good
                        on a smartphone as a laptop. Allegiant makes that happen.</p>

                </div>
            </div>
            <div class="row sigma-vcenter">
                <div class="column col2">
                    <h2>WooCommerce Support</h2>
                    <p>Create your own online store thanks to the power of <strong>WooCommerce</strong>, the most
                        popular WordPress plugin for ecommerce. Any premium theme you use will automatically accommodate
                        your store pages, and integrate with its features so you can start selling right away.</p>
                    <p>Our themes also provide support for its digital products counterpart, the <strong>Easy Digital
                            Downloads</strong> plugin.</p>
                </div>
                <div class="column col2">
                    <img src="https://cpothemes.com/wp-content/uploads/feature-woocommerce.png"/>
                </div>

            </div>
            <div class="row sigma-vcenter">
                <div class="column col2">
                    <img src="https://cpothemes.com/wp-content/uploads/feature-layout.png"/>
                </div>
                <div class="column col2">
                    <h2>Complete Layout Control</h2>
                    <p>Every page and post in the theme is designed to have its own custom layout if needed! Select from
                        up to five different sidebar layouts, minimize or remove the header and footer, and create a
                        custom tailored experience for each of your pages.</p>
                    <p>This also applies to custom post types added by plugins, so you have complete control.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="theme-lp-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Join Our Community</h3>
                    <p>When you become part of the Macho Themes community, you’re joining over 1,653,274 users who
                        already trust us with their business. <span class="text-underline">We’re so confident you’ll love your purchase that we offer a 30-day money back guarantee</span>.
                    </p>
                    <a href="#purchase" class="button smooth-scroll">Buy Pro!</a>
                </div>
            </div>
        </div>
    </div>

    <section class="theme-lp-section">
        <div class="container">
            <h2 class="section-heading"><?php _e('About', 'cpotheme'); ?></h2>
            <div class="section-subheading">
                <?php _e('Learn more about Allegiant', 'cpotheme');
                echo get_the_title(); ?>
            </div>
            <div class="post-content">
                <p>While Allegiant is a multipurpose WordPress theme, the design is especially suited as a business
                    theme for agencies and other companies. Helpful features like portfolios, testimonials, and team
                    member sections make it easy to promote your services to potential clients in a stylish one-page
                    design.</p>

                <p>Beyond that, pre-built demo content helps you quickly make your site look just like our demo. And
                    built-in localization support makes it easy to translate any site that you build with Allegiant into
                    your local language.</p>

                <p>You can also easily create styled content with dedicated shortcodes that let you quickly add buttons,
                    accordions, feature lists, pricing tables, and lots more.</p>

                <p>Finally, Allegiant's responsive design ensures your website always looks pixel-perfect, no matter
                    what devices your visitors are using.</p>

                <br/><br/>
            </div>
        </div>
    </section>

    <section class="theme-lp-section theme-lp-section-upgrade">
        <div class="container">
            <h2 class="section-heading"><?php _e('Upgrade', 'cpotheme'); ?></h2>
            <div class="section-subheading"><?php _e('Here’s what you get with Allegiant Pro.', 'cpotheme'); ?></div>

            <div class="difference-table-wrapper">
                <table class="difference-table">
                    <thead class="text-center">
                    <tr>
                        <th></th>
                        <th class="second-th"><?php echo esc_html(get_the_title()); ?></th>
                        <th class="third-th"><?php echo esc_html(get_the_title()); ?> <span class="badge">PRO</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Slider controls</td>
                        <td class="second-td text-center">limited</td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>WooCommerce support</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Section reordering</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Custom colors</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Typography controls</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Tagline</td>
                        <td class="second-td text-center">limited</td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Features section</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Portfolio section</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Services section</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Team section</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Testimonials section</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Clients section</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Dedicated support</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center"><i class="dashicons dashicons-yes"></i></td>
                    </tr>
                    <tr>
                        <td>Security updates & feature releases</td>
                        <td class="second-td text-center"><i class="dashicons dashicons-no-alt"></i></td>
                        <td class="third-td text-center cta-td">
                            <i class="dashicons dashicons-yes"></i> <span class="theme-lp-pricing-button">
								<a href="#purchase" class="smooth-scroll"><span class="dashicons dashicons-cart"></span> Buy Pro </a>
							</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="theme-lp-section">
        <div class="container">
            <h2 class="section-heading"><?php _e('As featured on', 'cpotheme'); ?></h2>
			<ul class="theme-lp-image-list">
				<li>
					<img src="https://cpothemes.com/wp-content/uploads/adobe.png">
				</li>
				<li>
					<img src="https://cpothemes.com/wp-content/uploads/smashingmagazine.png">
				</li>
				<li>
					<img src="https://cpothemes.com/wp-content/uploads/wptavern.png">
				</li>
				<li>
					<img src="https://cpothemes.com/wp-content/uploads/wpbeginner.png">
				</li>
				<li>
					<a target="_blank" rel="nofollow" href="https://colorlib.com"><img src="https://cpothemes.com/wp-content/uploads/colorlib.png"></a>
				</li>
			</ul>
        </div>
    </section>

    <div id="purchase" class="purchase allegiant-purchase-section">
        <div class="container">
            <div class="purchase-wrapper">
                <div class="row">
                    <div class="column-fit cpo-hide-column col4">
                        <div class="pricing-table-head"></div>
                        <div class="pricing-table-content">
                            <div class="purchase-advantages">
                                <ul>
                                    <li>
                                        <span><?php _e('Demo content install', 'cpotheme'); ?></span>
                                        <div class="sigma-pricing-feature-tooltip-container">
                                            <span class="icon-question-circle"></span>
                                            <span class="sigma-tooltip-contents">After installing the theme you can import the demo content and make your website look exactly like our live preview. The placeholder images are not included.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span><?php _e('Premium support', 'cpotheme'); ?></span>
                                        <div class="sigma-pricing-feature-tooltip-container">
                                            <span class="icon-question-circle"></span>
                                            <span class="sigma-tooltip-contents">If you need help just post a ticket and our tech guys will get back to you asap. We have a stellar support team ready to help you in no time.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span><?php _e('Theme updates', 'cpotheme'); ?></span>
                                        <div class="sigma-pricing-feature-tooltip-container">
                                            <span class="icon-question-circle"></span>
                                            <span class="sigma-tooltip-contents">We are constantly improving our themes making them compatible with the latest version of WordPress. You'll update your theme directly in your WP admin at a press of a button.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span><?php _e('Support & Updates', 'cpotheme'); ?></span>
                                        <div class="sigma-pricing-feature-tooltip-container">
                                            <span class="icon-question-circle"></span>
                                            <span class="sigma-tooltip-contents">SINGLE - The perfect choice for a personal purchase. You will get support and updates for a single website (domain).
                                        <br><br>EXTENDED - You will get support and updates for 3 websites.
                                        <br><br>SUBSCRIPTION - Perfect for developers, designers that have multiple clients. You'll get support and update for any of our themes on as many websites (domains) as you want.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span><?php _e('Access all themes', 'cpotheme'); ?></span>
                                        <div class="sigma-pricing-feature-tooltip-container">
                                            <span class="icon-question-circle"></span>
                                            <span class="sigma-tooltip-contents">SINGLE - You get instant access to the current WordPress theme plus all theme releases while you are a member.
                                            <br><br>EXTENDED - You get instant access to the current WordPress theme plus all theme releases while you are a member.
                                            <br><br>SUBSCRIPTION - You get instant access to all our current WordPress themes plus all theme releases for 1 year.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="princing-table-footer"></div>
                    </div>

                    <div class="column-fit pricing-column col4">
                        <div class="pricing-table-head">
                            <h3 class="purchase-title">Single Theme</h3>
                            <div class="purchase-price">
                              <span class="fsc-currency" data-fsc-order-currency=""></span>
                                <?php

                                $price = edd_get_download_price($download_id);
                                // echo '<span class="price">' . intval($price) . '</span>';
                                echo '<span class="price"><sup>$</sup>' . intval($price) . '</span>';

                                ?>
                            </div>
                        </div>
                        <div class="pricing-table-content">
                            <div class="purchase-content">
                                <ul>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Demo content install</span></li>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Premium support</span></li>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Theme updates</span></li>
                                    <li>Single website</li>
                                    <li><span class="icon-remove"></span><span class="cpo-show-mobile">Access all themes</span></li>
                                    <!-- <li><span class="icon-remove"></span></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="princing-table-footer">
                            <div class="purchase-button">
                                <?php if ($download_id != 0): ?>
                                    <?php

                                    echo '<div class="cpotheme-edd-shortcode">' . do_shortcode('[purchase_link id="' . $download_id . '" class="button button-medium button-purchase" text="Buy Now" style="text" price="0" direct="true"]') . '</div>';

                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="column-fit pricing-column col4">
                        <div class="pricing-table-head">
                            <h3 class="purchase-title">Extended</h3>
                            <div class="purchase-price">
                                <span class="fsc-currency" data-fsc-order-currency=""></span>
                                <?php

                                $price = edd_get_download_price($extended_id);
                                // echo '<span class="price">' . intval($price) . '</span>';
                                echo '<span class="price"><sup>$</sup>' . intval($price) . '</span>';

                                ?>
                            </div>
                        </div>
                        <div class="pricing-table-content">
                            <div class="purchase-content">
                                <ul>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Demo content install</span></li>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Premium support</span></li>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Theme updates</span></li>
                                    <li>3 websites</li>
                                    <li>For 1 year</li>
                                </ul>
                            </div>
                        </div>
                        <div class="princing-table-footer highlight">
                            <div class="purchase-button">
                                <?php if ($extended_id != 0): ?>
                                    <?php

                                    echo '<div class="cpotheme-edd-shortcode">' . do_shortcode('[purchase_link id="' . $extended_id . '" class="button button-medium button-purchase" text="Buy Now" style="text" price="0" direct="true"]') . '</div>';

                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="column-fit pricing-column col4">
                        <div class="pricing-table-head">
                            <h3 class="purchase-title">Subscription</h3>
                            <div class="purchase-price">
                                <span class="fsc-currency" data-fsc-order-currency=""></span>
                                <?php

                                $price = edd_get_download_price($subscribe_id);
                                echo '<span class="price"><sup>$</sup>' . intval($price) . '</span>';
                                // echo '<span class="price">' . intval($price) . '</span>';

                                ?>
                            </div>
                        </div>
                        <div class="pricing-table-content">
                            <div class="purchase-content">
                                <ul>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Demo content install</span></li>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Premium support</span></li>
                                    <li><span class="icon-check"></span><span class="cpo-show-mobile">Theme updates</span></li>
                                    <li>Unlimited websites</li>
                                    <li>For 1 year</li>
                                </ul>
                            </div>
                        </div>
                        <div class="princing-table-footer">
                            <div class="purchase-button">
                                <?php if ($subscribe_id != 0): ?>
                                    <?php

                                    echo '<div class="cpotheme-edd-shortcode">' . do_shortcode('[purchase_link id="' . $subscribe_id . '" class="button button-medium button-purchase" text="Buy Now" style="text" price="0" direct="true"]') . '</div>';

                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="clear"></div>
            </div>
        </div>

        <div class="container">
            <div class="row cpo-vcenter theme-lp-ssl-row">
                <div class="column-fit col3">
                    <img src="https://www.machothemes.com/wp-content/uploads/2017/03/sslencrypted.png"
                         style="width:144px;"/>
                </div>
                <div class="column-fit col3 text-center"></div>
                <div class="column-fit col3 text-right">
                    <img src="https://www.machothemes.com/wp-content/uploads/2017/03/payment-icons.png"/>
                </div>
            </div>
        </div>

    </div>
<?php get_footer('lp'); ?>