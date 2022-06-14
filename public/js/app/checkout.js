$(document).ready(function () {
    "use strict"; // start of use strict

/*==============================
	Checkout fields
	==============================*/
    $("#paymentType").change(function () {
        if ($(this).val() == "VISA") {
            $("#cvc").show();
            $("#cvc").attr("required", "");
            $("#card-number").show();
            $("#card-number").attr("required", "");
        } else {
            $("#cvc").hide();
            $("#cvc").removeAttr("required");
            $("#card-number").hide();
            $("#card-number").removeAttr("required");
        }

        if ($(this).val() == "MBWAY") {
            $("#phone-number").show();
            $("#phone-number").attr("required", "");
        } else {
            $("#phone-number").hide();
            $("#phone-number").removeAttr("required");
        }
		
        if ($(this).val() == "PAYPAL") {
            $("#email").show();
            $("#email").attr("required", "");
        } else {
            $("#email").hide();
            $("#email").removeAttr("required");
        }
    });
    $("#paymentType").trigger("change");
});