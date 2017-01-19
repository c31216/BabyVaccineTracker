

$(document).on('click', ".edit", function () { 
  $('.edit').editable(edit_submit, {
   select : true,
   submitdata : function(value, settings) {
     return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
    }
  });
});

$(document).on('click', ".date", function () { 
   $('.date').editable(edit_submit, {
     select : true,
     type: 'datepicker',
     data: function(value, settings) {
      return value;
    },
    submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
    }
  });
});

$(document).on('click', ".select", function () { 
   $('.select').editable(edit_submit, {
     // type     : 'textarea',
     // onblur   : 'submit',
    data   : " {'M':'M','F':'F'}",
    event: 'click',
    indicator : 'saving ...',
    select : true,
    type: 'select',
    submit: 'Ok',
    submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
    },callback : function(value, settings) {
         $(this).addClass('success');
     }
 });

});



$.editable.addInputType('number', {
element : function(settings, original) {
    var input = $('<input type="number">');
    $(this).append(input);
    return(input);
},
submit : function (settings, original) {
    if (isNaN($(original).val())) {
        alert('You must provide a number')
        return false;
    } else {
        return true;
    }
}
});

 $('.edit').editable(edit_submit, {
     // type     : 'textarea',
     // onblur   : 'submit',
     event: 'click',
     indicator : 'saving ...',
     select : true,
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
   	},callback : function(value, settings) {
         $(this).addClass('success');
     }
 });


$('.number').editable(edit_submit, {
     // type     : 'textarea',
     // onblur   : 'submit',
     event: 'click',
     indicator : 'saving ...',
     select : true,
     type: 'number',
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
    },callback : function(value, settings) {
         $(this).addClass('success');
     }
 });

$('.select').editable(edit_submit, {
     // type     : 'textarea',
     // onblur   : 'submit',
    data   : " {'M':'M','F':'F'}",
    event: 'click',
    indicator : 'saving ...',
    select : true,
    type: 'select',
    submit: 'Ok',
    submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
    },callback : function(value, settings) {
         $(this).addClass('success');
     }
 });




 $.editable.addInputType('datepicker', {
    element: function(settings, original) {
        var input = $('<input/>');
        $(this).append(input);
        return (input);
    },
    plugin: function(settings, original) {
        settings.onblur = 'ignore';
        $(this).find('input').datepicker({
             autoclose: true,
            format: 'yyyy-mm-dd',
        });
    },
});


$('.date').editable(edit_submit, {

    event: 'click',
    type: 'datepicker',
    data: function(value, settings) {
      return value;
    },
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
	   },callback : function(value, settings) {
         $(this).addClass('success');
    }
 });

 $(document).on("keyup", "input", function(e){
  if (e.keyCode === 10 || e.keyCode === 13){
    return false;
  } 
        

    $(this).removeClass("required");
});