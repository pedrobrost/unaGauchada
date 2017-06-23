$("#cancelform").click(function(){
    $("#editProfile_form").validate().resetForm();
});

$.validator.addMethod("nonNumeric", function (value, element) {
            return this.optional(element) || isNaN(Number(value));
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
                pass: {
                    minlength: 6,
                },
                confirmPass: {
                    minlength: 6,
                    equalTo: '#pass',
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
                password: {
                    required: "Por favor ingrese su contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres"
                },
                confirmPass: {
                    required: "Por favor re-ingrese su contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres",
                    equalTo: "La contraseña no coincide"
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