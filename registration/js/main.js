$(function(){	
	$(window).scroll(function(){
		var $scroll = $(window).scrollTop();
		var nav = $('nav').offset().top;
		var scrolltop = $('#scrollTopBtn');
			
		if((nav) = $scroll){
		$('header').attr({'class':'sticky'}, 750);
		$('#login').css({'line-height' : '50px'});
		scrolltop.fadeIn();
		}else{
			$('header').attr({'class':'noSticky'}, 750);
			$('#login').css({'line-height' : '120px'});
			scrolltop.fadeOut();
		}
	});
	
	//navbar
	
	$('#navicon').click(function(){
		$('#navItems').fadeIn().css({'right':'0'},500);
		$('span#button_close i').css({'transform' : 'rotate(360deg)'},500);
	});
	
	$('span#button_close').click (function(){
		$('#navItems').animate({right:'-300px'},250);
		$('span#button_close i').css({'transform' : 'rotate(180deg)'},250);
		$('#navItems').fadeOut();
	});
	$('#navItems').mouseleave(function(){
		$('#navItems').animate({right:'-300px'},250);
		$('span#button_close i').css({'transform' : 'rotate(180deg)'},250);
		$('#navItems').fadeOut();
	});
	
	$('.input1').focusin(function(){
		$('.search').css({'border-color':'#f34c4d','background-color':'#fff'});
	});
	$('.input1').focusout(function(){
		$('.search').css({'border-color':'transparent','background-color':'#eee'});
	});
	
// slider
	$('#headerSlider').carousel();
	
	//owl carousel
	var owl = $('.owl-carousel#instruction');
	owl.owlCarousel({
    loop:true,
    margin:10,
	nav:true,
	autoplay:true,
	autoplayTimeout:3000,
	autoplayHoverPause:true,
	animateIn: 'fadeInRight',
	animateOut: 'fadeOutLeft', 
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:true
        }
    }
	});
	
	// latest result owl carousel
	
	var latestResultOwl1 = $('.owl-carousel.latestresult1');
	latestResultOwl1.owlCarousel({
    loop:false,
	rewind:true,
    margin:10,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	animateIn: 'slideInUp',
	animateOut: 'slideOutDown', 
    responsiveClass:true,
	singleItem: true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:true
        }
    }
	});
	
	// latest result owl carousel2
	
	var latestResultOwl2 = $('.owl-carousel.latestresult2');
	latestResultOwl2.owlCarousel({
    loop:false,
	rewind:true,
    margin:10,
	nav:false,
	autoplay:true,
	autoplayTimeout:10000,
	autoplayHoverPause:true,
	animateIn: 'fadeInRight',
	animateOut: 'fadeOutLeft',
    responsiveClass:true,
	singleItem: true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:true
        }
    }
	});
//	
//	// latest result owl carousel3
//	
//	var latestResultOwl3 = $('.owl-carousel.latestresult3');
//	latestResultOwl3.owlCarousel({
//    loop:false,
//	rewind:true,
//    margin:10,
//	nav:false,
//	autoplay:true,
//	autoplayTimeout:4000,
//	autoplayHoverPause:true,
//	animateIn: 'fadeInRight',
//	animateOut: 'fadeOutLeft', 
//    responsiveClass:true,
//	singleItem: true,
//    responsive:{
//        0:{
//            items:1,
//            nav:true
//        },
//        600:{
//            items:1,
//            nav:false
//        },
//        1000:{
//            items:1,
//            nav:true,
//            loop:true
//        }
//    }
//	});
//	
//	// latest result owl carousel4
//	
//	var latestResultOwl4 = $('.owl-carousel.latestresult4');
//	latestResultOwl4.owlCarousel({
//    loop:false,
//	rewind:true,
//    margin:10,
//	nav:false,
//	autoplay:true,
//	autoplayTimeout:4000,
//	autoplayHoverPause:true,
//	animateIn: 'zoomIn',
//	animateOut: 'zoomOut', 
//    responsiveClass:true,
//	singleItem: true,
//    responsive:{
//        0:{
//            items:1,
//            nav:true
//        },
//        600:{
//            items:1,
//            nav:false
//        },
//        1000:{
//            items:1,
//            nav:true,
//            loop:true
//        }
//    }
//	});
	
	// Total ug wise result
	
	var ugwise = $('.owl-carousel#ugwise');
	ugwise.owlCarousel({
    loop:false,
	rewind:true,
    margin:10,
	nav:false,
	autoplay:true,
	autoplayTimeout:2000,
	autoplayHoverPause:true,
	animateIn: 'slideInUp',
	animateOut: 'slideOutDown',
    responsiveClass:true,
	singleItem: true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:true
        }
    }
	});
	// Instruction
	
	// loader set time out
//	setTimeout(showPage, 3000);
	function showPage(){
		$('.loaderWrapper').fadeOut();
	}
	showPage();
	
	// animate on scrolling function
  		AOS.init();

	// smooth scroll to div
	$("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
	
	// flip text auto
	$('#fliptxt').cycleText();
	
	// Vticker news vertical plugin
	$('.noti-content').vTicker('init',{showItems: 5, padding: 10, margin: 5});
	
	/*----------------------------------- results page caruosel owl -------------------------------------------------*/
	
	var group = $('#groupPrg');
	group.owlCarousel({
    loop:false,
	rewind:true,
    margin:10,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	animateIn: 'fadeIn',
	animateOut: 'fadeOut', 
    responsiveClass:true,
	singleItem: true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:true
        }
    }
	});
	
});

// Set the date we're counting down to
var countDownDate = new Date("Jan 25, 2019 19:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("min").innerHTML = minutes;
  document.getElementById("sec").innerHTML = seconds;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("count").innerHTML = "EXPIRED";
  }
}, 1000);