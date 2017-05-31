$(document).ready(function () {
        $("#amount").keyup(function () {
            var value = $(this).val();
            $("#input2").val(value);
        });
    });



$.validator.addMethod("nonNumeric", function (value, element) {
            return this.optional(element) || isNaN(Number(value));
        });

$('#credits_buy').validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                amount: {
                    required: true,
                },
                name: {
                    required: true,
                    nonNumeric: true,
                },
                 lastName: {
                    required: true,
                    nonNumeric: true,
                 }, 
                dni: {
                    required: true,
                    number:true,
                 }, 
                creditCard: {
                    required: true,
                    number:true,
                 }, 
                 pin: {
                    required: true,
                    number:true,
                 }, 
                anio: {
                    required: true,
                    number:true,
                 }, 
                mes: {
                    required: true,
                    number:true,
                 }, 
            },
            groups: {
            inputGroup: "anio mes",          
        },
            // Specify validation error messages
            messages: {
                amount: {
                    required: "Ingrese la cantidad de créditos a comprar",
                    min: "Ingrese una cantidad válida",
                    number: "Ingrese números",
                },
                name: {
                    required: "Ingrese su nombre",
                    nonNumeric: "Escriba un nombre válido"
                },
               lastName: {
                    required: "Ingrese su apellido",
                    nonNumeric: "Escriba un apellido válido",
                 }, 
                dni: {
                    required: "Ingrese su DNI",
                    minlength: "Escriba un DNI válido",
                    maxlength: "Escriba un DNI válido",
                    number: "Ingrese números",
                    min: "Escriba un DNI válido",
                 },                 
                 creditCard: {
                    required: "Ingrese el número de la tarjeta de crédito",
                    minlength: "Escriba un número de tarjeta válido",
                    number: "Ingrese números",
                    min: "Escriba un número de tarjeta válido",
                 }, 
                pin: {
                    required: "Ingrese el pin de la tarjeta",
                    number:"Ingrese un número válido",
                    minlength: "El pin debe tener 3 dígitos",
                    maxlength: "El pin debe tener 3 dígitos",
                    min: "Ingrese un número válido",
                 }, 
                anio: {
                    required:  "Ingrese una fecha valida",
                 }, 
                mes: {
                    required:  "Ingrese una fecha valida",
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