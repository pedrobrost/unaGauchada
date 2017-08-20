$('#signInForm').validate({
            rules: {
                _username: {
                    required: true,
                    email: true
                },
                _password: {
                    minlength: 6,
                    required: true,
                },
            },
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
            submitHandler: function (form) {
                form.submit();
            },

        });