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
	
	
	//nav on hover
	$('.dropDown').mouseenter(function(){
		$('.dropMenu').fadeIn();
	});
		
	
	$('.dropDown').mouseleave(function(){
		$('.dropMenu').fadeOut();
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
	
	//disable button after submission
//	$('.btn').submit(function(e){
//		e.preventDefault();
//		$('.btn').attr({'disabled':true});				 
//	});
	
	//disblae button if input is empty
	
//	$('input[type="number"]').change(function(){
//		
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
	var owl = $('.owl-carousel');
			owl.owlCarousel({
				loop:true,
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
	// main page programmes tabs vertical
	$('#tabs')
    .tabs()
    .addClass('ui-tabs-vertical ui-helper-clearfix');
	
	
	
	
});