$('#passwordForm').validate({
         rules: {
                _newPass: {
                    minlength: 6,
                },
                _confirmPass: {
                    minlength: 6,
                    equalTo: '#_newPass',
                },
            },
            messages: {
                _newPass: {
                    required: "Por favor ingrese la contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres"
                },
                _confirmPass: {
                    required: "Por favor re-ingrese la contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres",
                    equalTo: "La contraseña no coincide"
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