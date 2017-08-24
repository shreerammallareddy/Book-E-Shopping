<?php
		include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();

	if ( is_session_started() === FALSE ) session_start();
	
	$shippingInfo = htmlspecialchars($_POST['shippingInfo'], ENT_QUOTES);
	$_SESSION["shippingInfo"] = $shippingInfo;
	$_SESSION["paynow"] = "ok";
	$shipping = json_decode($shippingInfo, true);
	
	echo htmlspecialchars($_SESSION["shippingInfo"], ENT_QUOTES);
?>