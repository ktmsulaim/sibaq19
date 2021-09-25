$(function(){
				var item = $('#item-group');
				var candidate = $('#candidate');
				var name=$('#name');
				var title = $('#title');
				var topic = $('#topic');
				var choice = $('#choice');
				var link = $('#link');
				var linkInput = $('#linkinput');
				var file = $('#upload');
				var source = $('div#source');
				candidate.hide();
				item.hide();
				title.hide();
				link.hide();
				file.hide();
				choice.hide();
				source.hide();
				
				$('select#category').change(function(){
					var selected = $('#category option:selected').val();
					if(selected !== ''){
						item.fadeIn(700);
						
					}else if(selected == ''){
						item.hide(700);
						candidate.hide(500);
						title.hide(500);
						link.hide(500);
						choice.hide(500);
						source.hide(500);
						name.val('');
						topic.val('');
						linkInput.val('');
					}
				});
				
				$('select#item').change(function(){
					candidate.fadeIn(700);
					var selectedItem = $('#item option:selected').val();
					if(selectedItem == ''){
						candidate.hide(500);
						title.hide(500);
						link.hide(500);
						choice.hide(500);
						source.hide(500);
						name.val('');
						topic.val('');
						linkInput.val('');
					}else{
						candidate.fadeIn(700);
					}
				});
				
				$('#name').on('keypress change', function(){
					var name = $('#name').val();
					if(name == ''){
						title.hide(700);
						link.hide(500);
						choice.hide(500);
						source.hide(500);
						topic.val('');
					}else{
						title.fadeIn(700);
						link.hide(500);
					}
				});
				
				$('#topic').on('keypress', function(){
					var topic = $('#topic').val();
					if(topic == ''){
						link.hide(700);
						choice.hide(700);
						source.hide(500);
						linkInput.val('');
					}else{
						choice.fadeIn(700);
						source.fadeIn(700);
					}
				});
				
		// choice to insert input
	
//			$('input#source').change(function(){
//				var linkbtn = $('input.link');
//				var filebtn = $('input.file');
//				var link = '<label class=\"control-label' + ' ' +  'col-md-2\" for=\"linkinput\">Link</label>' +
//							'<div class="\col-md-8\">'+
//							'<input type=\"url\" name=\"link\" id=\"linkinput\" class=\"form-control\" required></div>';
//				var upload = '<label class=\"control-label'+ ' ' + ' col-md-5\" for=\"uploadinput\">Upload audio file</label>' +
//							'<div class="\col-md-8\">'+
//							'<input type=\"file\" name=\"file\" id=\"uploadinput\" class=\"form-control\" required></div>';
//				
//				if($(this).val() == "link"){
//					source.html(link);
//				}else if($(this).val() == "file"){
//					source.html(upload);
//				}else{
//					source.html('<b>no option selected</b>');
//				}
//			});
				
				
	// items goes here

	$('select#category').change(function(){
		var itemSelect = $('#item');
		var selected = $('#category option:selected').val();
		var bidaya = 				'<option value=\"\">Select an item</option>' +	
									'<option value="\kadhakadhanam\">Kadhakadhanam</option>' +
									'<option value=\"song_mlm\">Song MLM</option>' +
									'<option value=\"song_arb\">Song ARB</option>' +
									'<option value=\"song_urd\">Song URD</option>' +
									'<option value=\"group_song\">Group song</option>' +
									'<option value=\"speech_and_song\">Speech and song</option>';
		
		var uoola = '<option value=\"\">Select an item</option>' +	
									'<option value="\kadhakadhanam\">Kadhakadhanam</option>' +
									'<option value=\"song_mlm\">Song MLM</option>' +
									'<option value=\"song_arb\">Song ARB</option>' +
									'<option value=\"song_urd\">Song URD</option>' +
									'<option value=\"song_eng\">Song ENG</option>' +
									'<option value=\"speech_and_song\">Speech and song</option>';
		
		var thaniya = '<option value=\"\">Select an item</option>' +	
									'<option value=\"song_mlm\">Song MLM</option>' +
									'<option value=\"song_arb\">Song ARB</option>' +
									'<option value=\"song_urd\">Song URD</option>' +
									'<option value=\"ghazal\">Ghazal</option>' +
									'<option value=\"song_eng\">Song ENG</option>' +
									'<option value=\"group_song\">Group song</option>' +
									'<option value=\"action_play\">Action Play</option>' +
									'<option value=\"padyaparayanam\">Padhyaparayanam</option>' +
									'<option value=\"speech_and_song\">Speech and song</option>';
		
		var thanawiya = '<option value=\"\">Select an item</option>' +	
									'<option value=\"speech_and_song\">Speech and song</option>' +
									'<option value=\"nasheed_arb\">Nasheed ARB</option>' ;
		
		if(selected == "bidaya"){
			itemSelect.html(bidaya);
		}else if(selected == 'uoola'){
			itemSelect.html(uoola);
		}else if(selected == 'thaniya'){
			itemSelect.html(thaniya);
		}else if(selected == 'thanawiya'){
			itemSelect.html(thanawiya);
		}else{
			itemSelect.html('<option>No option selected</option>');
		}
});
	
});

