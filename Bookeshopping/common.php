<?php

function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

function check_blocked_ip($conn)
{
	//check ip
	$stmt = $conn->prepare("SELECT count(*) FROM `monitoringips` WHERE `Ip` = ?");
	$stmt->bind_param("s", $_SERVER['REMOTE_ADDR']);
	$stmt->execute();
	
	$result = $stmt->bind_result($ipcount);
	$stmt->store_result();
	
	$count = 0;
	if ($stmt->num_rows == 1) {
		while ($stmt->fetch()) {
			$count = $ipcount;
		}
	}
	$stmt->close();
	if ($count >= 10)
	{
		echo "IPBlocked";
		die();
	}
}

function update_blocked_ip($conn, $usid)
{
	$ip = $_SERVER['REMOTE_ADDR'];
	//$ip = "1:1:1:1";
	if (empty($usid))
	{
	$stmt = $conn->prepare("INSERT INTO `monitoringips` (`Ip`) VALUES (?)");
	$stmt->bind_param("s", $ip);
	$stmt->execute();
	$stmt->close();
	echo 'Incorrect Username and Password';
	}
	else
	{
	$stmt = $conn->prepare("DELETE FROM `monitoringips` WHERE Ip = ?");
	$stmt->bind_param("s", $ip);
	$stmt->execute();
	$stmt->close();
	echo "success";
}
}


function check_blocked_username($conn, $name)
{
	//check ipSELECT * FROM `monitoringnames` WHERE 1
	$stmt = $conn->prepare("SELECT count(*) FROM `monitoringnames` WHERE `name` = ?");
	$stmt->bind_param("s", $name);
	$stmt->execute();
	
	$result = $stmt->bind_result($ipcount);
	$stmt->store_result();
	
	$count = 0;
	if ($stmt->num_rows == 1) {
		while ($stmt->fetch()) {
			$count = $ipcount;
		}
	}
	$stmt->close();
	if ($count >= 10)
	{
		echo "UserBlocked";
		die();
	}
}

function update_blocked_username($conn, $usid, $name)
{
	if (empty($usid))
	{
		$stmt = $conn->prepare("INSERT INTO `monitoringnames`(`name`) VALUES (?)");
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$stmt->close();
	}
	else
	{
		$stmt = $conn->prepare("DELETE FROM `monitoringnames` WHERE name = ?");
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$stmt->close();
	}
}

function getCartItemsForTheUser($userid)
{
	try
	{
		// Create connection from common.php
		$conn = getMysqliConn();

		$query = "SELECT BookId, BookName, AuthorName, Price, Availability, ImageLocation FROM `book_master` WHERE BookId IN 
		(select id_product FROM `cart_details` WHERE id_user = ?) order by BookName asc";
		
		
		
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $userid );
		$stmt->execute();
		$result = $stmt->bind_result($BookId, $BookName, $AuthorName, $Price, $Availability,$ImageLocation);
		$stmt->store_result();

		$books = array();
		if ($stmt->num_rows > 0)
		{
			while ($stmt->fetch())
			{
				$book = array (
					"BookId" => htmlspecialchars($BookId, ENT_QUOTES),
					"BookName" => htmlspecialchars($BookName, ENT_QUOTES),
					"AuthorName" => htmlspecialchars($AuthorName, ENT_QUOTES),
					"ImageLocation" => htmlspecialchars($ImageLocation, ENT_QUOTES),
					"Price" => htmlspecialchars($Price, ENT_QUOTES),
					"Availability" => htmlspecialchars($Availability, ENT_QUOTES)
				);
				array_push($books, $book);
			}
		}
		$stmt->close();
		$conn->close();
		return $books;
	}
	catch(Exception $e) 
	{
		echo 'Error: ' .$e->getMessage();
	}
}
function deleteCartItemsForTheUser($userid)
{
	try
	{
		// Create connection from common.php
		$conn = getMysqliConn();

		$query = "DELETE FROM `cart_details` WHERE id_user = ?";
		
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $userid );
		$stmt->execute();
		
		$stmt->close();
		$conn->close();
	}
	catch(Exception $e) 
	{
		echo 'Error: ' .$e->getMessage();
	}
}

function getMysqliConn()
{
	$servername = "student-db.cse.unt.edu";
	$username = "sm1030";
	$password = "9cann5DvqFHm98FP";
	$dbname = "sm1030";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	check_blocked_ip($conn);
	return $conn;
}
?>