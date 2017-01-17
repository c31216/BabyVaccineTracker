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
		$("#p_list").prepend('<tr id="active"><td><input type="text" name="patient_registration_date" value="'+output+'" data-toggle="datepicker" class="col-xs-12" ></input></td>'+
								'<td><input type="text" name="patient_bdate" data-toggle="datepicker" value="'+output+'" id="daterange" class="col-xs-12 docs-date"></input></td>'+
								'<td><input type="text" name="patient_lname" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="patient_fname" class="col-xs-12""></input></td>'+
								'<td><input type="number" name="patient_weight" value="0" class="col-xs-12"></input></td>'+
								'<td><input type="number" name="patient_height" value="0" class="col-xs-12"></input></td>'+
								'<td><input type="number" name="patient_age" value="0" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="patient_sex" maxlength="1" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="patient_mother_name" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="patient_address" class="col-xs-12"></input></td>'+
								'<td id="hidden"><input type="text" name="patient_uname" class="col-xs-12"></input></td>'+
								'<td id="hidden"><input type="text" name="patient_pass" class="col-xs-12"></input></td>'+ csrf+
							'</tr>');
		event.stopPropagation();
		$("tr#active td input[name=patient_lname]").focus();
		addrecord.hide();
	  	$('[data-toggle="datepicker"]').datepicker({
	  		format: 'yyyy-mm-dd'
	  	});

	  	$("#th").append('<th id="temporary">Username</th><th id="temporary">Password</th>');

	  	$('#active input').keypress(function(event){

		  if(event.keyCode == 13){

		  	var valid_lic_num = /^(?=.{6,255}$)[a-zA-Z0-9]+(?:_[a-zA-Z0-9]+)*$/;
		    var raw_patient_uname =  $("input[name=patient_uname]").val();
		    var raw_patient_pass =  $("input[name=patient_pass]").val();
		 	
		    if (valid_lic_num.test(raw_patient_uname)) {  
				var patient_uname = $("input[name=patient_uname]").val();
				alert('success');
		    } else {
		        $("input[name=patient_uname]").addClass("required");
		    }


		    if (valid_lic_num.test(raw_patient_pass)) {  
				var patient_pass = $("input[name=patient_pass]").val();
				alert('success');
		    } else {
		        $("input[name=patient_pass]").addClass("required");
		    }


			$('tr td input').filter(function() {
			    return !this.value;
			}).attr("placeholder", "Required").addClass("required");

		    patient_bdate = $("input[name=patient_bdate]").val();
			var patient_lname = $("input[name=patient_lname]").val();
			var patient_fname = $("input[name=patient_fname]").val();
			var patient_weight = $("input[name=patient_weight]").val();
			var patient_height = $("input[name=patient_height]").val();
			var patient_age = $("input[name=patient_age]").val();
			var patient_sex = $("input[name=patient_sex]").val();
			var patient_mother_name = $("input[name=patient_mother_name]").val();
			var patient_address = $("input[name=patient_address]").val();
			var patient_registration_date = $("input[name=patient_registration_date]").val();

			var patient_bdate = patient_bdate.replace(/\//g, "-");
			var dateAr = patient_bdate.split('-');
			var patient_bdate = dateAr[0] + '-' + dateAr[1] + '-' + dateAr[2].slice(-2);


			$.ajax({
	          type: 'POST',
	          url: add,
	          data: {patient_uname:patient_uname,patient_pass:patient_pass,patient_registration_date:patient_registration_date,patient_bdate:patient_bdate,patient_lname:patient_lname,patient_fname:patient_fname,patient_weight:patient_weight,patient_height:patient_height,patient_age:patient_age,patient_sex:patient_sex,patient_mother_name:patient_mother_name,patient_address:patient_address,_token:token},
	          success: function(id){
	          	// if (id.input) {
	          	// 	alert('sds');
	          	// }else{
	          	// 	alert();
	          	// }
	          	$("input[name=patient_pass]").remove();
	          	$("input[name=patient_uname]").remove();

	          	$( "input[name!='patient_registration_date'][name!='patient_bdate']").closest('td').addClass('edit');

	          	$("input[name='patient_registration_date']").closest("td").addClass("date");
	          	$("input[name='patient_bdate']").closest("td").addClass("date");

	          	$("tr#active td input").each(function(){
	          		$(this).closest('td').append($(this).val()).addClass($(this).attr('name')).attr('id', id);
	          	});
	          	
	          	$("tr#active").addClass('success');
	          	$("tr#active td input").remove();
	          	$( "tr#active #hidden" ).each(function() {
				  $( this ).remove();
				});
				$( "tr #hidden" ).each(function() {
				  $( this ).remove();
				});
				$("#temporary").remove();
				$("#temporary").remove();

	          	
	          	$("tr#active").append('<td><a href="posts/'+id+'"><p>View Profile</p></a></td>'+
	          						  '<td><a href="checkup/'+id+'"><p>Check Up</p></a></td>'+
	          						  '<td><a href="immunization/'+id+'"><p>Immunization</p></a></td>'+
	          						  '<td><a href="pdf/'+id+'" target="_blank"><p>Download PDF</p></a></td>'
	          						  );
	          	$("tr#active").removeAttr("id");
	          	addrecord.show();
	          	clicked_addrecord = false;
	          }
	           
	        });
		  }
		});


	});	
	
	$(window).click(function(e)
	{
		if (clicked_addrecord) {

			if ( e.target.nodeName=="INPUT" ) {
			    return;
			}
			$("tr#active").remove();

			$("#temporary").remove();
			$("#temporary").remove();
			addrecord.show();
       	}
	});
});