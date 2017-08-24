<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book e-Shopping</title>

    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">
	
	<!-- <link href="css/custom.css" rel="stylesheet"> -->

	
	
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Book e-Shopping</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
				
				<ul id="loggedindiv" class="nav navbar-nav pull-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<b><span id="helloMessage"></span></b><span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu">
						<li><a href="cart.php">Your Cart</a></li>
						<li><a href="orders.php">Your Orders</a></li>
						<li role="separator" class="divider"></li>
						<!--<li class="dropdown-header"></li>-->
						<li><a id="signOutButton" type="submit" onclick="signout()">Sign out</a></li>
					  </ul>
					</li>
					<label id ="userFirstName" style="display: none;"></label>
					<label id ="userId" style="display: none;"></label>
					<li><a class="cartclass" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
					<!--<li><a class="btn btn-primary btn-large" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>-->
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <!-- <header class="jumbotron hero-spacer"> -->
            <h2 id="title">Your Orders</h2>
			<hr>
        <!-- </header> -->
		<!-- Page Features -->
		
		<div class="col-md-6 minimumheight" id="orderitems"></div>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

	<!-- jQuery -->
    <script src="js/jquery.js"></script>
	
	<script src="js/order.js"></script>
	<script src="js/custom.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>

</html>
<!-- http://placehold.it/800x500 -->