var error = false; 

$(document).ready(function () {
    $('#newCategory').popover({
        placement: 'left',
        trigger: 'manual'
    });
    $('.category').popover({
        placement: 'left',
        trigger: 'manual'
    });
});

$('.editCategoryForm').each(function () { // attach to all form elements on page
    $(this).validate({
        rules: {
            message: {
                required: true
            },
        },
        messages: {
            message: {
                required: "Debe ingresar el nombre de la categoria",
            },

        },
        errorPlacement: function (err, element) {
            element.attr('data-content', err.text());
            $(element).popover('show');
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-warning');
            $(element).addClass('form-control-warning');
            error = true;
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-warning');
            $(element).removeClass('form-control-warning');
            $(element).closest('.form-group').addClass('has-success');
            $(element).popover('hide');
            error = false;
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});



$('.addCategoryForm').each(function () { // attach to all form elements on page
    $(this).validate({
        rules: {
           newCategory: {
                required: true
            },
        },
        messages: {
            newCategory: {
                required: "Debe ingresar el nombre de la nueva categoria",
            },

        },
        errorPlacement: function (err, element) {
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
            $(element).popover('hide');
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});