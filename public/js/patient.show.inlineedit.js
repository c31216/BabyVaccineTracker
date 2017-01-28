 $.editable.addInputType('datepicker', {
    element: function(settings, original) {
        var input = $('<input class="form-control"/>');
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
       return {_method: "PUT",_token:token,vaccine_id:$(this).attr("class").split(' ')[1]};
    },
    callback : function(value, settings) {
        $(this).addClass('success');
    },
    onsubmit: function(settings, td){
        $(this).validate({
            debug: true,
            rules: {
                value: {
                    required: true,
                    date: true,
                }
            },
            messages: {
                date: "Invalid Format"
            },
            errorClass: "warning",
            submitHandler: function() { 
            }
        });
        return ($(this).valid());
    },
 });


$('.store').editable(store, {

    event: 'click',
    type: 'datepicker',
    data: function(value, settings) {
      return value;
    },
    submitdata : function(value, settings) {

       return {_method: "POST",_token:token,vaccine_id:$(this).attr("class").split(' ')[1]};
    },
    callback : function(value, settings) {
        $(this).addClass('success');
    },
    onsubmit: function(settings, td){
        $(this).validate({
            debug: true,
            rules: {
                value: {
                    required: true,
                    date: true,
                }
            },
            messages: {
                date: "Invalid Format"
            },
            errorClass: "warning",
            submitHandler: function() { 
            }
        });
        return ($(this).valid());
    },
 });
