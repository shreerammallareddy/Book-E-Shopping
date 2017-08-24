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
        </div><!-- /.container -->
    </nav><!-- Page Content -->
    <div class="container">
        <!-- Jumbotron Header -->
        <h2>Please login</h2>
        <hr>
        <!-- </header> -->
        <!-- Page Features -->
        
        <div class="minimumheight">
            <table class="col-md-6">
                <tr>
                    <td class="col-md-4"><h4>User Name</h4></td>
                    <td><input class="form-control" id="email" maxlength="60"
                    name="email" type="text">
                    <span id="emerror"></span></td>
					<td class="col-md-3"></td>
                </tr>
                <tr>
                    <td class="col-md-4"><h4>Password</h4></td>
                    <td><input class="form-control" id="password" maxlength=
                    "60" name="password" onblur="" type= "password"> <span id="perror"></span></td>
                </tr>
				<tr>
                    <td></td><td>
					<input class="btn btn-primary" onclick="applyCsrf(submitlogin)" value="Submit" type="button">
					</td>
                </tr>
            </table>
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
					if (data == "Yes")
					{
						window.location = "home.php";
					}
				}
			});
		}
		function submitlogin(csrf)
		{
			if (csrf){
				var emailId = $("#email").val();
				var pass = $("#password").val();
				$.ajax({
					url: "adminlogin.php",
					method: "POST",
					data: { email : emailId, 
					password : pass ,
					CSRFName : csrf.split(":")[0], 
					CSRFToken : csrf.split(":")[1]
					},
					cache: false,
					beforesend: function () {},
					success: function (data){
						if (data == "success")
						{
							window.location = "home.php";
						}
						else
						{
							alert("Wrong user or pass.");
						}
					}
				});
			}
		}

	</script>
	

	<!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
     
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>