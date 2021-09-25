$(function(){
	$('.dropDown').click(function(){
		$('.dropMenu').slideToggle();
	});
    
    // alert box auto disappear
    function alertDisappear(){
		$('.alert').not('#notice').delay(3000).fadeOut();
		
	}
	alertDisappear();
	// tooltip setup
	$('a [data-toggle="tooltip"]').tooltip();
	
	//table sorter
	 $('.table').tablesorter(); 
	
	
	//nav on click slideToggle result
	$('li#result').click(function(e){
		e.preventDefault();
		$('ul#resultmenu').slideToggle();
	});
	
		
	//nav on hover tools
	$('li#tools').click(function(){
		$('ul#toolsmenu').slideToggle();
	});
	
	//nav on click slideToggle finalresult
	$('li#final').click(function(){
		$('ul#final').slideToggle();
	});
	
	//nav on hover Users
	$('li#users').click(function(){
		$('ul#usersmenu').slideToggle();
	});
		
	// hover to see upload
	$('.imgfile').hide();
	$('.photoHolder').mouseenter(function(){
		$('.stdphoto').hide();
		$('.imgfile').show();
	});
	$('.photoHolder').mouseleave(function(){
		$('.stdphoto').show();
		$('.imgfile').hide();
	});
	
	$('.imgfile').change(function(event){
		var selected = $('.imgfile').val();	
		var image = '<img class=\"newimg\" src="' + URL.createObjectURL(event.target.files[0]) +'">';
		if(selected !== ''){
			$('.stdphoto').remove();
			$('.photoHolder').append(image);
			$('.newimg').last().prev('.newimg').remove();
			$('.imgfile').show();
		}
	});
	
	
	// remove text from button
	$('.button-default').text('');
	$('caption.tableexport-caption').prepend('<h5>Export</h5>');
	
	// show delete button only when hover mouse
	$('.table tr').mouseenter(function(){
		$(this).find('#trash').show();						  
	});
	$('.table tr').mouseleave(function(){
		$(this).find('#trash').hide();						  
	});
	

//	});
	$("#chestno").on("change paste keyup", function() {
   		var chestValue = $(this).val().length;
		if(chestValue == 0){
			$('#fnextbtn').attr({'disabled':true});
		}else{
			$('#fnextbtn').attr({'disabled':false});
		}
	});
	
// owl carousel candidate new
	var owl = $('.owl-carousel#candilatest');
			owl.owlCarousel({
				loop:false,
				rewind:true,
				margin:10,
				nav:true,
				autoplay:true,
    			autoplayTimeout:2000,
    			autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:4
					}
				}
			});
	
	// owl carousel results
//	var owlresult = $('#result');
//			owlresult.owlCarousel({
//				loop:false,
//				rewind:true,
//				margin:5,
//				nav:false,
//				autoplay:true,
//    			autoplayTimeout:2000,
//    			autoplayHoverPause:true,
//				responsive:{
//					0:{
//						items:1
//					},
//					600:{
//						items:3
//					},
//					1000:{
//						items:4
//					}
//				}
//			});
	// owl carousel results
	var dbeng = $('#dbeng');
			dbeng.owlCarousel({
				loop:true,
				margin:5,
				nav:false,
				autoplay:true,
    			autoplayTimeout:2500,
    			autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
	// owl carousel results
	var a15 = $('#a15');
			a15.owlCarousel({
				loop:true,
				margin:5,
				nav:false,
				autoplay:true,
    			autoplayTimeout:2000,
    			autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
	// owl carousel results
	var owlresult3 = $('#result3');
			owlresult3.owlCarousel({
				loop:false,
				rewind:true,
				margin:5,
				nav:false,
				autoplay:true,
    			autoplayTimeout:2000,
    			autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:4
					}
				}
			});
	// owl carousel results
//	var owlresult4 = $('#result4');
//			owlresult4.owlCarousel({
//				loop:false,
//				rewind:true,
//				margin:5,
//				nav:false,
//				autoplay:true,
//    			autoplayTimeout:2000,
//    			autoplayHoverPause:true,
//				responsive:{
//					0:{
//						items:1
//					},
//					600:{
//						items:3
//					},
//					1000:{
//						items:4
//					}
//				}
//			});
	// main page programmes tabs vertical
	$('#tabs')
    .tabs()
    .addClass('ui-tabs-vertical ui-helper-clearfix');
	
	//Paste into multiple data
	  $('.paste-me').on('paste', function(e){
		//add the paste event to all of the paste-me classes
		var data1 = e.originalEvent.clipboardData.items[0];
		//get the data transfer item of hte original clipboard data event.
		if(data1.kind == 'string' && data1.type=='text/plain'){
		//If it is a string and text/plain, move forward
		  e.stopPropagation();
		  //Stop the propagtion of this event
		  data1.getAsString(function(s){
		  //get the string contents of the clipboard item.
			s = s.split('\t');
			//split it by spaces
			$('.paste-me').each(function(i,item){
			  //loop through each .paste-me item
			  $(item).val( s[i] || '');
			  //set the value from the split array, or an empty string if someone copy/pastes something too small to put a value in each item
			});
		  });
		}
	  });
});