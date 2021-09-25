$(function(){
 // toggle button to new post
	$('#new-item').hide();
	$('#collapsible').click(function(e){
		e.preventDefault();
		$('#new-item').slideToggle();
	});
 });