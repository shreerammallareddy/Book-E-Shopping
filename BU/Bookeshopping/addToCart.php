<?php
try{
	include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();

	// Create connection from common.php
	$conn = getMysqliConn();

	$bookId = htmlspecialchars($_POST['bookId'], ENT_QUOTES);
	if ((int)$bookId > 0 && !is_int((int)$bookId)) {
		echo "notadded";
		die();
	}

	$userId = $_SESSION["userid"];
	
	if ((int)$userId > 0 && !is_int((int)$userId)) {
		echo "login";
		die();
	}
	
	$quantity = "1"; //peset
	
	$stmt1 = $conn->prepare("SELECT quantity FROM `cart_details` WHERE id_user = ? and id_product = ?");
	$stmt1->bind_param("ss", $userId, $bookId);
	$stmt1->execute();
	$result = $stmt1->bind_result($quantity);
	$stmt1->store_result();
	
	//echo $result;
	//echo $stmt1->num_rows;
	$insert = 0;
	if ($stmt1->num_rows == 0) $insert = 1;
	$stmt1->close();
	
	if ($insert == 1)
	{
		$stmt2 = $conn->prepare("INSERT INTO cart_details(id_user, quantity, id_product) VALUES (?, ?, ?)");
		$stmt2->bind_param("sss", $userId, $quantity, $bookId);
		$stmt2->execute();

		$stmt2->close();
		echo "inserted";
	}
	else{
		echo "alreadyExists";
	}
	$conn->close();
}
catch(Exception $e) {
  echo 'Error: ' .$e->getMessage();
}
?>