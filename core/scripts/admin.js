jQuery(document).ready(function(){
    
	/* SETTINGS MENU TABS */
	/* Menu Transitions */
	jQuery('.cpothemes-menu-item').click(function(event){
		var current_id = event.target.id;
		if(!jQuery('#' + current_id).hasClass('active')){
			jQuery('.cpothemes-block').fadeOut(300);
    		jQuery('#' + current_id + '_block').delay(500).fadeIn(300);
			jQuery('.cpothemes-menu-item').removeClass('active');
			jQuery('#' + current_id).addClass('active');
		}		
    });
	/* Memorize Current Tab on Saves */
	jQuery('.cpothemes-menu-item').click(function(event){
		var current_id = jQuery(this).attr('id');
		jQuery('#cpotheme_custom_tab').val(current_id);
    });
	/* Save Settings */
	jQuery('.cpothemes-submit').click(function(event){
		jQuery('.cpothemes-submit').val('...');
    });
	
	
	/* COLOR PICKER FIELD */
	jQuery('.color').each(function(){
		current_object = jQuery(this);
		current_object.wpColorPicker({ defaultColor: current_object.val() });
	});
	
	
	/* DATE PICKER FIELD */
	jQuery('.cpothemes-dateselector').each(function(){
		jQuery(this).datepicker({dateFormat: 'yy-mm-dd'});
	});
	
	
	/* UPLOAD FIELD */
	// When the Button is clicked...
    jQuery('.upload_button').click(function() {
        var text = jQuery(this).siblings('.upload_field');
 
        tb_show('Upload Image', 'media-upload.php?referer=cpotheme_settings&type=image&TB_iframe=true&post_id=0', false);
 
        window.send_to_editor = function(html){
            var src = jQuery('img', html).attr('src');
            text.attr('value', src).trigger('change');
            tb_remove();
        }
        return false;
    } );
	//Change image preview for the upload field
	jQuery('.upload_field').bind('change', function(){
		var url = this.value;
		var preview = jQuery(this).siblings('.upload_preview');
		jQuery(preview).attr('src', url);
	} );

	
	/* FONT FIELD */
	//Change text preview for the font field
	jQuery('.font_field').on('ready keyup change', function(event){ 
		var font = this.value;
		var font_file = jQuery(this).siblings('.font_file');
		var font_preview = jQuery(this).siblings('.font_preview');
		var font_name = font.split("+").join(" ");
		jQuery(font_file).html("<link href='//fonts.googleapis.com/css?family=" + font + "' rel='stylesheet' type='text/css'>");
		
		var font_weight = '400';
		if(font_name.indexOf(':100') > -1) font_weight = '100';
		if(font_name.indexOf(':300') > -1) font_weight = '300';
		if(font_name.indexOf(':700') > -1) font_weight = '700';
		
		font_name = font_name.replace(':100', '');
		font_name = font_name.replace(':300', '');
		font_name = font_name.replace(':700', '');
		jQuery(font_preview).css('font-family', '\'' + font_name + '\'');
		jQuery(font_preview).css('font-weight', font_weight);
	});

	
	/* IMAGE LIST FIELD */
	//Change border color when selecting the image
    jQuery('.form_image_list_item img').click(function() {
        
        //Change other borders
        var parent = jQuery(this).parent().parent();
        jQuery(parent).find('img').each(function() {
            jQuery(this).removeClass('selected');
        });
        
        //Selected image
        jQuery(this).addClass('selected');        
    });
	
	
	/* IMAGE LIST FIELD */
	//Change border color when selecting the image
    jQuery('.cpotheme-iconlist label').click(function() {
        
        //Change other borders
        var parent = jQuery(this).parent().parent();
        jQuery(parent).find('label').each(function() {
            jQuery(this).removeClass('selected');
        });
        
        //Selected image
        jQuery(this).addClass('selected');        
    });
	
	
    //Add row in collection field
	jQuery('body').on('click', '.collection-add-row', function(e) {
		e.preventDefault();
		var current_element = jQuery(this);
		var row = current_element.parent().parent().prev('tr');
		var new_row = collection_add_row(row);
		new_row.insertAfter(row);
	});
	
	//Remove row in collection field
	jQuery('body').on('click', '.collection-remove-row', function(e) {
		e.preventDefault();

		var row = jQuery(this).parent().parent('tr');
		var count = row.parent().find('tr').length - 1;
		var type  = jQuery(this).data('type');
		
		//Always leave at least one row
		if( count > 1 ) {
			jQuery('input, select', row).val('');
			row.remove();
		}

		//Reorder rows
		jQuery('.collection-row').each(function(rowIndex){
			jQuery(this).find('input, select').each(function(){
				var name = jQuery( this ).attr('name');
				name = name.replace(/\[(\d+)\]/, '[' + rowIndex + ']');
				jQuery(this).attr('name', name ).attr('id', name);
			});
		});
	});
	
	
	//COLLECTION FIELD IN CUSTOMIZER
	//Add row in collection field
	jQuery('body').on('click', '.cpotheme-collection-add', function(e) {
		e.preventDefault();
		var current_element = jQuery(this);
		var row = current_element.parent().prev('.cpotheme-collection-row');
		var new_row = cpotheme_collection_add(row);
		new_row.insertAfter(row);
	});
	
	//Remove row in collection field
	jQuery('body').on('click', '.cpotheme-collection-remove', function(e) {
		e.preventDefault();

		var row = jQuery(this).parent('.cpotheme-collection-row');
		var count = row.parent().find('.cpotheme-collection-row').length;
		
		//Always leave at least one row
		if(count > 1){
			jQuery('input, select', row).val('');
			row.remove();
		}

		//Reorder rows
		jQuery('.cpotheme-collection-row').each(function(rowIndex){
			jQuery(this).find('input, select').each(function(){
				var name = jQuery( this ).attr('name');
				name = name.replace(/\[(\d+)\]/, '[' + rowIndex + ']');
				jQuery(this).attr('name', name ).attr('id', name);
			});
		});
	});
	
	
});


function collection_add_row(row){
	// Retrieve the highest current field index
	var key = highest = 1;
	row.parent().find('tr.collection-row').each(function(){
		var current = jQuery(this).data('index');
		if(parseInt(current) > highest){
			highest = current;
		}
	});
	key = highest += 1;
	
	new_row = row.clone();
	new_row.find('td input').val('');
	
	//Update index and names of new row
	new_row.data('index', key);
	new_row.find('input, select, textarea').each(function() {
		var new_name = jQuery(this).attr('name');
		new_name = new_name.replace(/\[(\d+)\]/, '[' + parseInt( key ) + ']');
		jQuery(this).attr('name', new_name).attr('id', new_name);
	});
	
	return new_row;
}


function cpotheme_collection_add(row){
	// Retrieve the highest current field index
	var key = highest = 1;
	row.parent().find('.cpotheme-collection-row').each(function(){
		var current = jQuery(this).data('index');
		if(parseInt(current) > highest){
			highest = current;
		}
	});
	key = highest += 1;
	
	new_row = row.clone();
	new_row.find('.cpotheme-collection-cell input').val('');
	
	//Update index and names of new row
	new_row.data('index', key);
	new_row.find('input, select, textarea').each(function() {
		var new_name = jQuery(this).attr('name');
		new_name = new_name.replace(/\[(\d+)\]/, '[' + parseInt( key ) + ']');
		jQuery(this).attr('name', new_name).attr('id', new_name);
	});
	
	return new_row;
}
