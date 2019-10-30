<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>

    <div class="homepage-header">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="homepage-header-background"
                 style="background-image:url( <?php the_post_thumbnail_url( 'full' ); ?> )"></div>
		<?php } ?>
        <div class="container">
            <h1>Find your next business WordPress theme here</h1>
            <p>We specialize in creating some of the Best Business WordPress Themes on the market. Subscribe and get access to our entire collection.</p>
            <a href="/pricing" class="green-button">See Pricing And Plans</a>
        </div>
    </div>

    <div class="homepage-sections sidebar-none">


        <section id="homepage-themes" class="homepage-section">
            <section id="pagetitle" class="pagetitle">
                <div class="container">
                    <h2 class="pagetitle-title heading">Latest themes</h2>
                    <div class="pagetitle-subtitle">
                        Get the entire theme collection for a single purchase.
                    </div>
                </div>
            </section>
            <div class="container">
				<?php $feature_posts = new WP_Query( 'post_type=cpo_theme&posts_per_page=6' ); ?>
				<?php if ( $feature_posts->post_count > 0 ): $feature_count = 0; ?>
                    <div id="themes" class="themes cpo-row">
						<?php while ( $feature_posts->have_posts() ): $feature_posts->the_post(); ?>
							<?php if ( $feature_count % 3 == 0 && $feature_count != 0 ) {
								echo '<div class="col-divide"></div>';
							}
							$feature_count ++; ?>
                            <div class="column col3<?php if ( $feature_count % 3 == 0 ) {
								echo ' col-last';
							} ?>">
								<?php get_template_part( 'element', 'theme' ); ?>
                            </div>
							<?php if ( $feature_count % 9 == 0 && $feature_count != 0 && $feature_count < $feature_posts->post_count ) {
								get_template_part( 'element', 'ad' );
							} ?>
						<?php endwhile; ?>
                        <div class='clear'></div>
                    </div>
				<?php endif; ?>
                <div class="text-center">
                    <a href="/themes/" class="green-button">Browse Theme Collection</a>
                </div>
            </div>
        </section>

        <section class="white-section homepage-section content" id="homepage-testimonials">
            <div class="pagetitle">
                <h2 class="pagetitle-title heading">What People Say About Us</h2>
                <div class="pagetitle-subtitle">
                    Over 10000 theme downloads in more than 30 countries.
                </div>
            </div>
            <div class="container">
                <div class="row cpo-row">
                    <div class="col2 column">
                        <div class="cpo-testimonial">
                            <div class="cpo-testimonial-content">
                                We have been thrilled to add the CPOThemes collection to our library. Each theme is
                                beautiful, unique and has lots of great features that our clients love. The ability to
                                easily create portfolios, team pages, services, sliders and so much more means we can
                                create super-high quality sites faster than ever.
                            </div>
                            <div class="cpo-testimonial-author">
                                <img src="<?php echo wp_get_attachment_url( '48054' ) ?>" class="cpo-testimonial-image">
                                <div class="cpo-testimonial-author-meta">
                                    <div class="cpo-testimonial-author-name">Wesley Jordan</div>
                                    <div class="cpo-testimonial-author-position">Wealthbridge Marketing</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col2 column">
                        <div class="cpo-testimonial">
                            <div class="cpo-testimonial-content">
                                I have used CPOThemes now for two client projects and have found their themes to be easy
                                to use and customize. The documentation is extensive and support is excellent. If you
                                are looking for easy themes to use for your websites, then why not try out CPOThemes.
                                I’m very happy that I gave them a go.
                            </div>
                            <div class="cpo-testimonial-author">
                                <img src="<?php echo wp_get_attachment_url( '48052' ) ?>" class="cpo-testimonial-image">
                                <div class="cpo-testimonial-author-meta">
                                    <div class="cpo-testimonial-author-name">David Tiong</div>
                                    <div class="cpo-testimonial-author-position">David Tiong Web Consultancy</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="homepage-features" class="white-section homepage-section content">
            <div class="pagetitle">
                <h2 class="pagetitle-title heading">Premium-Grade Features</h2>
                <div class="pagetitle-subtitle">
                    Swiftly create any kind of website with ease.
                </div>
            </div>
            <div class="container">
                <div class="row cpo-row">
                    <div class="col2 column">
                        <div class="cpo-block">
                            <div class="cpo-feature cpo-feature-has-icon">
                                <div class="cpo-feature-icon">
                                    <span style="font-family:'linearicons'"></span>
                                </div>
                                <div class="cpo-feature-body">
                                    <h4 class="cpo-feature-title">Perfected, Responsive Design</h4>
                                    <div class="cpo-feature-content">Build a professional-looking website by using a
                                        modern design that promotes trust. Make your content shine in every device out
                                        there thanks to responsive design.
                                    </div>
                                </div>
                            </div>
                            <div class="cpo-clear"></div>
                        </div>
                        <div class="cpo-block">
                            <div class="cpo-feature cpo-feature-has-icon">
                                <div class="cpo-feature-icon">
                                    <span style="font-family:'linearicons'"></span>
                                </div>
                                <div class="cpo-feature-body">
                                    <h4 class="cpo-feature-title">Lightning-Fast Install &amp; Updates</h4>
                                    <div class="cpo-feature-content">Install your theme quickly and seamlessly, and get
                                        new features and updates on the fly with a single click. We continuously improve
                                        our themes and enhance them.
                                    </div>
                                </div>
                            </div>
                            <div class="cpo-clear"></div>
                        </div>
                        <div class="cpo-block">
                            <div class="cpo-feature cpo-feature-has-icon">
                                <div class="cpo-feature-icon">
                                    <span style="font-family:'linearicons'"></span>
                                </div>
                                <div class="cpo-feature-body">
                                    <h4 class="cpo-feature-title">Smart Content Management</h4>
                                    <div class="cpo-feature-content">Build your site in a matter of minutes thanks to
                                        the theme handling all the hard work for you. Focus on creating great content
                                        and forget the fight with layout options.
                                    </div>
                                </div>
                            </div>
                            <div class="cpo-clear"></div>
                        </div>
                    </div>
                    <div class="col2 column">
                        <div class="cpo-block">
                            <div class="cpo-feature cpo-feature-has-icon">
                                <div class="cpo-feature-icon">
                                    <span style="font-family:'linearicons'"></span>
                                </div>
                                <div class="cpo-feature-body">
                                    <h4 class="cpo-feature-title">User Friendly Behavior</h4>
                                    <div class="cpo-feature-content">Forget about getting locked-in to using the same
                                        WordPress theme forever. Enjoy using powerful functionality that respects the
                                        end user without barriers.
                                    </div>
                                </div>
                            </div>
                            <div class="cpo-clear"></div>
                        </div>
                        <div class="cpo-block">
                            <div class="cpo-feature cpo-feature-has-icon">
                                <div class="cpo-feature-icon">
                                    <span style="font-family:'linearicons'"></span>
                                </div>
                                <div class="cpo-feature-body">
                                    <h4 class="cpo-feature-title">Deep Plugin Integration</h4>
                                    <div class="cpo-feature-content">Install your favorite plugins and let the theme
                                        speak directly to them, saving hours of work integrating their functionality
                                        into your website. The days of lock-in are over.
                                    </div>
                                </div>
                            </div>
                            <div class="cpo-clear"></div>
                        </div>
                        <div class="cpo-block">
                            <div class="cpo-feature cpo-feature-has-icon">
                                <div class="cpo-feature-icon">
                                    <span style="font-family:'linearicons'"></span>
                                </div>
                                <div class="cpo-feature-body">
                                    <h4 class="cpo-feature-title">Extensive, Caring Support</h4>
                                    <div class="cpo-feature-content">Browse through the detailed knowledge base to get
                                        answers to just about any question, and get in touch directly with us to get
                                        your theme up and running in no time.
                                    </div>
                                </div>
                            </div>
                            <div class="cpo-clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>


<?php get_footer(); ?>