$(document).ready(function () {
        $("#slider").slider({
            range: "min",
            animate: true,
            value: 1,
            min: 1,
            max: 50,
            step: 1,
            slide: function (event, ui) {
                update(1, ui.value); //changed
            }
        });

        //Added, set initial value.
        $("#amount").val(1);
        $("#amount-label").text(1);


        update();
    });

    function update(slider, val) {
        var $amount = slider == 1 ? val : $("#amount").val();

        $("#amount").val($amount);
        $("#amount-label").text(($amount)*price);

        $('#slider a').html('<label>' + $amount + '</label><div class="ui-slider-label-inner"></div>');
    }