//CORE JS FUNCTIONALITY
//Contains only the most essential functions for the theme. No jQuery.

//MOBILE MENU TOGGLE
document.addEventListener('DOMContentLoaded', function(){
    var menu_element = document.getElementById('menu-mobile-open');
	var menu_exists = !!menu_element;
	if(menu_exists){
		menu_element.addEventListener('click', function(){
			document.body.classList.add('menu-mobile-active');
		});

		document.getElementById('menu-mobile-close').addEventListener('click', function(){
			document.body.classList.remove('menu-mobile-active');
		});
	}
});

 //Accordions
if(jQuery('.ctsc-accordion').length){
	jQuery('.ctsc-accordion').each(function(){
		var accordion = jQuery(this);
		
		accordion.find('.ctsc-accordion-title').on("click touchstart", function(e){
			//Get accordion group, close all others with the same group
			var accordion_group = accordion.data('group');
			if(accordion_group){
				jQuery('.ctsc-accordion[data-group=' + accordion_group + ']').find('.ctsc-accordion-content').slideUp(300);
				jQuery('.ctsc-accordion[data-group=' + accordion_group + ']').removeClass('ctsc-accordion-open');
			}
			if(!accordion.find('.ctsc-accordion-content').is(':visible')){
				accordion.find('.ctsc-accordion-content').slideDown(300);
				accordion.addClass('ctsc-accordion-open');
			}else{
				accordion.find('.ctsc-accordion-content').slideUp(300);
				accordion.removeClass('ctsc-accordion-open');				
			}
			e.preventDefault(); 
		});
	});
}