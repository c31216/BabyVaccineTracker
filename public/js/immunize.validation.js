
$(function(){
	var $vaccine_id = $('#a option').val();
	$('input[name=expected_vaccine]').val($vaccine_id);
	$('input.btn').submit(function(){

		$selected_id = $('select#a').find(":selected").attr('value');
		
		$vaccine_name = $('#a option').text();

		$expected_vaccine = $('#vaccines option[value='+$vaccine_id+']').text();

		
		$('#a').on('change', function (e) {
	    	valueSelected = this.value;
	    	if (valueSelected==$vaccine_id) {
	    		$('select#a').removeClass('empty');
	    		$('select#a').addClass('custom_success');
	    		$("#empty_msg").text('');
	    	}else{
	    		$('select#a').addClass('empty');
	    		$('select#a').removeClass('custom_success');
	    		$("#empty_msg").text('Please take '+ $expected_vaccine + ' first');
	    	}
		});

		if (Number($selected_id) != $vaccine_id) {
			$("#empty_msg").text('Please take '+ $expected_vaccine + ' first');
			$('select#a').addClass('empty');
			return false;
		}

		

	});



});




// $(function(){

// 	$('input.btn').click(function(){
// 		$selected_id = $('select').find(":selected").attr('value');
// 		if ($selected_id == 'empty') {
// 			$("#empty_msg").text('All Vaccines Has Already Been Taken');

// 			$('select').addClass(function() {
// 			    return 'empty';
// 			});

// 		}
// 	});

// });

