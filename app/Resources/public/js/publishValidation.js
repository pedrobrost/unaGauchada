
$('#createPublication').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
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
                limitDate: {
                    required: true,  
                },
            },
            // Specify validation error messages
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
                limitDate: {
                    required: "Por favor ingrese la fecha limite",
                    min: "Por favor ingrese una fecha mayor al día de hoy",
                    max: "Por favor ingrese una fecha menor al 01/01/3000"
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