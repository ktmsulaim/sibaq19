$(function(){
	// find duplicate values 
	$('.programmes').on('change', function(){
		
		  	var titles = $('input[type="text"]').map(function(idx, elem) {
			return $(elem).val();
		  }).get();
			
			
		  console.log(titles); 
	});
});