$('.addCategoryForm').each(function () {
    $(this).validate({
        rules: {
            nombre: {
                required: true
            },
        },
        messages: {
            nombre: {
                required: "Debe llenar este campo",
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
});