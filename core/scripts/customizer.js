jQuery(document).ready(function(){
    
	/* FONT FIELD */
	//Change text preview for the font field
	jQuery('.cpotheme-fontlist-field').on('ready keyup change', function(event){ 
		var font = this.value;
		var font_file = jQuery(this).siblings('.cpotheme-fontlist-file');
		var font_preview = jQuery(this).siblings('.cpotheme-fontlist-preview');
		var font_name = font.split("+").join(" ");
		jQuery(font_file).html("<link href='http://fonts.googleapis.com/css?family=" + font + "' rel='stylesheet' type='text/css'>");
		
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

	
	
	
});
