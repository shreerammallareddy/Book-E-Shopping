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
    <link href="css/heroic-features.css" rel="stylesheet">
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
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id=
            "bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- Page Content -->
    <div class="container">
        <!-- Jumbotron Header -->
        <h2>Registration Page</h2>
        <hr>
        <!-- </header> -->
        <!-- Page Features -->
        
        <div class="minimumheight">
            <table class="col-md-6 minimumheight">
                <tr>
                    <td class="col-md-4"><h4>First Name*</h4></td>
                    <td><input class="form-control" id="fname" maxlength="60"
                    name="fname" onblur="return validfname()" type="text">
                    <span id="fnerror"></span></td>
					<td class="col-md-2"></td>
                </tr>
                <tr>
                    <td class="col-md-4"><h4>Last Name*</h4></td>
                    <td><input class="form-control" id="lname" maxlength="60"
                    name="lname" onblur="return validlname()" type="text">
                    <span id="lnerror"></span></td>
                </tr>
                <tr>
                    <td class="col-md-4"><h4>Email*</h4></td>
                    <td><input class="form-control" id="email" maxlength="60"
                    name="email" onblur="return validemail()" type="text">
                    <span id="emerror"></span></td>
                </tr>
                <tr>
                    <td class="col-md-4"><h4>Password*</h4></td>
                    <td><input class="form-control" id="password" maxlength=
                    "60" name="password" onblur="return validpass()" type=
                    "password"> <span id="perror"></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        Password must be atleast 6 characters and maximum 15 characters in length
						and should contain atleast one digit, atleast on upper case letter and at least on lower case letter.
						It should not contain any special characters or spaces
                        <p></p>
                    </td>
                </tr>
				<tr>
                    <td class="col-md-4"><h4>Retype Password*</h4></td>
                    <td><input class="form-control" id="cpassword" maxlength=
                    "60" name="password" onblur="return validcpass()" type=
                    "password"> <span id="cperror"></span></td>
				</tr>
				<tr>
                    <td></td><td><input class="btn btn-primary btn-large" id="submit"
                    type="button" value="Register" onclick="applyCsrf(registerUser)"></td>
                    <td><!--<input class="btn btn-primary btn-large" id="reset"
                    type="reset" value="Reset">--></td>
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
    <script src="js/jquery.js">
    </script> 
    <script src="js/validations.js">
    </script> 
	<script src="js/custom.js">
    </script> 
	<script>
		function registerUser(csrf)
		{
			if (finalValidation())
			{
				var fn = $("#fname").val();
				var ln = $("#lname").val();
				var em = $("#email").val();
				var pa = $("#password").val();
				$.ajax({
					url: "registration.php",
					method: "POST",
					data: { 
						fname : fn,
						lname : ln,
						email : em,
						password : pa,
						CSRFName : csrf.split(":")[0], 
						CSRFToken : csrf.split(":")[1]
					},
					cache: false,
					beforesend: function () {},
					success: function (data){
						if (data && data == "created")
						{
							$("#fname").val("");
							$("#lname").val("");
							$("#email").val("");
							$("#password").val("");
							alert ("The user has been created.");
						}
						else if (data && data == "emailAlreadyExists")
						{
							alert("The email has already been used by another user.")
						}
						else
						{
							alert("User was not created. If the problem persists, please contact Book eShopping.");
						}
					}
				});
			}
		}
	</script>
	<!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
     
    <script src=
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
</body>
</html>