jQuery(document).ready(function() {

	var product_gallery_frame;
	var $image_gallery_ids = jQuery('#page_gallery');
	var $product_images = jQuery('#cpotheme-gallery ul.cpotheme-gallery-images');
	jQuery('.cpotheme-gallery-add').on('click', 'a', function(event){
		var $el = jQuery(this);
		var attachment_ids = $image_gallery_ids.val();

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if(product_gallery_frame){
			product_gallery_frame.open();
			return;
		}

		// Create the media frame.
		product_gallery_frame = wp.media.frames.product_gallery = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),
			button: {
				text: $el.data('update'),
			},
			states : [
				new wp.media.controller.Library({
					title: $el.data('choose'),
					filterable :	'all',
					multiple: true,
				})
			]
		});

		// When an image is selected, run a callback.
		product_gallery_frame.on('select', function(){

			var selection = product_gallery_frame.state().get('selection');

			selection.map(function(attachment){

				attachment = attachment.toJSON();

				if (attachment.id){
					attachment_ids   = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
					attachment_image = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

					$product_images.append('\
					<li class="image" data-attachment_id="' + attachment.id + '">\
						<img src="' + attachment_image + '" />\
						<a href="#" class="cpotheme-gallery-remove delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a>\
					</li>');
				}

			});

			$image_gallery_ids.val(attachment_ids);
		});

		// Finally, open the modal.
		product_gallery_frame.open();
	});

	// Image ordering
	$product_images.sortable({
		items: 'li.image',
		cursor: 'move',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		forceHelperSize: false,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'cpotheme-gallery-image-placeholder',
		start:function(event,ui){
			ui.item.css('background-color','#f6f6f6');
		},
		stop:function(event,ui){
			ui.item.removeAttr('style');
		},
		update: function(event, ui){
			var attachment_ids = '';

			jQuery('#cpotheme-gallery ul li.image').css('cursor','default').each(function(){
				var attachment_id = jQuery(this).attr('data-attachment_id');
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val(attachment_ids);
		}
	});

	// Remove images
	jQuery('#cpotheme-gallery').on('click', 'a.cpotheme-gallery-remove', function(){
		jQuery(this).closest('li.image').remove();

		var attachment_ids = '';

		jQuery('#cpotheme-gallery ul li.image').css('cursor','default').each(function(){
			var attachment_id = jQuery(this).attr('data-attachment_id');
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		$image_gallery_ids.val(attachment_ids);

		// remove any lingering tooltips
		jQuery('#tiptip_holder').removeAttr('style');
		jQuery('#tiptip_arrow').removeAttr('style');

		return false;
	});
 });
