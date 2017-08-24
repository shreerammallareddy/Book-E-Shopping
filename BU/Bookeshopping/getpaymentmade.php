<?php 
	include 'common.php';

	if ( is_session_started() === FALSE ) session_start();
	
	$pm = $_SESSION["paymentmade"]; 
	$_SESSION["paymentmade"] ="";
	echo json_encode($pm); 
?>