
$(function(){
	setTimeout(function(){
		$('.preloader').addClass('load');
		$('.preloader').removeClass('link show');
		$('h2.title, h1.title').textillate({
			minDisplayTime: 2000,
			in: { 
				effect: 'flipInY',
				delay: 50,
				reverse: true,
		    }
		});
	}, 500);
	
  	setTimeout(function() {
    	$('.banner__title').typeIt({
        	strings: 'Мы Работаем на <span>результат</span>,<br> чтоб результат работал на вас!',
        	speed: 50,
    	})
	}, 2000);
		
	setTimeout(function(){
		$('.help').fadeIn('slow');
	}, 6000);

	$('.help .close').on('click', function(){
		$(this).parent().fadeOut();
		return false;
	});

	$('.nav li a, .nav--more li a, .logo').on('click', function(){
		$('.preloader__title').empty();
		$(this).clone().appendTo('.preloader__title');
	})

	$('.nav--btn').on('click', function(){
		if($('.nav--more').is(':visible')) {
			$('.nav--more').fadeOut();
		} else {
			$('.nav--more').fadeIn();
		}
		return false;
	});

	$('.nav--more .close').on('click', function(){
		$(this).parent().fadeOut();
		return false;
	});

	var width = $(window).width();

	$('.submenu > a').on('click', function() {
	    if (width < 1025) {
	        $(this).next().slideToggle();
            return false;
	    }
    });

    if (width < 1025) {
    	$('.nav li a, .logo, .nav--more .li a').on('click', function(){
			$('.preloader').removeClass('load');
			$('.preloader').addClass('link');
			setTimeout(function(){
				$('.preloader').addClass('load');
				$('.preloader').removeClass('link')
			}, 1000);
		});

		$('.nav li a, .logo, .nav--more .li a').click(function(e) {
		    e.preventDefault();
		    var destination = $(this).attr('href');
		    setTimeout(function() { window.location.href = destination; }, 1500);
		});
    } else {
    	$('.nav li a, .logo, .nav--more .li a, .nav--more .submenu a').on('click', function(){
			$('.preloader').removeClass('load');
			$('.preloader').addClass('link');
			setTimeout(function(){
				$('.preloader').addClass('load');
				$('.preloader').removeClass('link')
			}, 1000);
		});

		$('.nav li a, .logo, .nav--more .li a, .nav--more .submenu a').click(function(e) {
		    e.preventDefault();
		    var destination = $(this).attr('href');
		    setTimeout(function() { window.location.href = destination; }, 1200);
		});
    }

	// $('.nav--more .container > ul > li > a').on('mouseover', function() {
	//     if (width > 1199) {
 //            $(this).siblings().fadeIn();
 //   		}
	// 	$('.submenu').on('mouseleave', function() {
 //       		$(this).children('ul').fadeOut();
	// 	});
	// 	return true;
	// });
});

((function(){
	/* main portfolio sliders */
	$('#portfolio__for').slick({
		autoplay: true,
  		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 1500,
		arrows: true,
		fade: true,
		asNavFor: '#portfolio__nav'
	});
	$('#portfolio__nav').slick({
		autoplay: true,
	    slidesToShow: 13,
		slidesToScroll: 1,
		asNavFor: '#portfolio__for',
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: 0,
		responsive: [
			{
				breakpoint: 1280,
				settings: {
					slidesToShow: 12
				}
			},
			{
				breakpoint: 1180,
				settings: {
					slidesToShow: 10
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 6,
					arrows: false
				}
			},
			{
				breakpoint: 680,
				settings: {
					slidesToShow: 3,
					arrows: false
				}
			}
		]
	});

	$('.slider--for').slick({
		autoplay: true,
  		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 1500,
		arrows: true,
		fade: true,
		asNavFor: '.slider--nav'
	});
	$('.slider--nav').slick({
		autoplay: true,
	    slidesToShow: 13,
		slidesToScroll: 1,
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		asNavFor: '.slider--for',
		responsive: [
			{
				breakpoint: 1280,
				settings: {
					slidesToShow: 12
				}
			},
			{
				breakpoint: 1180,
				settings: {
					slidesToShow: 10
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 6,
					arrows: false
				}
			},
			{
				breakpoint: 680,
				settings: {
					slidesToShow: 3,
					arrows: false
				}
			}
		]
	});

	$('#portfolio__for--1').slick({
		autoplay: true,
  		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 1500,
		arrows: true,
		fade: true,
		asNavFor: '#portfolio__nav--1'
	});
	$('#portfolio__nav--1').slick({
		autoplay: true,
	    slidesToShow: 13,
		slidesToScroll: 1,
		asNavFor: '#portfolio__for--1',
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: 0,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 3,
					arrows: false
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 2,
					arrows: true,
					centerMode: false,
				}
			}
		]
	});
	/* main portfolio sliders */

	/* main direction slider */
	$('.direction__slider').slick({
		slidesToShow: 2,
		slidesToScroll: 2,
		autoplay: true,
		autoplaySpeed: 3500,
		speed: 800,
		dots: true,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
	/* main direction slider */

	/* main clientage slider */
	$('.clientage__slider').slick({
		slidesToShow: 2,
		slidesToScroll: 2,
		autoplay: true,
		autoplaySpeed: 3500,
		speed: 800,
		dots: true,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
	/* main clientage slider */

	/* main event slider */
	$('.event__slider').slick({
		slidesToShow: 4,
		autoplay: true,
		autoplaySpeed: 3500,
		speed: 800,
		dots: true,
		arrows: false,
		responsive: [
			{
				breakpoint: 1280,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 680,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
	/* main event slider */

	/* recommended slider */
	$('#recommended__slider--1').slick({
		slidesToShow: 4,
		autoplay: true,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 680,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('#recommended__slider--2').slick({
		slidesToShow: 4,
		autoplay: true,
		arrows: false,
		dots: true,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 680,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
	/* recommended slider */

	/* portfolio slider */
	$('.portfolio--unit__for').slick({
		centerMode: true,
  		centerPadding: '0px',
  		slidesToShow: 3,
  		focusOnSelect: true,
  		autoplay: true,
  		autoplaySpeed: 3200,
  		speed: 1000,
  		asNavFor: '.portfolio--unit__nav',
  		responsive: [
  			{
  				breakpoint: 480,
  				settings: {
  					slidesToShow: 1
  				}
  			}
  		]
	});
	$('.portfolio--unit__nav').slick({
		asNavFor: '.portfolio--unit__for',
		fade: true,
		arrows: false
	});
	/* portfolio slider */

	$('input[name="tel"]').inputmask('+7 (999) 999-99-99');

	$('.fancy').fancybox();
})(jQuery));


((function(){

	/* map */

	ymaps.ready(init);
	
	var myMap;
	
	function init () {

	    myMap = new ymaps.Map(
	        'map', {
	            center: [43.245494, 76.940240],
	            zoom: 16,
	      		controls: ['zoomControl', 'typeSelector', 'geolocationControl', 'fullscreenControl']
	        }, {
		        geoObjectBalloonAutoPan: false
		    }
	    );

	    myMap.behaviors.disable('scrollZoom'); 
	  	myGeoObject1 = new ymaps.Placemark([43.244768, 76.942429], {
	        balloonContentBody: [
	           '<div class="map__block"><img src="img/img-44.jpg" alt="img-44" /><span><p>Республика Казастан 050000<br>г.Алматы, ул.Абылай Хана 141,<br>офис 320</p></span></div>'
	        ]
	    }, {
	    	balloonPanelMaxMapArea: 0
	    }, {
	    	iconLayout: 'default#imageWithContent',
	        iconImageHref: 'img/facebook-placeholder-for-locate-places-on-maps-black.svg',
	        iconImageSize: [26, 36],
	        iconImageOffset: [-15, -26]

	    });

		myMap.geoObjects.add(myGeoObject1);
		myGeoObject1.balloon.open();
	}

	/* map */

})(jQuery));