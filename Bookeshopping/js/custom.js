function applyCsrf(functionName)
{
	var arg = arguments;
	$.ajax({
		url: "getCsrfName.php",
		method: "POST",
		cache: false,
		beforesend: function () {},
		success: function (csrf){
			if (csrf)
			{
				functionName(csrf, arg[1], arg[2]);
			}
		}
	});
}