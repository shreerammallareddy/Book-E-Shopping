function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }


$(document).ready(function(){
	$.ajax({
		url: "getpaymentmade.php",
		method: "POST",
		//data: { shippingInfo : JSON.stringify(shipping) },
		cache: false,
		beforesend: function () {},
		success: function (data){
			var paymentDone = JSON.parse(data);
			if (paymentDone === "success")
			{
				$("#message").text("Thank you for your purchase. The shipment will be on the way soon.");
					setTimeout(function(){
						window.location = "orders.php";
					}, 7000);
			}
			else if (paymentDone === "failed")
			{
				$("#message").text("The payment has failed. Please try again later. If this persists, please contact us.");
			}
			else if (paymentDone === "paymentAlreadyProcessed")
			{
				$("#message").text("The payment was already processed.");
				window.location = "index.php";
			}
			else
			{
				window.location = "index.php";
			}
		}
	});
	setTimeout(function(){
		window.location = "index.php";
	}, 10000);
});