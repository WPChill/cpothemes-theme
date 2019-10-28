<?php
if(!function_exists('ctsc_shortcode_princing_table')){
	function ctsc_shortcode_princing_table($atts, $content = null){

		$atts = shortcode_atts(
		array(
			'download_id' => '',
			'extended_id' => '',
			'subscribe_id' => '',
		), $atts, 'cpo-pricing-table' );

		$html = '';

		if ( '' != $atts['extended_id'] && '' != $atts['subscribe_id'] && '' != $atts['download_id'] ) {

                  $price_download = edd_get_download_price( $atts['download_id'] );
                  $price_extended = edd_get_download_price( $atts['extended_id'] );
                  $price_subscribe = edd_get_download_price( $atts['subscribe_id'] );
			
			$html .= '<div class="purchase">';
			$html .= '<div class="purchase-wrapper">';
            $html .= '<div class="row">';
            $html .= '<div class="column-fit cpo-hide-column col4">';
            $html .= '<div class="pricing-table-head"></div>';
            $html .= '<div class="pricing-table-content">';
            $html .= '<div class="purchase-advantages">';
            $html .= '<ul>';
            $html .= '<li>';
            $html .= '<span>Demo content install</span>';
            $html .= '<div class="sigma-pricing-feature-tooltip-container">';
            $html .= '<span class="icon-question-circle"></span>';
            $html .= '<span class="sigma-tooltip-contents">After installing the theme you can import the demo content and make your website look exactly like our live preview. The placeholder images are not included.</span>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '<li>';
            $html .= '<span>Premium support</span>';
            $html .= '<div class="sigma-pricing-feature-tooltip-container">';
            $html .= '<span class="icon-question-circle"></span>';
            $html .= '<span class="sigma-tooltip-contents">If you need help just post a ticket and our tech guys will get back to you asap. We have a stellar support team ready to help you in no time.</span>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '<li>';
            $html .= '<span>Theme updates</span>';
            $html .= '<div class="sigma-pricing-feature-tooltip-container">';
            $html .= '<span class="icon-question-circle"></span>';
            $html .= '<span class="sigma-tooltip-contents">We are constantly improving our themes making them compatible with the latest version of WordPress. You\'ll update your theme directly in your WP admin at a press of a button.</span>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '<li>';
            $html .= '<span>Support & Updates</span>';
            $html .= '<div class="sigma-pricing-feature-tooltip-container">';
            $html .= '<span class="icon-question-circle"></span>';
            $html .= '<span class="sigma-tooltip-contents">SINGLE - The perfect choice for a personal purchase. You will get support and updates for a single website (domain).<br><br>EXTENDED - You will get support and updates for 3 websites.<br><br>SUBSCRIPTION - Perfect for developers, designers that have multiple clients. You\'ll get support and update for any of our themes on as many websites (domains) as you want.</span>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '<li>';
            $html .= '<span>Access all themes</span>';
            $html .= '<div class="sigma-pricing-feature-tooltip-container">';
            $html .= '<span class="icon-question-circle"></span>';
            $html .= '<span class="sigma-tooltip-contents">SINGLE - You get instant access to the current WordPress theme plus all theme releases while you are a member.<br><br>EXTENDED - You get instant access to the current WordPress theme plus all theme releases while you are a member.<br><br>SUBSCRIPTION - You get instant access to all our current WordPress themes plus all theme releases for 1 year.</span>';
            $html .= '</div>';
            $html .= '</li>';
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="princing-table-footer"></div>';
            $html .= '</div>';

            $html .= '<div class="column-fit pricing-column col4">';
            $html .= '<div class="pricing-table-head">';
            $html .= '<h3 class="purchase-title">Single Theme</h3>';
            $html .= '<div class="purchase-price">';
            $html .= '<span class="fsc-currency" data-fsc-order-currency=""></span>';
            $html .= '<span class="price"><sup>$</sup>' . intval($price_download) . '</span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="pricing-table-content">';
            $html .= '<div class="purchase-content">';
            $html .= '<ul>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Demo content install</span></li>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Premium support</span></li>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Theme updates</span></li>';
            $html .= '<li>Single website</li>';
            $html .= '<li><span class="icon-remove"></span><span class="cpo-show-mobile">Access all themes</span></li>';
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="princing-table-footer">';
            $html .= '<div class="purchase-button">';
            $html .= '<a class="button button-medium button-purchase" id="button-buy-footer" href="/themes"><span class="icon-shopping-cart"></span>Choose A Theme</a>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="column-fit pricing-column col4">';
            $html .= '<div class="pricing-table-head">';
            $html .= '<h3 class="purchase-title">Extended</h3>';
            $html .= '<div class="purchase-price">';
            $html .= '<span class="fsc-currency" data-fsc-order-currency=""></span>';
            $html .= '<span class="price"><sup>$</sup>' . intval($price_extended) . '</span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="pricing-table-content">';
            $html .= '<div class="purchase-content">';
            $html .= '<ul>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Demo content install</span></li>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Premium support</span></li>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Theme updates</span></li>';
            $html .= '<li>3 websites</li>';
            $html .= '<li>For 1 year</li>';
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="princing-table-footer highlight">';
            $html .= '<div class="purchase-button">';
            $html .= '<div class="cpotheme-edd-shortcode">' . do_shortcode('[purchase_link id="' . $atts['extended_id'] . '" class="button button-medium button-purchase" text="Buy Now" style="text" price="0" direct="true"]') . '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="column-fit pricing-column col4">';
            $html .= '<div class="pricing-table-head">';
            $html .= '<h3 class="purchase-title">Subscription</h3>';
            $html .= '<div class="purchase-price">';
            $html .= '<span class="fsc-currency" data-fsc-order-currency=""></span>';
            $html .= '<span class="price"><sup>$</sup>' . intval($price_subscribe) . '</span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="pricing-table-content">';
            $html .= '<div class="purchase-content">';
            $html .= '<ul>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Demo content install</span></li>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Premium support</span></li>';
            $html .= '<li><span class="icon-check"></span><span class="cpo-show-mobile">Theme updates</span></li>';
            $html .= '<li>Unlimited websites</li>';
            $html .= '<li>For 1 year</li>';
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="princing-table-footer">';
            $html .= '<div class="purchase-button">';
            $html .= '<div class="cpotheme-edd-shortcode">' . do_shortcode('[purchase_link id="' . $atts['subscribe_id'] . '" class="button button-medium button-purchase" text="Buy Now" style="text" price="0" direct="true"]') . '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
			$html .= '</div>';
            
            $html .= '<div class="clear"></div>';
            $html .= '</div>';
            $html .= '</div>';

		}

		return $html;

	}
	add_shortcode('cpo-pricing-table', 'ctsc_shortcode_princing_table');
}