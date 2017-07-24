$(document).ready(function () {
    $("#modalbutton").hide();
    $('#_yourPass').popover({
        placement: 'left',
        trigger: 'manual'
    });
    $('#_newPass').popover({
        placement: 'right',
        trigger: 'manual'
    });
    $('#_confirmPass').popover({
        placement: 'left',
        trigger: 'manual'
    });
});

$('#passwordForm').validate({
    rules: {
        your_password: {
            required: true,
            minlength: 6,
        },
        _newPass: {
            minlength: 6,
        },
        _confirmPass: {
            minlength: 6,
            equalTo: '#_newPass',
        },
    },
    messages: {
    your_password: {
        required: "Por favor ingrese su contraseña",
        minlength: "Su contraseña debe tener al menos 6 caracteres"
    },
    password: {
        required: "Por favor ingrese la nueva contraseña",
        minlength: "Su contraseña debe tener al menos 6 caracteres"
    },
    _confirmPass: {
        required: "Por favor re-ingrese la nueva contraseña",
        minlength: "Su contraseña debe tener al menos 6 caracteres",
        equalTo: "La contraseña no coincide"
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
            $(element).popover('hide');
    $(element).closest('.form-group').removeClass('has-warning');
    $(element).removeClass('form-control-warning');
    $(element).closest('.form-group').addClass('has-success');
},
submitHandler: function (form) {
    form.submit();
},

});