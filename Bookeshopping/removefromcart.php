<?php
try{
	include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();

	// Create connection from common.php
	$conn = getMysqliConn();

	$bookId = htmlspecialchars($_POST['bookId'], ENT_QUOTES);

	$userId = $_SESSION["userid"];
	
	$stmt = $conn->prepare("delete FROM `cart_details` WHERE id_user = ? and id_product = ?");
	$stmt->bind_param("ss", $userId, $bookId);
	$stmt->execute();
	$stmt->close();
	
	$conn->close();
}
catch(Exception $e) {
  echo 'Error: ' .$e->getMessage();
}
?>