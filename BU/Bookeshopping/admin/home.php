<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <title>Book e-Shopping</title><!-- Bootstrap Core CSS -->
    <link href=
    "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel=
    "stylesheet"><!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <link href="../css/heroic-features.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button class="navbar-toggle" data-target=
                "#bs-example-navbar-collapse-1" data-toggle="collapse" type=
                "button"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span></button> <a class="navbar-brand"
                href="index.php">Book e-Shopping</a>
            </div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul id="loggedindiv" class="nav navbar-nav pull-right">
				<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<b><span id="helloMessage">Hello, Admin</span></b><span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu">
						<li><a href="insert.php">Add a new book</a></li>
						<li><a href="update.php">Update Book Availability</a></li>
						<li><a href="delete.php">Delete a Book</a></li>
						<li role="separator" class="divider"></li>
						<!--<li class="dropdown-header"></li>-->
						<li><a id="signOutButton" type="submit" onclick="signout()">Sign out</a></li>
					  </ul>
					</li>
				</ul>
            </div>
        </div><!-- /.container -->
    </nav><!-- Page Content -->
    <div class="container">
        <!-- Jumbotron Header -->
        <h2>Welcome Admin!</h2>
		<h4>You can select an action from the dropdown menu.</h4>
        <!-- </header> -->
        <!-- Page Features -->
        
        <div class="minimumheight" id="allbooks" style="padding-top: 50px;">
		

        </div><!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Book e-Shopping 2016</p>
                </div>
            </div>
        </footer>
    </div><!-- /.container -->
	    <!-- jQuery -->
    <script src="../js/jquery.js"></script> 
    <script src="../js/validations.js"></script> 
    <script src="../js/custom.js"></script> 
		<script>
		$(document).ready(function(){
			applyCsrf(checkAdminSessionUser);
		});
		function checkAdminSessionUser(csrf)
		{
			$.ajax({
				url: "checkadminsessionuser.php",
				method: "POST",
				data: { CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
				cache: false,
				beforesend: function () {},
				success: function (data){
					if (data != "Yes")
					{
						window.location = "index.php";
					}
					else
					{
						applyCsrf(populateAllBooks);
					}
				}
			});
		}
		function generateGrid(items)
		{
			var liststring = "";
			if (items.length > 0)
			{
				liststring += '<table class="row text-left col-md-10">';
					liststring += '<tr>';
					
					liststring += '<td class="col-md-3">';
					liststring += '<b>Book Name';
					liststring += '</td>';
					
					liststring += '<td class="col-md-2">';
					liststring += '<b>Author Name';
					liststring += '</td>';
					
					liststring += '<td class="col-md-1">';
					liststring += '<b>Availability';
					liststring += '</td>';
					
					liststring += '<td class="col-md-1">';
					liststring += '<b>TotalSold';
					liststring += '</td>';
					
					liststring += '</tr>';
				for (i = 0; i < items.length; i++)
				{
					liststring += '<tr>';
					
					liststring += '<td>';
					liststring += '<label style="margin-top:10px; margin-bottom: 10px; padding-right: 10px;">';
					liststring += items[i].BookName;
					liststring += '</label>';
					liststring += '</td>';
					
					liststring += '<td>';
					liststring += items[i].AuthorName;
					liststring += '</td>';
					
					liststring += '<td>';
					liststring += items[i].Availability;
					liststring += '</td>';
					
					liststring += '<td>';
					liststring += items[i].TotalSold;
					liststring += '</td>';
					
					liststring += '</tr>';
				}
				liststring += '</table>';
			}
			return liststring;
		}
		
		function populateAllBooks(csrf)
		{
			if (csrf)
			{
				$.ajax({
					url: "../search.php",
					method: "POST",
					data: { searchtext : "", search: "4", CSRFName : csrf.split(":")[0], CSRFToken : csrf.split(":")[1] },
					cache: false,
					beforesend: function () {},
					success: function (data){
						bookitems = JSON.parse(data);
						var div = document.getElementById("allbooks");
						
						div.innerHTML = generateGrid(bookitems);
					}
				});
			}
		}
		function signout()
		{
			$.ajax({
				url: "../logout.php",
				method: "POST",
				cache: false,
				beforesend: function () {},
				success: function (data){
					window.location = "index.php";
				}
			});
		}

	</script>
	

	<!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
     
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>