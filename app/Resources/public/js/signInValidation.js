$('#signInForm').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                _username: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                _password: {
                    minlength: 6,
                    required: true,
                },
            },
            // Specify validation error messages
            messages: {
                _password: {
                    required: "Por favor ingrese su contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres"
                },
                _username: {
                    email: "Por favor ingrese un email valido",
                    required: "Por favor ingrese su email"
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
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                form.submit();
            },

        });