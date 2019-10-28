<?php get_header(); ?>

<?php if(have_posts()) while(have_posts()) : the_post(); ?>

<?php
$post_id = get_the_ID();
$download_id = get_post_meta($post_id, 'download_product', true);
$extended_id = 167536;
$subscribe_id = 26846;
cpotheme_eddeet_detail($download_id);
$external_url = get_post_meta(get_the_ID(), 'download_url', true);
wp_enqueue_style('cpotheme-fontawesome');
?>

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

                    
                    <div class="cpo-theme-lite-buttons">
                        <?php if($external_url != ''): ?>
                        <a class="button button-center button-large button-download macho-event-targeting" data-eventcategory="click-free-download" data-eventaction="<?php the_title() ?>" data-eventlabel="cpothemes" id="button-download" target="_blank" rel="nofollow" href="<?php echo esc_url($external_url); ?>">
                            <?php _e('Download LITE version', 'cpotheme'); ?>
                        </a>
                        <?php endif; ?>
                        
                        <a class="button button-center button-large button-try macho-event-targeting" data-eventcategory="click-view-demo" data-eventaction="<?php the_title() ?>" data-eventlabel="cpothemes"  id="button-try" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>">
                            <?php _e('View Demo', 'cpotheme'); ?>
                        </a>
                    </div>

                    <div class="cpo-theme-buy-buttons">
                    <a href="#purchase" class="button button-center button-large button-buy smooth-scroll">Buy Now!</a>
                </div>

                <div class="theme-thumbnail">
                    <?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array(1500, 7000), false, ''); ?>
                    <?php $smartphone_url = get_post_meta($post_id, 'download_smartphone', true);  ?>
                    <a href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>" target="_blank" id="theme-desktop" class="theme-desktop">
                        <div class="theme-desktop-image" style="background-image:url(<?php echo $image_url[0]; ?>);"></div>
                        <div class="theme-desktop-content">
                            <?php _e('View Theme Demo', 'cpotheme'); ?>
                            <span><?php _e('See What It Can Do', 'cpotheme'); ?></span>
                        </div>
                    </a>
                    <?php if($smartphone_url != ''): ?>
                    <a href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>" target="_blank" id="theme-smartphone" class="theme-smartphone">
                        <div class="theme-smartphone-image" style="background-image:url(<?php echo $smartphone_url; ?>);"></div>
                    </a>
                    <?php endif; ?>
                </div>
                
                <div class="clear"></div>
                
                <div class="content theme-content">
                    <?php the_content(); ?>
                </div>
                
                <div class="sidebar theme-sidebar">     

                <?php if($external_url != ''): ?>
                        <a class="button button-center button-large button-download macho-event-targeting" data-eventcategory="click-free-download" data-eventaction="<?php the_title() ?>" data-eventlabel="cpothemes" id="button-download" target="_blank" rel="nofollow" href="<?php echo esc_url($external_url); ?>">
                            <?php _e('Download LITE version', 'cpotheme'); ?>
                        </a>
                        <?php endif; ?>
                        
                        <a class="button button-center button-large button-try macho-event-targeting" data-eventcategory="click-view-demo" data-eventaction="<?php the_title() ?>" data-eventlabel="cpothemes" id="button-try" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'download_demo_url', true); ?>">
                            <?php _e('View Demo', 'cpotheme'); ?>
                        </a>            
                        <a href="#purchase" class="button button-center button-large button-buy smooth-scroll">Buy Now!</a>
                    <div class="theme-details">
                        <div class="theme-field">
                            <b><?php _e('Released', 'cpotheme'); ?></b> <?php the_date(); ?>
                        </div>
                        <div class="theme-field">
                            <b><?php _e('Updated', 'cpotheme'); ?></b> <?php _e('Last Month', 'cpotheme'); ?>
                        </div>
                        <div class="theme-field">
                            <b><?php _e('Requires', 'cpotheme'); ?></b> WordPress 4.0+
                        </div>
                        <div class="theme-field">
                            <b><?php _e('Responsive Layout', 'cpotheme'); ?></b>
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


<?php if($download_id != 'all'): ?>
<div id="purchase" class="purchase">
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

                            $price = edd_get_download_price( $download_id );
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
                                <li>Single website</li>
                                <li><span class="icon-remove"></span><span class="cpo-show-mobile">Access all themes</span></li>
                                <!-- <li><span class="icon-remove"></span></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="princing-table-footer">
                        <div class="purchase-button">
                            <?php if( $download_id != 0 ): ?>
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

                            $price = edd_get_download_price( $extended_id );
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
                                <li>3 websites</li>
                                <li>For 1 year</li>
                            </ul>
                        </div>
                    </div>
                    <div class="princing-table-footer highlight">
                        <div class="purchase-button">
                            <?php if( $extended_id != 0 ): ?>
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

                            $price = edd_get_download_price( $subscribe_id );
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
                            <?php if( $subscribe_id != 0 ): ?>
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
</div>
<?php endif; ?>

<?php get_footer( 'lp' ); ?>