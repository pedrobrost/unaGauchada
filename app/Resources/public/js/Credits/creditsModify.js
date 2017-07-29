$(function() {
    var action;
    $(".number-spinner button").mousedown(function () {
        btn = $(this);
        input = btn.closest('.number-spinner').find('input');
        btn.closest('.number-spinner').find('button').prop("disabled", false);
        input.trigger( "change" );
    	if (btn.attr('data-dir') == 'up') {
            action = setInterval(function(){
                if (input.val()==""){
                    input.val("0")
                    return; 
                }
                if ( input.attr('max') == undefined || parseFloat(input.val()) < parseFloat(input.attr('max')) ) {
                    input.val(roundHalf((parseFloat(input.val())+0.50)));
                    $(".data-dwn").popover('dispose');
                }else{
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
    	} else {
            action = setInterval(function(){
                if ( input.attr('min') == undefined || parseFloat(input.val()) > parseFloat(input.attr('min')) ) {
                    input.val(roundHalf((parseFloat(input.val())-0.50)));
                    $(".data-dwn").popover('dispose');
                }else{
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
    	}
    }).mouseup(function(){
        clearInterval(action);
    });
});

var roundHalf = function(num) {
    return (Math.round(num*2)/2).toFixed(1);
}