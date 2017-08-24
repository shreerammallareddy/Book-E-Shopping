<?php
	include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();
$userinfo = array(
			"UserId" => htmlspecialchars($_SESSION["userid"], ENT_QUOTES),
			"CartCount" => htmlspecialchars($_SESSION["cartCount"], ENT_QUOTES),
			"FirstName" => htmlspecialchars($_SESSION["firstname"], ENT_QUOTES)
		); 
echo json_encode($userinfo);
?>