(function($) {


	'use strict';

	/* ==========================================================================
	 Smooth scrolling
	 ========================================================================== */

	function smoothScrollAnchors() {

		$('a[href*="#"]:not([href="#"])').on('click', function() {


			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}


		});
	}

  function pricingBoxLists() {
    var window_w = jQuery( window ).width();
    if ( window_w > 768 ) {
      var element = $( '.purchase-advantages' ),
          offset;

	  if(element.length){
		  	offset = Math.max.apply(null, jQuery(".pricing-table-head").map(function () {
			    return jQuery(this).height();
			}).get());;
		  	element.css( {
				'top': offset + 1
		  	} );
	  }
    }
  }

	/* ==========================================================================
	 When document is ready, do
	 ========================================================================== */

	jQuery(document).ready(function($) {

		smoothScrollAnchors();
		// pricingBoxLists();

		// $( window ).resize(function() {
	 //        pricingBoxLists();
	 //    });

	});

	var cpoSymbols = {
	    'EUR': '&euro;',
	    'GBP': '&pound;',
	    'USD': '&dollar;',
	};

	$( window ).on( 'ppeddfsAfterFsMarkup', function(){

	    $( 'span.fsc-currency' ).each( function(){
	        var $span = $( this ),
	            currency = $span.text();

	            if ( cpoSymbols[ currency ] ) {
	                $span.html( cpoSymbols[ currency ] );
	            }
	    });

	});

})(window.jQuery);
// non jQuery functions go below