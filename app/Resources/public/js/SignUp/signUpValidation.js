$.validator.addMethod("equal", function (value, element) {
            return element == $document.getElementById('password');
        });

$.validator.addMethod("nonNumeric", function (value, element) {
            return this.optional(element) || isNaN(Number(value));
        });

        // Wait for the DOM to be ready
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"

$('#registration_form').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
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
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                pass: {
                    minlength: 6,
                },
                confirmPass: {
                    minlength: 6,
                    equalTo: '#pass',
                },
                birthday: {
                    required: true,

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
                birthday: {
                    required: "Por favor ingrese su fecha de nacimiento",
                    min: "Por favor ingrese una fecha mayor al 01/01/1900",
                    max: "Lo siento, debes tener más de 18 años para registrarte"
                },
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