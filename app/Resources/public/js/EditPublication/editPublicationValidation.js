$(document).ready( function() {
        $("#modalbutton").hide();
});

$("#cancelform").click(function(){
    $("#editPublication_form").validate().resetForm();
    change = false;
        $("#backbutton").show();
        $("#modalbutton").hide();
});

var change = false;

$('#editPublication_form').change(function(){
    if (!change){
        change = true;
        $("#backbutton").hide();
        $("#modalbutton").show();
    }
});

$.validator.addMethod("nonNumeric", function(value, element) {
    return this.optional(element) || !value.match(/[0-9]+/);
});

$('#editPublication_form').validate({
            rules: {
             title: {
                    required: true,
                    maxlength: 50,
                },
                description: {
                    required: true,
                },
                category: {
                    required: true,  
                },
                city: {
                    required: true,  
                },
            },
            messages: {
                title: {
                    required: "Por favor ingrese el título",
                    maxlength: "El título no puede tener más de 50 letras"
                },
                description: {
                    required: "Por favor ingrese una descripción",
                },
                category: {
                    required: "Por favor seleccione una categoria",
                },
                city: {
                    required: "Por favor seleccione la ciudad",
                },
            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-warning');
                $(element).addClass('form-control-warning');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-warning');
                $(element).removeClass('form-control-warning');
            },
            submitHandler: function (form) {
                form.submit();
            },

        });