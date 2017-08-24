function removeItem (csrf, bookid)
{
	$.ajax({
		url: "removefromcart.php",
		method: "POST",
		data: { bookId : bookid , CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1]},
		cache: false,
		beforesend: function () {},
		success: function (data){
			window.location = "cart.php";
		}
	});
}
function generateGrid(items)
{
	var liststring = "";
	liststring += '<div class="text-left">';
	if (items.length > 0)
	{
		liststring += '<div class="row list-inline columnCaptions">';
		liststring += '<span class="col-md-1"></span>';
		liststring += '<span class="col-md-4">Book</span>';
		liststring += '<span class="col-md-4">Author</span>';
		liststring += '<span class="col-md-1">Price</span>';
		liststring += '<span class="col-md-1"></span>';
		liststring += '</div>';
		liststring += '<hr>';
		for (i = 0; i < items.length; i++)
		{
			if (items[i].Availability && items[i].Availability >0)
			{
				liststring += '<div class="row">';
				liststring += '<img src="'+items[i].ImageLocation+'" alt="" class="col-md-1 thumbnail">';
				liststring += '<span class="col-md-4">'+items[i].BookName+'</span>';
				liststring += '<span class="col-md-4">'+items[i].AuthorName+'</span>';
				liststring += '<span class="col-md-2">$' + parseFloat(items[i].Price).toFixed(2) +'</span>';
				liststring += '<a class="col-md-1" href="#" title="Remove" class="btn btn-primary" onclick="applyCsrf(removeItem, '+items[i].BookId+')" ><span class="glyphicon glyphicon-remove"></span></a>';
				liststring += '</div>';
				liststring += '<hr>';
			}
		}
	}
	else
	{
		liststring += '<div>';
		liststring += '<h4>';
		liststring += 'No book has been added to your cart yet.';
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
			else 
			{
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
		url: "getCartItems.php",
		method: "POST",
		data: { CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
		cache: false,
		beforesend: function () {},
		success: function (data){
			var cartInfo = JSON.parse(data);
			if (cartInfo.cartItems && cartInfo.cartItems.length > 0)
			{
				$("#subtotalbox").show();
			}
			else
			{
				$("#subtotalbox").hide();
			}
			document.getElementById("cartitems").innerHTML = generateGrid(cartInfo.cartItems);
			
			document.getElementById("subtotalText").innerHTML = "$" + parseFloat(cartInfo.subtotal).toFixed(2);
			document.getElementById("taxText").innerHTML = "$" + parseFloat(cartInfo.tax).toFixed(2);
			document.getElementById("shippingText").innerHTML = "$" + parseFloat(cartInfo.shipping).toFixed(2);
			document.getElementById("totalText").innerHTML = "$" + parseFloat(cartInfo.total).toFixed(2);
		}
	});
}

function gotoCheckout(csrf)
{
	if (!($("#fullname").val() && $("#address1").val() && $("#city").val() && $("#state").val() && $("#zipcode").val() && $("#contactNumber").val()))
	{
		alert("Please provide all the required information.");
		return;
	}
	var shipping = {
		fullname : $("#fullname").val(),
		address : $("#address1").val() + " " + $("#address2").val(),
		city : $("#city").val(),
		state : $("#state").val(),
		zipcode : $("#zipcode").val(),
		contactNumber : $("#contactNumber").val()
	};
	$.ajax({
		url: "saveShipping.php",
		method: "POST",
		data: { 
			CSRFName : csrf.split(":")[0], 
			CSRFToken : csrf.split(":")[1], 
			shippingInfo : JSON.stringify(shipping) 
		},
		cache: false,
		beforesend: function () {},
		success: function (data){
			window.location = "paynow.php";
		}
	});

}

function gotoShipping()
{
	$("#title").text("Shipping Information");
	$("#proceedToShipping").hide();
	$("#proceedToCheckout").show();
	$("#cartitems").hide();
	$("#shippingInfo").show();
}

$(document).ready(function(){
	applyCsrf(checkLoggedIn);
	$("#title").text("Shopping Cart");
	$("#proceedToShipping").show();
	$("#proceedToCheckout").hide();
	$("#cartitems").show();
	$("#shippingInfo").hide();
	applyCsrf(populateCartItems);
});

/* validate contact details */

function validateflname()
{
    var name = document.getElementById("fullname").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]*$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("flerror").innerHTML = "<font color=red>Full Name cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("flerror").innerHTML = "<font color=red>Full Name should not contain Digits or any Special characters</font>";
        return false;
    } else
    {
        document.getElementById("flerror").innerHTML = "";
        return true;
    }
}


function validateadd()
{
    var name = document.getElementById("address1").value;
    var pattern = /^([a-zA-Z0-9]+\s?)*$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name === "" || name === null)
    {
        document.getElementById("aderror").innerHTML = "<font color=red>Address cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("aderror").innerHTML = "<font color=red>Please enter valid Address</font>";
        return false;
    } else
    {
        document.getElementById("aderror").innerHTML = "";
        return true;
    }
}



function validatecity()
{
    var name = document.getElementById("city").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]*$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("cerror").innerHTML = "<font color=red>City cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("cerror").innerHTML = "<font color=red>Please enter valid City name</font>";
        return false;
    } else
    {
        document.getElementById("cerror").innerHTML = "";
        return true;
    }
}

function validatestate()
{
    var name = document.getElementById("state").value;
    var pattern = /^((A[LKZR])|(C[AOT])|(D[EC])|(FL)|(GA)|(HI)|(I[DLNA])|(K[SY])|(LA)|(M[EDAINSOT])|(N[EVHJMYCD])|(O[HKR])|(PA)|(RI)|(S[CD])|(T[NX])|(UT)|(V[TA])|(W[AVIY]))$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("serror").innerHTML = "<font color=red>State cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("serror").innerHTML = "<font color=red>Please enter valid State name</font>";
        return false;
    } else
    {
        document.getElementById("serror").innerHTML = "";
        return true;
    }
}

function validatezip()
{
    var name = document.getElementById("zipcode").value;
    var pattern = /\b\d{5}(?:-\d{4})?\b/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("zerror").innerHTML = "<font color=red>Zip Code cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("zerror").innerHTML = "<font color=red>Please enter valid ZipCode</font>";
        return false;
    } else
    {
        document.getElementById("zerror").innerHTML = "";
        return true;
    }
}

function validatecontact()
{
    var name = document.getElementById("contactNumber").value;
    var pattern = /^\d{10}$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("cnerror").innerHTML = "<font color=red>contact cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("cnerror").innerHTML = "<font color=red>Please enter valid contact details</font>";
        return false;
    } else
    {
        document.getElementById("cnerror").innerHTML = "";
        return true;
    }
}