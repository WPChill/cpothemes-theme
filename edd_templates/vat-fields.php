<?php

    global $edd_options, $vat_fields;

    $show_self_cert = "none";
    $cart_total = edd_get_cart_total();

//	error_log("ip_country_code:  " . $vat_fields['ip_country_code']);
//	error_log("selected_country: " . $vat_fields['selected_country']);

    // Are any of the products digital?
    /* @var bool $download_is_digital */
    $download_is_digital = false;
    $cart = edd_get_cart_contents();
    foreach ($cart as $key => $item) {
        $download_is_digital = \lyquidity\edd_vat\vat_rules_type_to_use($item['id']) == VAT_RULE_TYPE_DIGITAL;
        if ($download_is_digital) {
            break;
        }
    }

    // If there's no VAT number
    // if (isset($edd_options['edd_vat_2015_rules']))
    if ($download_is_digital) {
        if (empty($vat_fields['vat_number']) || !$vat_fields['requires_vat']) {
            // error_log("{$vat_fields['ip_country_code']} / {$vat_fields['selected_country']}");
            if ($vat_fields['ip_country_code'] != $vat_fields['selected_country']) {
                $show_self_cert = "block";
            }
        }
    }

    if (!isset($edd_options['edd_vat_disable_ip_address_field'])) {
        //		$page = get_bloginfo('url') . "/wp-admin/admin-ajax.php?action=edd_vat_location_info&ip={$vat_fields['ip_address']}";
        $page = admin_url() . "admin-ajax.php?action=edd_vat_location_info&ip={$vat_fields['ip_address']}";
    }

//	error_log("ip_country_code:  " . $vat_fields['ip_country_code']);
//	error_log("selected_country: " . $vat_fields['selected_country']);
    ?>

<div id="edd_vat_info_show" style="<?php echo $vat_fields['ignore_style']; ?>">

	<div id="edd_vat_info" style="display: <?php echo $vat_fields['requires_vat'] ? "block" : "none"; ?>" >

		<p id="edd_show_vat_info" style="<?php echo $vat_fields['link_style']; ?>">
			<?php _e('You can exclude sales tax if your business has a registered tax number.', 'edd_vat'); ?>
			<a class="edd_vat_link" href="#"><?php _e('Click here to enter tax details.', 'edd_vat'); ?></a>
		</p>

		<fieldset id="edd_vat_fields" class="vat_info" style="<?php echo $vat_fields['fields_style']; ?>">

			<span><legend><?php _e('Tax', 'edd_vat'); ?></legend></span>

			<p id="edd-card-country-wrap">
				<label for="billing_country" class="edd-label">
					<?php _e('Billing Country', VAT_EDD_DOMAIN_NAME); ?>
					<?php if (edd_field_is_required('billing_country')) { ?>
						<span class="edd-required-indicator">*</span>
					<?php } ?>
				</label>
				<span class="edd-description"><?php _e('The country for your billing address.', VAT_EDD_DOMAIN_NAME); ?></span>
				<select name="billing_country" id="billing_country" data-nonce="<?php echo wp_create_nonce('edd-country-field-nonce'); ?>" class="billing_country edd-select<?php if (edd_field_is_required('billing_country')) {
        echo ' required';
    } ?>">
					<?php

                    $selected_country = apply_filters('get-country', '');
                    if (empty($selected_country)) {
                        $selected_country = edd_get_shop_country();
                    }

                    if ($logged_in && ! empty($user_address['country']) && '*' !== $user_address['country']) {
                        $selected_country = $user_address['country'];
                    }

                    $countries = edd_get_country_list();
                    foreach ($countries as $country_code => $country) {
                        echo '<option value="' . esc_attr($country_code) . '"' . selected($country_code, $selected_country, false) . '>' . $country . '</option>';
                    }
                    ?>
				</select>
			</p>
			
			<p id="edd-company-name-wrap">
				<label class="edd-label" for="vat-company">
					<?php _e('Company', 'edd_vat'); ?>
					<?php if (edd_field_is_required('edd_company')) { ?>
						<span class="edd-required-indicator">*</span>
					<?php } ?>
				</label>
				<span class="edd-description"><?php _e('Enter a company name if this is a business purchase.', 'edd_vat'); ?></span>
				<input class="edd-input" type="text" name="vat-company" id="vat-company" placeholder="<?php _e('Company', 'edd_vat'); ?>" value="<?php echo $vat_fields['company']; ?>"/>

				<input type="hidden" id="vat_company_name_original" name="vat_company_name_original" value="<?php echo $vat_fields['company']; ?>" />

			</p>

			<p>

				<label class="edd-label" for="edd-last">
					<?php _e('Tax number', 'edd_vat'); ?>
				</label>
				<span class="edd-description"><?php echo __('Enter your tax number including country identifier such as GB123456788', 'edd_vat'); ?></span>
				<input type="text" class="regular-text" id="vat-number" name="vat-number" placeholder="<?php _e('No tax number', 'edd_vat'); ?>" value="<?php echo $vat_fields['vat_number']; ?>" />

				<input type="button" id="vat_validate"	class="<?php echo apply_filters('edd_button_style', 'button vat-validate'); ?>" <?php echo $vat_fields['validate_button_css']; ?> value="<?php echo __("Validate Tax number", 'edd_vat'); ?>"/>
				<input type="button" id="vat_reset"		class="<?php echo apply_filters('edd_button_style', 'button vat-reset'); ?>" <?php echo $vat_fields['reset_button_css']; ?> value="<?php echo __("Reset", 'edd_vat'); ?>"/>

				<span><img src="<?php echo EDD_PLUGIN_URL; ?>assets/images/loading.gif" id="vat-loading" style="display:none; margin-left: 10px;"/></span>
				<span class="vat_number_validated" style="<?php echo $vat_fields['validated_text_css']; ?>"><?php echo __("Tax number validated", 'edd_vat'); ?></span>
				<span class="vat_number_not_validated" style="<?php echo $vat_fields['not_validated_text_css']; ?>"><?php echo __("Tax number not validated", 'edd_vat'); ?></span>
				<span class="vat_number_not_given" style="<?php echo $vat_fields['not_given_text_css']; ?>"><?php echo __("Tax number not given", 'edd_vat'); ?></span>
				<input type="hidden" id="vat_number_valid" name="vat_number_valid" value="<?php echo $vat_fields['valid'];?>" />
				<input type="hidden" id="vat_number_original" name="vat_number_original" value="<?php echo $vat_fields['vat_number'];?>" />
				<input type="hidden" id="vat_ignore" name="vat_ignore" value="<?php echo $vat_fields['requires_vat']? "0" : "1"; ?>" />
				<input type="hidden" name="_wp_nonce" value="<?php echo wp_create_nonce('validate_vat_number') ?>" />

			</p>

			<div class="vat-box vat-box-info">
				<div id="text"></div>
			</div>

			<div class="vat-box vat-box-error">
				<div style="float: right">
					<img id="close_box" src="<?php echo EDD_VAT_PLUGIN_URL; ?>assets/images/close.png" title="Close">
				</div>
				<div id="text"></div>
			</div>

		</fieldset>

	</div>
</div>

<div id="ip-address-country" value="<?php echo $vat_fields['ip_country_code']; ?>" style="display: <?php echo $show_self_cert; ?>;" >
<?php
    if ($cart_total) {
        ?>
		<p id="edd_show_vat_info" class="vat-self-cert" >
			<input type="checkbox" id="vat-self-cert" name="vat-self-cert">
				<?php _e('The country of your current location must be the same as the country of your billing location or you must confirm the billing address is your home country.', 'edd_vat'); ?>
			</input>
		</p>
<?php
    }
?>
</div>

<?php if (!isset($edd_options['edd_vat_disable_ip_address_field'])) { ?>
<div id="ip-address" >
	<p id="edd_show_vat_info" class="ip-address" >
		<span><?php echo __("Your IP address is:", 'edd_vat'); ?>&nbsp</span>
		<a href="<?php echo $page; ?>" class="ip_address_link"><?php echo $vat_fields['ip_address']; ?></a>
		<span>&nbsp<?php echo __("(Click for details)", 'edd_vat'); ?></span>
	</p>
</div>
<?php } ?>
