jQuery(document).ready(function(){
    
	jQuery('.cpotheme-sortable').sortable({
		axis: 'y',
		placeholder: 'cpotheme-sortable-placeholder',
		stop: function(){
			var fields = jQuery('.cpotheme-sortable-item');
			var number = fields.length;
			var result = '';
			jQuery('.cpotheme-sortable-item').each(function(index) {
				result += jQuery(this).data('key') + ',';
				jQuery(this).children('.cpotheme-sortable-field').html((index + 1) * 100);
			});
			jQuery('.cpotheme-sortable-value').val(result);
			jQuery('.cpotheme-sortable-value').trigger('change');
        }
    });
});