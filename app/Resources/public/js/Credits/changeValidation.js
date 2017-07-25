$('#changeCredits').validate({
    rules: {
        amount: {
            required: true,
        },
    },
    messages: {
        amount: {
            required: "Debe llenar este campo",
            step: "Debes ingresar un múltiplo de 0.5",
        },
    },
    errorPlacement: function (err, element) {
        element.popover({
            placement: 'bottom',
            trigger: 'manual'
        });
        element.attr('data-content', err.text());
        $(element).popover('show');
    },
    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-warning');
        $(element).addClass('form-control-warning');

    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-warning');
        $(element).removeClass('form-control-warning');
        $(element).closest('.form-group').addClass('has-success');
        $(element).popover('dispose');
    },
    submitHandler: function (form) {
        form.submit();
    },

});