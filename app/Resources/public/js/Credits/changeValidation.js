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
            number: "Debe ingresar un número válido",
        },
    },
    errorPlacement: function (err, element) {
        $(".data-dwn").popover({
            placement: 'left',
            trigger: 'manual'
        });
        $(".data-dwn").attr('data-content', err.text());
        $(".data-dwn").popover('show');
    },
    highlight: function (element) {

    },
    unhighlight: function (element) {
        $(".data-dwn").popover('dispose');
    },
    submitHandler: function (form) {
        form.submit();
    },

});