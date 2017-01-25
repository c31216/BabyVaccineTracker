

$("input.bs-autocomplete").keyup(function(){
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
	})

});

$(window).click(function(e)
{
	
		if ( e.target.nodeName=="INPUT" || e.target.nodeName=="SELECT") {
		    return;
		}
		$('ul.bs-autocomplete-menu').hide();
   
});




$( "ul.bs-autocomplete-menu" ).delegate( "li.ui-menu-item a", "click", function() {

	$item = $(this).html();
  	$("input.bs-autocomplete").val($item);
  	$('ul.bs-autocomplete-menu').hide();

}); 