var error = false; 

$(document).ready(function () {
    $('#newCategory').popover({
        placement: 'left',
        trigger: 'manual'
    });
    $('.category').popover({
        placement: 'bottom',
        trigger: 'manual'
    });
});


$.validator.addMethod("equalName", function(value, element) {
    var parentForm = $(element).closest('table');
    var timeRepeated = 0;
    if (value != '') {
        $(parentForm.find(':text')).each(function () {
            if (($(this).val().toUpperCase() ==  value.toUpperCase())) {
                timeRepeated++;
            }
        });
    }
    return timeRepeated === 1 || timeRepeated === 0;
}), 

$('.editCategoryForm').each(function () { // attach to all form elements on page
    $(this).validate({
        rules: {
            message: {
                required: true,
                equalName: true,
            },
        },
        messages: {
            message: {
                required: "Debe ingresar el nombre de la categoria",
                equalName: "Ese nombre ya es usado por otra categoria. Intenta ingregar uno nuevo"
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