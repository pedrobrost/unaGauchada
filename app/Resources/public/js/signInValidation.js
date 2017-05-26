$('#signInForm').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                email: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                password: {
                    minlength: 6,
                    required: true,
                },
            },
            // Specify validation error messages
            messages: {
                password: {
                    required: "Por favor ingrese su contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres"
                },
                email: {
                    email: "Por favor ingrese un email valido",
                    required: "Por favor ingrese su email"
                },
            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-danger');
                $(element).addClass('form-control-danger');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-danger');
                $(element).removeClass('form-control-danger');
                $(element).closest('.form-group').addClass('has-success');
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                form.submit();
            },

        });