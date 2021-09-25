$(function(){
		// latest result owl carousel2
	
	var latestResultOwl1 = $('.owl-carousel.latestresults1');
	latestResultOwl1.owlCarousel({
    loop:true,
	margin: 0,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:10000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'fadeInRight',
	animateOut: 'fadeOutLeft',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var latestResultOwl2 = $('.owl-carousel.latestresults2');
	latestResultOwl2.owlCarousel({
    loop:true,
	margin: 0,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:8000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'bounceInDown',
	animateOut: 'bounceOutDown',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var toppers = $('#toppers');
	toppers.owlCarousel({
    loop:true,
	margin: 0,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:40000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'fadeInUp',
	animateOut: 'fadeOutDown',
//	autoWidth: true,
	merge: true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var bidayaTopper = $('.owl-carousel.bidayatopper');
	bidayaTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var uoolaTopper = $('.owl-carousel.uoolatopper');
	uoolaTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var thaniyaTopper = $('.owl-carousel.thaniyatopper');
	thaniyaTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var thanawiyaTopper = $('.owl-carousel.thanawiyatopper');
	thanawiyaTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var aliyaTopper = $('.owl-carousel.aliyatopper');
	aliyaTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var bdTopper = $('.owl-carousel.bdtopper');
	bdTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var ulTopper = $('.owl-carousel.ultopper');
	ulTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
	
	var thTopper = $('.owl-carousel.thtopper');
	thTopper.owlCarousel({
    loop:true,
	margin: 0,
	padding: 10,
	rewind:true,
	nav:false,
	autoplay:true,
	autoplayTimeout:4000,
	autoplayHoverPause:true,
	singleItem: true,
	animateIn: 'flipInY',
	animateOut: 'flipOutY',
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
			autoplayTimeout:3000,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
			items:1,
            nav:false,
            loop:true
        }
    }
	});
});