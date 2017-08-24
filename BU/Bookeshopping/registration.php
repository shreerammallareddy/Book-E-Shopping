<?php

	include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();

// Create connection from common.php
$conn = getMysqliConn();

$fname = htmlspecialchars($_POST['fname'], ENT_QUOTES);
$lname = htmlspecialchars($_POST['lname'], ENT_QUOTES);
$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
$password = htmlspecialchars($_POST['password'], ENT_QUOTES);
// Create a random salt
//$pass =  sha1($password);
$pass = hash('sha256', $password);

$query = "SELECT Customer_Id FROM `customer_master` WHERE EmailId=?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->bind_result($customerId);
$stmt->store_result();
$greater = $stmt->num_rows > 0;
$stmt->close();

if ($greater){
	echo "emailAlreadyExists";
}
else {
	$query2 = "Insert into customer_master (First_Name,Last_Name,EmailId,Password) VALUES(?,?,?,?);";
	$stmt2 = $conn->prepare($query2);
	$stmt2->bind_param("ssss", $fname, $lname, $email, $pass);
	$stmt2->execute();
	$stmt2->close();
	echo "created";
	/*$sql = "CALL getregistration('$fname','$lname','$email','$pass')";

	if ($conn->query($sql) === TRUE) {
		echo "created";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}*/
}
$conn->close();
?>