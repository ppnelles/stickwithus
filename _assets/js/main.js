var currentSlide = 0;
var lastSlide = jQuery('div.slide').length - 1;
var slide = 0;
var formNav = jQuery('.all-slides');

function goToSlide(requestedSlide) {
	//console.log('current slide = ' + currentSlide);

	if(requestedSlide == 'next') {
		if(currentSlide == lastSlide) {
			slide = lastSlide;
		}
		else {
			slide = currentSlide + 1;
		}
		//console.log('next: '+slide);
	}

	else if(requestedSlide == 'previous') {
		if(currentSlide == 0) {
			slide = 0;
		}
		else {
			slide = currentSlide - 1;
		}
		//console.log('previous: '+slide);
	}
	
	else {
		slide = requestedSlide;
	}


	//console.log('goTo = ' + currentSlide);
	formNav.trigger('to.owl.carousel', slide);
	currentSlide = slide;

	// if(slide == 0) {
	// 	jQuery('#lets-go').addClass('orange');
	// }
	// else {
	// 	jQuery('#lets-go').removeClass('orange');
	// }

	checkIfInView();

}

function checkIfInView(){
		jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery('#participer').offset().top - 100
	    }, 500).delay(0);
}

jQuery('.slide-next').click(function() {
		var requestedType = jQuery(this).attr('data-type');
		var requestedFormula = jQuery(this).attr('data-formula');

		console.log(requestedType, requestedFormula);

		if(requestedType != "undefined") {
			jQuery('input.contact-type').attr('value', requestedType);
		}
		if(requestedFormula != "undefined") {
			jQuery('input.selected-formula').attr('value', requestedFormula);
		}

		if(requestedType == 'sponsor') {
			jQuery('.slide-sponsor-choice').css('display', 'block');
			jQuery('.slide-supporter-choice').css('display', 'none');
		}
		else if(requestedType == 'supporter') {
			jQuery('.slide-sponsor-choice').css('display', 'none');
			jQuery('.slide-supporter-choice').css('display', 'block');
		}

		goToSlide('next'); 
});

jQuery('.slide-prev').click(function() {
	goToSlide('previous');
});


jQuery('.slide-first').click(function() {
	goToSlide(0);
});

function setOwlStageHeight(event) {
    var maxHeight = 0;
    var thisHeight = 'auto';
    jQuery('.all-slides .owl-item.active').each(function () { // LOOP THROUGH ACTIVE ITEMS
        thisHeight = parseInt( jQuery(this).children('.all-slides .slide').outerHeight() );
        //console.log(parseInt(jQuery(this).children('.all-slides .slide').outerHeight()));
        //maxHeight=(maxHeight>=thisHeight?maxHeight:thisHeight);
    });
    jQuery('.all-slides .owl-carousel').css('height', thisHeight );
    jQuery('.all-slides .owl-stage-outer').css('height', thisHeight ); // CORRECT DRAG-AREA SO BUTTONS ARE CLICKABLE
}


jQuery(document).ready(function ($) {

  jQuery(".all-slides").owlCarousel({
    items: 1,
    loop: false,
    nav: false,
    dots: false,
    autoplay: false,
    mouseDrag: false,
    touchDrag: false,
    // autoHeight: true,
    // onRefreshed: setOwlStageHeight,
    // onInitialized: setOwlStageHeight,
    // onResized: setOwlStageHeight,
    onTranslated: setOwlStageHeight
  });

  setOwlStageHeight();

	if (location.hash) location.href = location.hash;

	if (jQuery.cookie('hidecookie') != "hidden" ) {
		$('#cookiebanner').removeClass('hidden');
	}

	if (jQuery.cookie('hidepopup') != "hidden" ) {
		$('#popup').removeClass('hidden');
	}
	
	$('#cookiebanner button').click(function(event) {
      var date = new Date();
      date.setTime(date.getTime()+(360*24*60*60*1000));
      document.cookie = "hidecookie" + "=" + "hidden" + "; expires=" + date.toGMTString();

      $('#cookiebanner').addClass('hidden');
	});
	
	// jQuery(".popup-close, .popup-bg").click(function(event) {
  //     var date = new Date();
  //     date.setTime(date.getTime()+(60*60*1000));
  //     document.cookie = "hidepopup" + "=" + "hidden" + "; expires=" + date.toGMTString();
	  
	//   jQuery('#popup').addClass('hidden');
	// });

	jQuery(".menu-anchor a").click(function() {
	    event.preventDefault();
	    var menuItem = jQuery(this).attr('href');

	    jQuery('.main-navigation').removeClass('toggled');
	    jQuery('body').removeClass('menu-toggled');

	    jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery(menuItem).offset().top
	    }, 500).delay(200);

	    jQuery('body').removeClass('menu-open');
	 });

	jQuery(".accroche a").click(function() {
	    event.preventDefault();
	    var menuItem = jQuery(this).attr('href');

	    //jQuery('.main-navigation').removeClass('toggled');
	    //jQuery('body').removeClass('menu-toggled');

	    jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery(menuItem).offset().top
	    }, 250);
	 });

})