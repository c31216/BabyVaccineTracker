$(document).ready(function(){

	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var output = d.getFullYear() + '-' +
	    ((''+month).length<2 ? '0' : '') + month + '-' +
	    ((''+day).length<2 ? '0' : '') + day;

	var clicked_addrecord;
	var addrecord = $("#add-record");
	addrecord.click(function(e){
		e.preventDefault();
		clicked_addrecord = true;
		$("#p_list").prepend('<tr id="active"><td><input type="text" name="patient_registration_date" value="'+output+'" data-toggle="datepicker" class="col-xs-12 form-control" ></input></td>'+
								'<td><input type="text" name="patient_bdate" data-toggle="datepicker" value="'+output+'" id="daterange" class="col-xs-12 form-control"></input></td>'+
								'<td><input type="text" name="patient_lname" class="col-xs-12 filter form-control"></input></td>'+
								'<td><input type="text" name="patient_fname" class="col-xs-12 filter form-control"></input></td>'+
								'<td><input type="number" name="patient_weight" value="0" class="col-xs-12 form-control"></input></td>'+
								'<td><input type="number" name="patient_height" value="0" class="col-xs-12 form-control"></input></td>'+
								'<td><input type="number" name="patient_headcircumference" value="0" class="col-xs-12 form-control"></input></td>'+
								'<td></td>'+
								'<td><select maxlength="1" name="patient_sex" class="form-control custom-form-control"><option value="M">M</option><option value="F" >F</option></select></td>'+
								'<td><input type="text" name="patient_mother_name" class="col-xs-12 form-control"></input></td>'+
								'<td><input type="text" name="patient_father_name" class="col-xs-12 form-control"></input></td>'+
								'<td><input type="text" name="patient_guardian_name" class="col-xs-12 form-control"></input></td>'+
								'<td><input type="text" name="patient_address" class="col-xs-12 filter form-control"></input></td>'+
								'<td><input type="number" placeholder="63XXXXXXXXXX" name="patient_phonenumber" class="col-xs-12 form-control"></input></td>'+
								'<td id="hidden"><input type="text" name="patient_uname" class="col-xs-12 filter form-control"></input></td>'+csrf+
							'</tr>');
		event.stopPropagation();
		$("tr#active td input[name=patient_lname]").focus();
		addrecord.hide();
	  	$('[data-toggle="datepicker"]').datepicker({
	  		format: 'yyyy-mm-dd'
	  	});
	  	$("#th").append('<th id="temporary">Username</th>');
	  	$('#active input').keypress(function(event){

		  if(event.keyCode == 13){

			var $data = $('tr#active :input').serialize();
			$.ajax({
	          type: 'POST',
	          url: add,
	          data: $data,
	          success: function(data){
		         	if (data.patient_id) {

		         		$("input[name=patient_uname]").remove();
			          	//Add an edit class to all input elements except the specified input attribute name
			          	$( "input[name!='patient_registration_date'][name!='patient_bdate']").closest('td').addClass('edit');

			          	$("input[name='patient_registration_date']").closest("td").addClass("date");
			          	$("input[name='patient_bdate']").closest("td").addClass("date");

			          	$("select[name='patient_sex']").closest("td").addClass("select");

			          	$("tr#active td input").each(function(){
			          		$(this).closest('td').append($(this).val()).addClass($(this).attr('name')).attr('id', data.patient_id);
			          	});// append the input element values to the td element

			          	$("tr#active td select").each(function(){
			          		$(this).closest('td').append($(this).val()).addClass($(this).attr('name')).attr('id', data.patient_id);
			          	});// append the select element value to the td element
			          	
			          	$("#temporary").remove();


			          	$("tr#active").addClass('success');// add class success to table row
			          	// $("#validation").removeClass('alert-danger');
			          	// $("#validation").show().addClass('alert-success');

						// $("#validation strong").html("User's Username and Password is " + data.patient_acct + "<br>");

			          	$("tr#active td input").remove();// remove the element input upon submisison
			          	$("tr#active td select").remove();// remove the element select upon submisison
			          	$( "tr#active #hidden" ).each(function() {
						  $( this ).remove();
						});
						$( "tr #hidden" ).each(function() {
						  $( this ).remove();
						});

			          	
			          	$("tr#active").append('<td><a href="posts/'+data.patient_id+'"><p>View Profile</p></a></td>'+
			          						  '<td><a href="checkup/'+data.patient_id+'"><p>Check Up</p></a></td>'+
			          						  '<td><a href="immunization/'+data.patient_id+'"><p>Immunization</p></a></td>'+
			          						  '<td><a href="pdf/'+data.patient_id+'" target="_blank"><p>Download PDF</p></a></td>'
			          						  );
			          	$("tr#active").removeAttr("id");
			          	addrecord.show();
			          	clicked_addrecord = false;
		          	}else{
		          		$.each(data.field_name, function( i, l ){
						  $("input[name="+l+"]").addClass("required");
						});
		          		$("#validation").removeClass('alert-success');
		          		$("#validation").show().addClass('alert-danger');
		          		$("#validation strong").html('Failed: ' + data.input + '<br>');
		          	
					 	// if (!valid_lic_num.test(raw_patient_uname)) {  
							// $("input[name=patient_uname]").addClass("required");
				   //  	} 

				   //  	if (!valid_lic_num.test(raw_patient_pass)) {  
							// $("input[name=patient_pass]").addClass("required");
				   //  	}
				    }
		          }
	       
	           
	        });
		  }
		});


	});	
	
	$(window).click(function(e)
	{
		if (clicked_addrecord) {

			if ( e.target.nodeName=="INPUT" || e.target.nodeName=="SELECT") {
			    return;
			}
			$("#temporary").remove();
			$("tr#active").remove();
			addrecord.show();
       	}
	});
});