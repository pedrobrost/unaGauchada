$.validator.addMethod("check_date_of_birth", function (value, element) {
    if (this.optional(element)) {
        return true;
    }

    var dateOfBirth = value;
    var arr_dateText = dateOfBirth.split("/");
    day = arr_dateText[0];
    month = arr_dateText[1];
    year = arr_dateText[2];

    var mydate = new Date();
    mydate.setFullYear(year, month - 1, day);

    var maxDate = new Date();
    maxDate.setYear(maxDate.getYear() - 18);

    if (maxDate < mydate) {
        return false;
    }
    return true;
}, 'Perdon, debes tener más de 18 años');

$.validator.addMethod("max_date_limit", function (value, element) {
    if (this.optional(element)) {
        return true;
    }

    var date = value;

    var maxDate = new Date();

    if (maxDate < date) {
        return false;
    }
    return true;
}, 'Ingrese una fecha válida');


function isPasswordPresent() {
    return $('#accountpassword1').val().length > 0;
}

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
                password: {
                    minlength: 6,
                    required: true,
                },
                confirmPass: {
                    required: true,
                    equalTo: "#password",
                    minlength: 6,
                },
                birthday: {
                    check_date_of_birth: true,
                    required: true,
                    max_date_limit: true,
                },
                phone: {
                    required: true,
                    number: true,
                },
            },
            // Specify validation error messages
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
                    required: "Por favor re-ingrese contraseña",
                    minlength: "Su contraseña debe tener al menos 6 caracteres",
                    equalTo: "La contraseña no coincide"
                },
                email: {
                    email: "Por favor ingrese un email valido",
                    required: "Por favor ingrese su email"
                },
                phone: {
                    number: "Por favor ingrese un email valido",
                    required: "Por favor ingrese su telefono"
                },
                birthday: {
                    required: "Por favor ingrese su fecha de nacimiento"
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