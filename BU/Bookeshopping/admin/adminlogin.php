<?php

include '../common.php';
include '../csrfguard.php';
if ( is_session_started() === FALSE ) session_start();
csrfguard_start();

$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
$pass = htmlspecialchars($_POST['password'], ENT_QUOTES);
//$pass1 = sha1($pass);
$pass1 = hash('sha256', $pass);

// Create connection from common.php
$conn = getMysqliConn();
check_blocked_username($conn, $email);
$stmt = $conn->prepare("SELECT First_Name, customer_id FROM customer_master WHERE EmailId=? and Password=? and IsAdmin=1");




$stmt->bind_param("ss", $email, $pass1);
$stmt->execute();
$result = $stmt->bind_result($First_Name, $customer_id);
$stmt->store_result();
$usid ="";
if ($stmt->num_rows == 1) 
{  
    if ( is_session_started() === FALSE ) session_start();
	while ($stmt->fetch()) 
	{
        $_SESSION["firstname"] = htmlspecialchars($First_Name, ENT_QUOTES);
        $_SESSION["userid"] = htmlspecialchars($customer_id, ENT_QUOTES);
		$usid = htmlspecialchars($customer_id, ENT_QUOTES);
		$_SESSION["isAdmin"] = "1";
	}
}
$stmt->close();
update_blocked_ip($conn, $usid);
update_blocked_username($conn, $usid, $email);
$conn->close();
?>