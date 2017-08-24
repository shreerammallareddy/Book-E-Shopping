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
            <h2 id="title"></h2>
			<hr>
        <!-- </header> -->
		<!-- Page Features -->
		
		<div class="col-md-6 minimumheight" id="cartitems" style="display:none;"></div>
		
		<div class="col-md-6 minimumheight" id="shippingInfo" style="display:none;">
			<table class="col-md-8">
				<tr>
				<td><h4>Full Name</td>
				<td><input id="fullname" class="form-control" type="text"  maxlength="60" onblur="return validateflname()"></><span id="flerror"></span></td>
				</tr>
				<tr>
				<td><h4>Address</td>
				<td><input id="address1" class="form-control" type="text"  maxlength="60" onblur="return validateadd()"></><span id="aderror"></span></td>
				</tr>
				<tr>
				<td><h4></td>
				<td><input id="address2" class="form-control" type="text"  maxlength="60" onblur="return validateadd()"></><span id="aderror"></span></td>
				</tr>
				<tr>
				<td><h4>City</td>
				<td><input id="city" class="form-control" type="text"  maxlength="60" onblur="return validatecity()"></><span id="cerror"></span></td>
				</tr>
				<tr>
				<td><h4>State</td>
				<td>
				<select id="state" class="form-control" >
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
				</td>
				</tr>
				<tr>
				<td><h4>Zipcode</td>
				<td><input id="zipcode" class="form-control" type="text"  maxlength="10" onblur="return validatezip()"></><span id="zerror"></span></td>
				</tr>
				<tr>
				<td><h4>Contact Number</td>
				<td><input id="contactNumber" class="form-control" type="text"  maxlength="12" onblur="return validatecontact()"></><span id="cnerror"></span></td>
				</tr>
			</table>
		</div>
		
		<div class="col-md-6" id="subtotalbox" style="display: none;">
			<header class="jumbotron hero-spacer">
				<!-- <div class="text-left"> -->
				<h3>Order Summary</h3>
				<table class="col-md-10">
				<tr>
				<td >Subtotal</td>
				<td><h5 id="subtotalText"></h5></td>
				</tr>
				<tr>
				<td>Shipping</td>
				<td><h5 id="shippingText"></h5></td>
				</tr>
				<tr>
				<td>Tax</td>
				<td><h5 id="taxText"></h5></td>
				</tr>
				<tr>
				<td><h4>Total</h4></td>
				<td><h4 id="totalText"></h4></td>
				</tr>
				</table>
				
				
				
            <p>
				<button id="proceedToShipping" class="btn btn-primary btn-large" onclick="gotoShipping()">
					<span class="glyphicon glyphicon-ok-circle"></span>Proceed to Shipping Information</button>
				<button id="proceedToCheckout" class="btn btn-primary btn-large" onclick="applyCsrf(gotoCheckout)">
					<span class="glyphicon glyphicon-ok-circle"></span>Proceed to Checkout</button>
			</p>
				<!-- <div> -->
			</header>
		</div>


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
	
	<script src="js/cart.js"></script>
	<script src="js/custom.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>

</html>
<!-- http://placehold.it/800x500 -->