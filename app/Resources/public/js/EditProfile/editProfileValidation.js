$(document).ready( function() {
        $("#modalbutton").hide();
});

$("#cancelform").click(function(){
    $("#editProfile_form").validate().resetForm();
    change = false;
        $("#backbutton").show();
        $("#modalbutton").hide();
});

var change = false;

$('#editProfile_form').change(function(){
    if (!change){
        change = true;
        $("#backbutton").hide();
        $("#modalbutton").show();
    }
});

$.validator.addMethod("nonNumeric", function(value, element) {
    return this.optional(element) || !value.match(/[0-9]+/);
});

$('#editProfile_form').validate({
            rules: {
                name: {
                    required: true,
                    nonNumeric: true,
                },
                lastName: {
                    required: true,
                    nonNumeric: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                name: {
                    required: "Por favor ingrese su nombre",
                    nonNumeric: "Por favor ingrese un nombre valido",
                },
                lastName: {
                    required: "Por favor ingrese su apellido",
                    nonNumeric: "Por favor ingrese un apellido valido",
                },
                email: {
                    email: "Por favor ingrese un email valido",
                    required: "Por favor ingrese su email"
                },
                phone: {
                    number: "Por favor ingrese un teléfono valido",
                    required: "Por favor ingrese su teléfono"
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