var price;

$(document).ready(function () {
    $("#nextStep").hide();
    price = $("#price").val();
});

$("#changeCredits").on("change paste keyup", function(){
    $("#nextStep").show();
    $("#noneChange").hide();
});

$('#changeCredits').validate({
    rules: {
        price: {
            required: true,
        },
    },
    messages: {
        price: {
            required: "Debe llenar este campo",
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

$("#nextStep").click(function() { 
    if ($("#changeCredits").valid()){
        $(".precio").text(parseFloat($("#price").val()) + 0);
        $("#confirm").modal('show')
     }});