$.validator.addMethod("nonNumeric", function (value, element) {
            return this.optional(element) || isNaN(Number(value));
        });

        // Wait for the DOM to be ready
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"

$('#createPublication').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                title: {
                    required: true,
                    max: 40
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
                    max: "El título no puede tener más de 40 letras"
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
                    min: "Por favor ingrese una fecha mayor al 01/05/2017",
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