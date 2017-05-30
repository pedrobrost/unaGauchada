$.validator.addMethod("nonNumeric", function (value, element) {
    return this.optional(element) || isNaN(Number(value));
});

$("#firstbutton").click(function(){
		var form = $("#credits_buy");
		form.validate({
			rules: {
				amount: {
					required: true,
				},
			},
			messages: {
			}
		});
		if (form.valid() == true){
            $("#firstbutton").addClass( "disabled" );
		}
        $("#firstbutton").removeClass( "disabled" );
	});