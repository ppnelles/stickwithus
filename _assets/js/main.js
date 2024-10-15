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
			jQuery('#selected-type-label').text(requestedType);
		}
		if(requestedFormula != "undefined") {
			jQuery('input.selected-formula').attr('value', requestedFormula);
			jQuery('#selected-formula-label').text(requestedFormula);
		}

		if(requestedType == 'Sponsor') {
			jQuery('.slide-sponsor-choice').css('display', 'block');
			jQuery('.slide-supporter-choice').css('display', 'none');

			jQuery('.if-company').each(function(index, el) {
				jQuery(this).css('display', 'block');			
			});
		}
		else if(requestedType == 'Supporter') {
			jQuery('.slide-sponsor-choice').css('display', 'none');
			jQuery('.slide-supporter-choice').css('display', 'block');

			jQuery('.if-company').each(function(index, el) {
				jQuery(this).css('display', 'none');			
			});
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

	jQuery(".form-btn").click(function() {
	    event.preventDefault();

	    jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#participer").offset().top
	    }, 500).delay(200);

	 });

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

  jQuery('#add-entry-form').submit(function(ev) {
    ev.preventDefault();

    jQuery('.the-form .wait').css('visibility','visible');
    jQuery('#slide-form .slide-prev').css('visibility','hidden');
    jQuery('#slide-form .form-submit').css('visibility','hidden');

    const ajaxurl = jQuery(this).attr('action');
    const data = {
      action: jQuery(this).find('input[name=action]').val(), 
      nonce: my_ajax_obj.nonce,
      firstname: jQuery(this).find('input[name=firstname]').val(),
      lastname: jQuery(this).find('input[name=lastname]').val(),
      email: jQuery(this).find('input[name=email]').val(),
      phone: jQuery(this).find('input[name=phone]').val(),
      contact_type: jQuery(this).find('input[name=contact_type]').val(),
      selected_formula: jQuery(this).find('input[name=selected_formula]').val(),
      company_name: jQuery(this).find('input[name=company_name]').val(),
      company_activity: jQuery(this).find('input[name=company_activity]').val(),
    }

    //console.log(data);

    fetch(ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Cache-Control': 'no-cache',
        },
        body: new URLSearchParams(data),
    })
    .then(response => response.json())
    .then(response => {

        if (!response.success) {
            alert("An error occured. Please, try again.");
            return;
        }
        else {

          if(response.data.validate == true) {

            jQuery('input.form-field').each(function() {
              jQuery(this).val('');
            });

            jQuery('.the-form .wait').css('visibility','hidden');
            jQuery('#form-saved').addClass('active');
            jQuery('#add-entry-form').css('display','none');

            // jQuery([document.documentElement, document.body]).animate({
            //     scrollTop: jQuery('#form-saved').offset().top
            // }, 0).delay(0);
          }
        	else if(response.data.emailexist == true) {
        		//console.log('dfsfds');
        		jQuery('#add-entry-form .email').addClass('errored');
        		jQuery('#add-entry-form .email .error-message').addClass('active');
						jQuery('.the-form .wait').css('visibility','visible');
						jQuery('#slide-form .form-submit').css('visibility','visible');
            jQuery('#slide-form .slide-prev').css('visibility','visible');



						jQuery([document.documentElement, document.body]).animate({
					        scrollTop: jQuery('#participer .email').offset().top
					    }, 300).delay(0);
        	}

        	setOwlStageHeight();

        }
    })

  });

})