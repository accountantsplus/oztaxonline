(function($) {
	'use strict';
	$(document).on('ready', function(){
        // Menu JS
        
        $(document).on('click','.navbar-collapse.in', function(e) {
            if( jQuery(e.target).is('a') && jQuery(e.target).attr('class') != 'dropdown-toggle' ) {
                $(this).collapse('hide');
            }
        });
		jQuery('.navbar .navbar-nav li a').on('click', function(){
			jQuery('.navbar-collapse').collapse('hide');
		});
        
        // Header Sticky
        jQuery(window).on('scroll',function() {
            if (jQuery(this).scrollTop() > 170){  
                jQuery('.scroll-navbar').addClass("is-sticky");
            }
            else{
                jQuery('.scroll-navbar').removeClass("is-sticky");
            }
        });
        
        // Services Slides
        $('.services-slides').owlCarousel({
            loop: true,
            autoplay:true,
            nav: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: [
            "<i class='icofont-curved-double-left'></i>",
            "<i class='icofont-curved-double-right'></i>"
            ],
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                1024:{
                    items:3,
                },
                1200:{
                    items:3,
                }
            }
        });
        
        // Tabs
        (function ($) {
            $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
            $('.tab ul.tabs li a').on('click', function (g) {
                var tab = $(this).closest('.tab'), 
                index = $(this).closest('li').index();
                tab.find('ul.tabs > li').removeClass('current');
                $(this).closest('li').addClass('current');
                tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
                tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
                g.preventDefault();
            });
	    })(jQuery);
        
        // Team Slides
        $('.team-slides').owlCarousel({
            loop: true,
            autoplay:true,
            nav: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: [
            "<i class='icofont-curved-double-left'></i>",
            "<i class='icofont-curved-double-right'></i>"
            ],
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                1024:{
                    items:3,
                },
                1200:{
                    items:4,
                }
            }
        });
		
		// Features Slides
        $('.features-slides').owlCarousel({
            loop: true,
            autoplay:true,
            nav: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: [
            "<i class='icofont-curved-double-left'></i>",
            "<i class='icofont-curved-double-right'></i>"
            ],
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                1024:{
                    items:3,
                },
                1200:{
                    items:4,
                }
            }
        });
		
		// Testimonials Slides
        $('.testimonials-slides').owlCarousel({
            loop: true,
            autoplay:true,
            nav: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: [
            "<i class='icofont-curved-double-left'></i>",
            "<i class='icofont-curved-double-right'></i>"
            ],
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                1024:{
                    items:2,
                },
                1200:{
                    items:3,
                }
            }
        });
        
        // FAQ Accordion
        $(function() {
            $('.accordion').find('.accordion-title').on('click', function(){
                // Adds Active Class
                $(this).toggleClass('active');
                // Expand or Collapse This Panel
                $(this).next().slideToggle('fast');
                // Hide The Other Panels
                $('.accordion-content').not($(this).next()).slideUp('fast');
                // Removes Active Class From Other Titles
                $('.accordion-title').not($(this)).removeClass('active');		
            });
        });
        
        // Partner Slides
        $('.partner-slides').owlCarousel({
            loop: true,
            autoplay:true,
            nav: false,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: [
            "<i class='icofont-curved-double-left'></i>",
            "<i class='icofont-curved-double-right'></i>"
            ],
            responsive:{
                0:{
                    items:2,
                },
                768:{
                    items:4,
                },
                1200:{
                    items:6,
                }
            }
        });

        $('.certification-slides').owlCarousel({
            loop: true,
            autoplay:true,
            nav: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: [
            "<i class='icofont-curved-double-left'></i>",
            "<i class='icofont-curved-double-right'></i>"
            ],
            responsive:{
                0:{
                    items:2,
                },
                768:{
                    items:4,
                },
                1200:{
                    items:6,
                }
            }
        });
		
		// Popup Youtube
		$('.popup-youtube').magnificPopup({
			disableOn: 320,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
        
        // Go to Top
        $(function(){
            //Scroll event
             
            //Click event
            $('.go-top').on('click', function() {
                $("html, body").animate({ scrollTop: "0" },  500);
            });
        });

        // Subscribe form
		$(".newsletter-form").validator().on("submit", function (event) {
			if (event.isDefaultPrevented()) {
			// handle the invalid form...
				formErrorSub();
				submitMSGSub(false, "Please enter your email correctly.");
			} else {
				// everything looks good!
				event.preventDefault();
			}
		});

		function callbackFunction (resp) {
			if (resp.result === "success") {
				formSuccessSub();
			}
			else {
				formErrorSub();
			}
		}
		function formSuccessSub(){
			$(".newsletter-form")[0].reset();
			submitMSGSub(true, "Thank you for subscribing!");
			setTimeout(function() {
				$("#validator-newsletter").addClass('hide');
			}, 4000)
		}
		function formErrorSub(){
			$(".newsletter-form").addClass("animated shake");
			setTimeout(function() {
				$(".newsletter-form").removeClass("animated shake");
			}, 1000)
		}
		function submitMSGSub(valid, msg){
			if(valid){
				var msgClasses = "validation-success";
			} else {
				var msgClasses = "validation-danger";
			}
			$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
		}
		// AJAX MailChimp
		$(".newsletter-form").ajaxChimp({
			url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
			callback: callbackFunction
		});
    });
    
    // Preloader JS
    jQuery(window).on('load', function() {
        $('.preloader').fadeOut();
    });
})(jQuery);