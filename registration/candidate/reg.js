$(function(){
	//alert
	$('.alert').hide();
	$('.alert').fadeIn(2000).delay(3000).fadeOut(2000);
	
	
	var limit = 7;
	
	$('input[type="checkbox"]').on('change', function(evt) {
	   if($(this).siblings(':checked').length >= limit) {
		   this.checked = false;
	   }
	});
	$('#nextbtn').attr({'disabled':true});
	$('input[type="checkbox"]').on('change', function() {
		var checked = $('input[type="checkbox"]:checked').length;
		var selCount = $('#selCount');
		var selStatus = $('#selStatus');
		var nextButton = $('#nextbtn');
		var individual = $('input.individual[type="checkbox"]:checked').length;
		var group = $('input.group[type="checkbox"]');
		var speechLang = $('input.A[type="checkbox"]:checked').length;
		var songLang = $('input.B[type="checkbox"]:checked').length;
		var handWriteLang = $('input.C[type="checkbox"]:checked').length;
		var poemLang = $('input.D[type="checkbox"]:checked').length;
		var essayLang = $('input.E[type="checkbox"]:checked').length;
		var shortStoryLang = $('input.F[type="checkbox"]:checked').length;
		var newsWrRdLang = $('input.G[type="checkbox"]:checked').length;
		var proofRdLang = $('input.H[type="checkbox"]:checked').length;
		var coversationLang = $('input.K[type="checkbox"]:checked').length;
		var debateLang = $('input.L[type="checkbox"]:checked').length;
		var curbMal = $('input.CM[type="checkbox"]:checked').length;
		var curbEng = $('input.CE[type="checkbox"]:checked').length;
		var curbUrd = $('input.CU[type="checkbox"]:checked').length;
		var curbArb = $('input.CA[type="checkbox"]:checked').length;
		var ugNs = $('#nstage input.ug[type="checkbox"]:checked').length;
		var ugs = $('#stage input.ug[type="checkbox"]:checked').length;
		var natNs = $('#nstage input.nat[type="checkbox"]:checked').length;
		var nats = $('#stage input.nat[type="checkbox"]:checked').length;
		var ug = $('input.ug[type="checkbox"]:checked').length;
		var ugNat = $('input.nat[type="checkbox"]:checked').length;
		selCount.text(checked);
		selStatus.text('');
		// set stage and nstage programme limit
		
		if(ug >= 7 || ugNat >= 9){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('You have exceeded the maximum count');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(speechLang >= 2){			// only select one language in speeches A
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(songLang >= 2){ 			// only select one language in songs B
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(handWriteLang >= 2){		// only select one language in Hand writing C
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(poemLang >= 2){			// only select one language in Poem writing D
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(essayLang >= 2){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(shortStoryLang >= 2){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(newsWrRdLang >= 2 || debateLang >= 2){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(proofRdLang >= 2 || coversationLang >= 2){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Select only one language');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(curbMal >= 4){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Curb found! Only 3 items allowed');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(curbEng >= 4){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Curb found! Only 3 items allowed');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(curbUrd >= 4){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Curb found! Only 3 items allowed');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(curbArb >= 4){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Curb found! Only 3 items allowed');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(ugNs >= 5 || ugs >= 5){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Only 4 items allowed in this category');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(natNs >= 6 || nats >= 6){
			selStatus.parent().addClass('bg-danger');
			selStatus.text('Only 5 items allowed in this category');
			nextButton.attr({'disabled':true});
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: true
			});
		}else if(checked == 0){
			nextButton.attr({'disabled':true});
		}else{
			nextButton.attr({'disabled':false});
			selStatus.parent().removeClass('bg-danger');
			$( ".individual" ).not(":checked").checkboxradio({
			  disabled: false
			});
		}
	});
});
