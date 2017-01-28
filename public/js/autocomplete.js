var input = $("input.bs-autocomplete");
var select = $("select");
var type = $("#type");

type.html('<input class="form-control bs-autocomplete" placeholder="Search" name="input" type="text" autocomplete="off">'+
				          '<ul class="nav nav-pills nav-stacked bs-autocomplete-menu" ></ul>'+
				          '<div id="notfound"></div>');

select.on('change', function (e) {
	type.empty();
	if (select.val() == 'vaccine_id') {
		$.ajax({
		  url: getvaccines,
		  data: {_token:token},
		  type: 'GET',
		  success: function(result, status, xhr) {
		   type.html('<select class="form-control" name="vaccines">'+result+'</select>');
		  }
		});
	}

	if (select.val() == 'patient_address') {
		type.html('<input class="form-control bs-autocomplete" placeholder="Search" name="input" type="text" autocomplete="off">'+
				          '<ul class="nav nav-pills nav-stacked bs-autocomplete-menu" ></ul>'+
				          '<div id="notfound"></div>');
	}

	if (select.val() == 'month') {
		type.html(
			'<select class="form-control" name="month">'+
				'<option class="form-control" value="01">January</option>'+
				'<option class="form-control" value="02">February</option>'+
				'<option class="form-control" value="03">March</option>'+
				'<option class="form-control" value="04">April</option>'+
				'<option class="form-control" value="05">May</option>'+
				'<option class="form-control" value="06">June</option>'+
				'<option class="form-control" value="07">July</option>'+
				'<option class="form-control" value="08">August</option>'+
				'<option class="form-control" value="09">September</option>'+
				'<option class="form-control" value="10">October</option>'+
				'<option class="form-control" value="11">November</option>'+
				'<option class="form-control" value="12">December</option>'+
			'</select>'
		);
	}
	
});

$("input.bs-autocomplete").keyup(function(){
	

});

$("#type").delegate("input.bs-autocomplete", 'keyup', function () {
    inputval = $(this).val();
	
	$.ajax({
	  url: autocompleteurl,
	  data: {
	    data:'data',
	    _token:token,
	    inputval:inputval
	  },
	  type: 'POST',
	  beforeSend: function(xhr) {
	    console.log('Before: ' + xhr);
	  },
	  complete: function(xhr, status) {
	    console.log('complete: ' + status);
	  },
	  success: function(result, status, xhr) {
	   if (result) {

	    $('ul.bs-autocomplete-menu').show();
	    $('ul.bs-autocomplete-menu').html(result);
	    $('#notfound').html('');

	   }else{
	   		if (!inputval) {
	   			$('#notfound').html('');
	   			$('ul.bs-autocomplete-menu').hide();
	   			return false;
	   		}
	   		$('#notfound').html('No results');
	   }
	 
	  }
	});

	$( "ul.bs-autocomplete-menu" ).delegate( "li.ui-menu-item a", "click", function() {

		$item = $(this).html();
	  	$("input.bs-autocomplete").val($item);
	  	$('ul.bs-autocomplete-menu').hide();

	}); 
});


$(window).click(function(e)
{
	
	if ( e.target.nodeName=="INPUT" || e.target.nodeName=="SELECT") {
	    return;
	}
	$('ul.bs-autocomplete-menu').hide();
   
});




