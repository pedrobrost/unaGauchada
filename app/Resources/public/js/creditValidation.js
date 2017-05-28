$.validator.addMethod("nonNumeric", function (value, element) {
    return this.optional(element) || isNaN(Number(value));
});

// Wait for the DOM to be ready
// Initialize form validation on the registration form.
// It has the name attribute "registration"

$('#credits_buy').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                        name: {
                            nonNumeric: true,
                        },
                        lastName: {
                            nonNumeric: true,
                        },
                        dni: {

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
                            check_date_of_birth: true,
                            max_date_limit: true,
                        },
                        phone: {
                            required: true,
                            number: true,
                        },
                    },
                    // Specify validation error messages
                    messages: {
                        amount: {
                            min: "Ingrese un número mayor a 0",
                            max: "Ingrese un número menor a 100"
                        },
                        lastName: {
                            required: "Por favor ingrese su apellido",
                            nonNumeric: "Por favor ingrese un apellido valido",
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