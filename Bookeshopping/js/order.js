function generateGrid(items)
{
	var liststring = "";
	liststring += '<div class="text-left">';
	if (items.length > 0)
	{
		liststring += '<div class="row list-inline columnCaptions">';
		liststring += '<span class="col-md-2"></span>';
		liststring += '<span class="col-md-2">Book</span>';
		liststring += '<span class="col-md-2">Author</span>';
		liststring += '<span class="col-md-4">Address</span>';
		liststring += '<span class="col-md-2">Shipping Status</span>';
		liststring += '</div>';
		liststring += '<hr>';
		for (i = 0; i < items.length; i++)
		{
				liststring += '<div class="row">';
				liststring += '<img src="'+items[i].ImageLocation+'" alt="" class="col-md-2 thumbnail">';
				liststring += '<span class="col-md-2">'+items[i].BookName+'</span>';
				liststring += '<span class="col-md-2">'+items[i].AuthorName+'</span>';
				liststring += '<span class="col-md-4">' + items[i].Address + ' '  +items[i].City + ' '  +items[i].State + ' '  +items[i].Zip +'</span>';
				liststring += '<span class="col-md-2">'+items[i].DispatchStatus+'</span>';
				liststring += '</div>';
				liststring += '<hr>';
		}
	}
	else
	{
		liststring += '<div>';
		liststring += '<h4>';
		liststring += 'No order has been placed yet.';
		liststring += '</h4>';
		liststring += '</div>';
	}
	liststring += '</div>';
	return liststring;
}

function signout()
{
	$.ajax({
		url: "logout.php",
		method: "POST",
		cache: false,
		beforesend: function () {},
		success: function (data){
			window.location = "index.php";
		}
	});
}

function checkLoggedIn(csrf)
{
	$.ajax({
		url: "checksessionuser.php",
		method: "POST",
		data: { CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
		cache: false,
		beforesend: function () {},
		success: function (data){
			if (data.indexOf("Undefined index:") == -1)
				{
					var userinfo = JSON.parse(data);
					if (userinfo.UserId){
					$("#userFirstName").text(userinfo.FirstName);
					$("#helloMessage").text("Hello, " + userinfo.FirstName);
					$("#userId").text(userinfo.UserId);
					$("#loggedindiv").show();
					}
					else {
				alert ("Please login first.")
				window.location = "index.php";
					}
				}
			else
			{
				alert ("Please login first.")
				window.location = "index.php";
			}
		}
	});
}

function populateCartItems(csrf)
{
	$.ajax({
		url: "getOrders.php",
		method: "POST",
		data: { CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
		cache: false,
		beforesend: function () {},
		success: function (data){
			document.getElementById("orderitems").innerHTML = generateGrid(JSON.parse(data));
		}
	});
}

$(document).ready(function(){
	applyCsrf(checkLoggedIn);
	applyCsrf(populateCartItems);
});