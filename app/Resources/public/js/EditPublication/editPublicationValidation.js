$(document).ready(function () {
    $("#modalbutton").hide();
    $('#title').popover({
        placement: 'left',
        trigger: 'manual'
    });
    $('#description').popover({
        placement: 'left',
        trigger: 'manual'
    });
    $('#city').popover({
        placement: 'left',
        trigger: 'manual'
    });
    $('#category').popover({
        placement: 'left',
        trigger: 'manual'
    });
    city = $(city).find("li[aria-selected='true']");
});

$("#cancelform").click(function () {
    $("#editPublication_form").validate().resetForm();
    change = false;
    $("#backbutton").show();
    $("#modalbutton").hide();
    setTimeout(function() {
    $("#city").select2()
    }, 0);
});


$('#editPublication_form').change(function () {
    if (!change) {
        change = true;
        $("#backbutton").hide();
        $("#modalbutton").show();
    }
});

$.validator.addMethod("nonNumeric", function (value, element) {
    return this.optional(element) || !value.match(/[0-9]+/);
});

$('#editPublication_form').validate({
    rules: {
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
    },
    messages: {
        title: {
            required: "Por favor ingrese el título",
            maxlength: "El título no puede tener más de 50 letras"
        },
        description: {
            required: "Por favor ingrese una descripción",
        },
        category: {
            required: "Seleccione una categoria",
        },
        city: {
            required: "Seleccione una ciudad",
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
        $(element).popover('hide');
    },
    submitHandler: function (form) {
        form.submit();
    },

});