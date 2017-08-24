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
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css">
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

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
				
				<ul id="loggedindiv" style="display: none;" class="nav navbar-nav pull-right">
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
				<div id="notloggedindiv" style="display: none;" class="navbar-form pull-right">
					<input id="userEmail" class="form-control" placeholder="Email" type="text"  maxlength="60">
					<input id="userPassword" class="form-control" placeholder="Password" type="password"  maxlength="20">
					<button id="signInButton" type="submit" class="btn btn-primary btn-large" onclick="applyCsrf(signin)" >Sign in</button>
					<a id="registerButton" href="registerationpage.php" type="submit" class="btn btn-primary btn-large" >Register</a>
				</div>
            </div>
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
	      </nav>	
<nav class="navbar-default">
        <!--<div class="navbar-default">-->
        <div class="container">
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#" onclick=" applyCsrf(populateBooks, 'Non-Fiction', 3)">Non-Fiction</a></li>
              <li><a href="#" onclick=" applyCsrf(populateBooks,'Fiction',3)">Fiction</a></li>
              <li><a href="#" onclick=" applyCsrf(populateBooks,'History',3 )">History</a></li>
              <li><a href="#" onclick=" applyCsrf(populateBooks,'Kids', 3)">Kids</a></li>
              <li><a href="#" onclick=" applyCsrf(populateBooks,'Teens',3)">Teens</a></li>
              <li><a href="#" onclick=" applyCsrf(populateBooks,'Health & Fitness',3)">Health & Fitness</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>


    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header id="welcomebox" class="jumbotron hero-spacer">
			<div id="welcomeboxmessage">
				<h1>Welcome to Book e-Shopping!</h1>
				<p>A book shop like no other.</p>
				<p>
				<table class="form-group"><tr>
					<td><input id="searchText" type="text" class="form-control" placeholder="Enter Title or Author"></td>
					<td><a class="btn btn-primary btn-large" onclick="searchBook()"><span class="glyphicon glyphicon-search"></span>Search</a></td>
				</tr>
				</table>
				</p>
			</div>
        </header>
		<div id="welcomeboxalsobought" class="alert alert-success" role="alert" style="margin-top: 20px;display:none;">
		<strong>Thank you!</strong>The book has been added to your cart.
		</div>
		
		<div id="welcomeboxAlreadyExists" class="alert alert-info" role="alert" style="margin-top: 20px;display:none;">
		The book already exists in your cart.
		</div>
		
		<div id="welcomeboxfailed" class="alert alert-danger" role="alert" style="margin-top: 20px;display:none;">
        <strong>The book has not been added!</strong> Please contact Book e-Shopping.
		</div>
		
        <hr>
		
		<!-- Main body -->
		<div id="booksdiv"></div>

		<hr>
		
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Book e-Shopping 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

	<!-- KnockoutJS -->
	<!-- <script src='http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.3.0.js'></script> -->
	<!-- <script src='https://github.com/SteveSanderson/knockout.mapping/blob/master/knockout.mapping.js'></script> -->
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	
	<script src="js/bootstrap.js"></script>
	<script src="js/index.js"></script>

</body>
</html>
<!-- http://placehold.it/800x500 -->