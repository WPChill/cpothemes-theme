<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom layout control
 */
class CPO_Customize_Imagelist_Control extends WP_Customize_Control {
	
	public function render_content(){
		if(empty($this->choices)) return; 
		$name = $this->id;
		$value = $this->value(); ?>
		
		<?php if(!empty($this->label)): ?>
		<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		<?php endif; ?>
		
		<?php if(!empty($this->description)): ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; 
		$output = '';
		$output = '<div id="cpotheme-imagelist">';
		foreach($this->choices as $list_key => $list_value){
			$selected = '';
			if($list_key == $value) $selected = ' class="cpotheme-imagelist-selected"';
			$output .= '<label class="cpotheme-imagelist-item" for="'.esc_attr($name).'_'.$list_key.'">';
			$output .= '<img '.$selected.' src="'.$list_value.'"/><br/>';
			$output .= '<input type="radio" '.$this->get_link().' name="'.esc_attr($name).'" id="'.esc_attr($name).'_'.$list_key.'" value="'.esc_attr($list_key).'" '.checked($value, $list_value).'/>';        
			$output .= '</label>';        
		}
		$output .= '</div>';
		echo $output;
	}
}


class CPO_Customize_Collection_Control extends WP_Customize_Control {
	
	public function render_content(){
		if(empty($this->choices)) return; 
		$name = $this->id;
		$value = $this->value(); ?>
		
		<?php if(!empty($this->label)): ?>
		<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		<?php endif; ?>
		
		<?php if(!empty($this->description)): ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; 
		
		
		//Table contents
		$counter = -1;
		$output = '<div class="cpotheme-collection" id="cpotheme-collection">';
		foreach($value as $current_key => $current_value){
			$counter++;
			$output .= '<div class="cpotheme-collection-row" data-index="'.$current_key.'">';
			foreach($this->choices as $list_key => $list_value){
				
				//Save field data-- collections can be of any field type
				$field_name = '['.$current_key.']['.$list_key.']';
				$field_type = isset($list_value['type']) ? $list_value['type'] : 'text';
				$field_width = isset($list_value['width']) ? $list_value['width'] : '100';
				$field_args = isset($list_value['args']) ? $list_value['args'] : null;
				$field_options = isset($list_value['option']) ? $list_value['option'] : null;
				$field_value = isset($current_value[$list_key]) ? $current_value[$list_key] : '';
				$output .= '<div class="cpotheme-collection-cell" style="width:'.$field_width.'%;">';
				
				//Display corresponding type of field
				if($field_type == 'text'){
					if(isset($field_args['placeholder'])) $field_placeholder = ' placeholder="'.$field_args['placeholder'].'"'; else $field_placeholder = '';
					$output .= '<input type="text" data-customize-setting-link="'.esc_attr($this->settings['default']->id).$field_name.'" value="'.$field_value.'" name="'.$field_name.'" id="'.$field_name.'"'.$field_placeholder.'/>';
					
				}elseif($field_type == 'select'){
					$field_class = (isset($field_args['class']) ? $field_args['class'] : '');
					$output .= '<select data-customize-setting-link="'.esc_attr($this->settings['default']->id).$field_name.'" class="cpometabox_field_select '.$field_class.'" name="'.$field_name.'" id="'.$field_name.'">';
					if(sizeof($field_options) > 0)
						foreach($field_options as $options_key => $options_value){
							$output .= '<option value="'.$options_key.'" '.selected($field_value, $options_key, false).'>'.$options_value.'</option>';
						}
					$output .= '</select>';
				}
				$output .= '</div>';
			}
			$output .= '<a href="#" tabindex="-1" class="cpotheme-collection-remove">'.__('Remove', 'cpotheme').'</a>';
			$output .= '</div>';
		}
		$output .= '<div>';
		$output .= '<a href="#" class="button cpotheme-collection-add">'.__('Add Row', 'cpotheme').'</a>';
		$output .= '</div>';		
		$output .= '</div>';
		echo $output;
	}
}


/**
 * Class to create a custom layout control
 */
class CPO_Customize_Sortable_Control extends WP_Customize_Control {
	
	public function render_content(){
		if(empty($this->choices)) return; 
		$name = $this->id;
		$field_list = explode(',', $this->value());
		$remaining_fields = $this->choices;
		?>
		
		<?php if(!empty($this->label)): ?>
		<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		<?php endif; ?>
		
		<?php if(!empty($this->description)): ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif;
		
		$output = '';
		$output .= '<input type="hidden" class="cpotheme-sortable-value" '.$this->get_link().' name="'.esc_attr($name).'" id="'.esc_attr($name).'" value="'.$this->value().'"/>';        
		$output .= '<div class="cpotheme-sortable">';
		$count = 100;
		foreach($field_list as $current_element){
			foreach($this->choices as $list_key => $list_value){
				if($current_element != '' && $current_element == $list_key){
					$output .= '<div data-key="'.esc_attr($list_key).'" class="cpotheme-sortable-item" for="'.esc_attr($name).'_'.$list_key.'">';
					$output .= '<div class="cpotheme-sortable-field">'.$count.'</div>';        
					$output .= '<div class="cpotheme-sortable-name">'.$list_value.'</div>';
					$output .= '</div>';
					$count += 100;
					unset($remaining_fields[$list_key]);
				}
			}
		}
		//Add remaining fields to ensure list is complete
		foreach($remaining_fields as $list_key => $list_value){
			$output .= '<div data-key="'.esc_attr($list_key).'" class="cpotheme-sortable-item" for="'.esc_attr($name).'_'.$list_key.'">';
			$output .= '<div class="cpotheme-sortable-field">'.$count.'</div>';        
			$output .= '<div class="cpotheme-sortable-name">'.$list_value.'</div>';
			$output .= '</div>';
			$count += 100;
		}
		
		$output .= '</div>';
		echo $output;
	}
}