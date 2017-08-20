$('#scoreForm').validate({
            rules: {
            },
            messages: {
                errorElement : 'div',
         errorPlacement: function(error, element) {
                error.insertAfter('errorTxt');
            },
            required: "",
            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-warning');
                $(element).addClass('form-control-warning');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-warning');
                $(element).removeClass('form-control-warning');
                $(element).closest('.form-group').addClass('has-success');
            },
            submitHandler: function (form) {
                form.submit();
            },

        });


    jQuery.extend(jQuery.validator.messages, {
    required: "",
});