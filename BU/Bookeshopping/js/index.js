/*
This JS file is intended to be used in the Home page and the Search page of the project.
*/
function generateGrid(items, headerText, totalbooks)
{
	var tb = totalbooks ? totalbooks : 18;
	var liststring = "";
	liststring += '<div class="row">';
	liststring += '<div class="col-lg-12">';
	liststring += '<h3>'+ headerText +'</h3>';
	liststring += '</div>';
	liststring += '</div>';
	if (items.length > 0)
	{
		liststring += '<div class="row text-center">';
		for (i = 0; i < items.length; i++)
		{
			
			if (i < tb) //limiting the number of rows
			{
				if (i % 6 === 0 && i > 0)
				{
					liststring += '</div>';
					liststring += '<div class="row text-center">';
				}
				liststring += '<div class="col-md-2 hero-feature">';
				liststring += '<div class="thumbnail" style="height:380px;">';
				liststring += '<img style="height:230px" src="'+ items[i].ImageLocation +'" alt="">';
				liststring += '<div>';
				liststring += '<h6 style="height:60px;">'+ items[i].BookName +'</h6>';
				liststring += '<h5>'+ items[i].AuthorName +'</h5>';
				liststring += '<p>';
				liststring += '<a title="Add to cart" onclick="applyCsrf(addToCart, '+items[i].BookId+', &quot;'+items[i].BookName+'&quot;)" class="btn btn-primary">$'+ parseFloat(items[i].Price).toFixed(2)	 +' <span class="glyphicon glyphicon-shopping-cart"></span></a>';
				//liststring += '<a href="#" class="btn btn-default">More Info</a>';
				liststring += '</p>';
				liststring += '</div>';
				liststring += '</div>';
				liststring += '</div>';
			}
		}
		liststring += '</div>';
	}
	else
	{
		liststring += '<div>';
		liststring += '<h4>';
		liststring += 'No book found!';
		liststring += '</h4>';
		liststring += '</div>';
	}
	return liststring;
}

function addToCart(csrf, bookid, bookname)
{
	if (csrf && $("#userId").text()) 
	{
		$.ajax({
			url: "addToCart.php",
			method: "POST",
			data: { bookId : bookid, CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1]},
			cache: false,
			beforesend: function () {},
			success: function (data){
				$("#welcomeboxalsobought").hide();
				$("#welcomeboxAlreadyExists").hide();
				$("#welcomeboxfailed").hide();
				if (data == "inserted")
				{
					$("#welcomeboxalsobought").show();
				}
				else if (data == "alreadyExists")
				{
					$("#welcomeboxAlreadyExists").show();
				}
				else if (data == "login")
				{
					alert("Please log in to add this item to the cart.");
					return;
				}
				else if (data == "notadded")
				{
					$("#welcomeboxfailed").show();
				}
				$("#welcomebox").hide();
				applyCsrf(populateBooks, bookname, 2);
			}
		});
	}
	else
	{
		alert ('Please log in to add this item to the cart.');
	}
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
					$("#notloggedindiv").hide();
					}
					else {
					$("#helloMessage").text("");
					$("#userFirstName").text("");
					$("#userId").text("");
					$("#loggedindiv").hide();
					$("#notloggedindiv").show();						
					}
				}
				else
				{
					$("#helloMessage").text("");
					$("#userFirstName").text("");
					$("#userId").text("");
					$("#loggedindiv").hide();
					$("#notloggedindiv").show();
				}
				$("#userEmail").val("");
				$("#userPassword").val("");
				$("#welcomebox").show();
				$("#welcomeboxalsobought").hide();
				$("#welcomeboxAlreadyExists").hide();
				$("#welcomeboxfailed").hide();
			}
		});
}

function signin(csrf)
{
	if (csrf)
	{
		var userEmail = $("#userEmail").val();
		var userPassword = $("#userPassword").val();
		if (userPassword && userEmail){
			$.ajax({
				url: "login.php",
				method: "POST",
				data: { email : userEmail, pass: userPassword, CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
				cache: false,
				beforesend: function () {},
				success: function (data){
					if (data == "success")
					{
						applyCsrf(checkLoggedIn);
					}
					else if (data == "Incorrect Username and Password")
					{
						alert (data);
					}
					else
					{
						//redirect and log
						alert ("That was embarrassing! An error has occurred. Please try again later.");
					}
				}
			});
		}
	}
}

function signout()
{
	$.ajax({
		url: "logout.php",
		method: "POST",
		cache: false,
		beforesend: function () {},
		success: function (data){
			applyCsrf(checkLoggedIn);
		}
	});
}

function searchBook()
{
	applyCsrf(populateBooks, $("#searchText").val(), 1);
}

//function populateBooks(csrf, bookname, bookAdded, category)
function populateBooks(csrf, search, index)
{
	var searchIndex = index ? index : 0;
	var st = search ? search: "" ;
	var gridText = "";
	var numberOfItems = 18;
	if (index == 0)
	{
		gridText = "Our Best Sellers";
	}
	else if (index == 1)
	{
		gridText = "Search Result";
		numberOfItems = 12;
	}
	else if (index == 2)
	{
		gridText = "Customers who bought " + search +" also bought:";
		numberOfItems = 6;
	}
	else if (index == 3)
	{
		gridText = search;
		numberOfItems = 12;
	}
	//category? category : searchIndex? "" : bookAdded?  : "";
	
		$.ajax({
		url: "search.php",
		method: "POST",
		data: { searchtext : st, search: searchIndex, CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
		cache: false,
		beforesend: function () {},
		success: function (data){
			bookitems = JSON.parse(data);
			var div = document.getElementById("booksdiv");
			
			div.innerHTML = generateGrid(bookitems, gridText, numberOfItems);
		}
	});
}


$(document).ready(function(){
	applyCsrf(checkLoggedIn);
	applyCsrf(populateBooks);
});