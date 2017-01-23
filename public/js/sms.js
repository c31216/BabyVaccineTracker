
$(document).ready(function(){

	$('select').on('change', function (e) {
		valueSelected = this.value;
		if (valueSelected) {
			$.ajax({
				data: {_token:token,vaccine_id:valueSelected},
				type: 'POST',
				url: user_filter,
				success: function(data){
					if (!data) {
						$("#user_filter").html("<p>No Results Found </p>");
					}else{
						$("#user_filter").html(data);
						$("#messagebox").show();
						
						$('input:checkbox.users').each(function () {
						       var sThisVal = (this.checked ? $(this).val() : "");
						       
						  });
					}
				}
			});
		}
	});

	$("#messagebox").hide();


	$(document).on("click", "#write_message",function(){

		var patientid = [];                
	    $('.users:checkbox:checked').each(function() {
	        patientid.push($(this).val());
	    });

	    $.ajax({
				data: {_token:token,patient_id:patientid},
				type: 'POST',
				url: getPatientID,
				success: function(data){
					$("#phone_numbers").html(data);
				}
		});

	});


});

