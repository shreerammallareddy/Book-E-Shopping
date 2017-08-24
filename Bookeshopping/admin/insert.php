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
        <h2>Add a new book</h2>
        <hr>
        <!-- </header> -->
        <!-- Page Features -->
        
        <div class="minimumheight">
		
		
		<table class="col-md-6">
				<tr>
					<td class="col-md-4"><h4>Book Name</h4></td>
					<td><input class="form-control" maxlength="60" type="text" id="bookname" onblur="return validatebname()"><span id="bnerror"></span></td>
					<td class="col-md-3"></td>
				</tr>
				<tr>
					<td class="col-md-4"><h4>Author Name</h4></td>
					<td><input class="form-control" maxlength="60" type="text" id="authorname" onblur="return validateaname()"><span id="anerror"></span></td>
				</tr>
				<tr>
					<td class="col-md-4"><h4>Price (USD)</h4></td>
					<td><input class="form-control" maxlength="10" type="text" id="price" onblur="return validateprice()"><span id="prerror"></span></td>
				</tr>
				<tr>
					<td class="col-md-4"><h4>Availability</h4></td>
					<td><input class="form-control" maxlength="10" type="text" id="availability" onblur="return validateavail()"><span id="averror"></span></td>
				</tr>
				<tr>
					<td class="col-md-4"><h4>Image</h4></td>
					<td>
					<form id="uploadImage" action="upload.php" method="post" enctype="multipart/form-data">
					<input type="file" name="fileToUpload" id="fileToUpload">
					</form>
					</td>
					<!--<td><input class="form-control" maxlength="60" onblur="//return validadminname()" type="text" id="availability"><span id="averror"></span></td>-->
				</tr>
				<tr>
                    <td></td>
					<td><input class="btn btn-primary" onclick="applyCsrf(submitBook)" value="Submit" type="button"></td>
				</tr>
		</table>

<!--<form id="uploadImage" action="upload.php" method="post" enctype="multipart/form-data" style="display: none;">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>-->
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
				}
			});
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
		function submitBook(csrf)
		{
			if (csrf)

			{
				var bookname 		= $("#bookname").val();
				var authorname 		= $("#authorname").val();
				var price 			= $("#price").val();
				var availability 	= $("#availability").val();
				var imageLocation 	= $("#fileToUpload").val();
				if (bookname && authorname && parseFloat(price) && parseInt (availability) && imageLocation)
				{
				$.ajax({
					url: "insertbook.php",
					method: "POST",
					data: {
						book 		: bookname, 
						auth 		: authorname,
						price 		: price,
						avail 		: availability,
						image 		: imageLocation,
						CSRFName 	: csrf.split(":")[0], 
						CSRFToken 	: csrf.split(":")[1]

					},
					cache: false,
					beforesend: function () {},
					success: function (data){
						$("#bookname").val("");
						$("#authorname").val("");
						$("#price").val("");
						$("#availability").val("");
						alert("The book has been added.");
						$("#uploadImage").submit();
					}
				});
				}
				else {
					alert ("Please provide proper values.");
				}
			}
		}

	</script>
	

	<!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
     
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>