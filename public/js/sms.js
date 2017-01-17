


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

