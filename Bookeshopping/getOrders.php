<?php
try
{
		include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();
	
	$userid =  $_SESSION["userid"];
	
	$conn = getMysqliConn();

	$query = 
	"select order_master.TransactionId,order_master.FullName,book_master.BookName, 
	book_master.ImageLocation, book_master.AuthorName, order_master.Amount,
	order_master.Address, order_master.City, order_master.State, order_master.Zipcode,
	order_master.OrderDate,order_master.PaymentStatus,order_master.DispatchStatus 
	from order_master,book_master,order_details
	where order_master.OrderId=order_details.OrderId 
	&& order_details.ItemId=book_master.BookId 
	&& order_master.CustomerId=?";
	
	
	
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $userid );
	$stmt->execute();
	$result = $stmt->bind_result($TransactionId, $FullName, $BookName,  $ImageLocation, $AuthorName, $Amount, $Address, $City, 
	$State, $Zip, $OrderDate,$PaymentStatus,$DispatchStatus);
	$stmt->store_result();

	$orders = array();
	if ($stmt->num_rows > 0)
	{
		while ($stmt->fetch())
		{
			$order = array (
				"TransactionId" => htmlspecialchars($TransactionId, ENT_QUOTES) ,
				"FullName" => htmlspecialchars($FullName, ENT_QUOTES) ,
				"BookName" => htmlspecialchars($BookName, ENT_QUOTES) ,
				"AuthorName" => htmlspecialchars($AuthorName, ENT_QUOTES) ,
				"ImageLocation" => htmlspecialchars($ImageLocation, ENT_QUOTES) ,
				"Amount" => htmlspecialchars($Amount, ENT_QUOTES) ,
				"Address" => htmlspecialchars($Address, ENT_QUOTES) ,
				"City" => htmlspecialchars($City, ENT_QUOTES) ,
				"State" => htmlspecialchars($State, ENT_QUOTES) ,
				"Zip" => htmlspecialchars($Zip, ENT_QUOTES) ,
				"OrderDate" => htmlspecialchars($OrderDate, ENT_QUOTES) ,
				"PaymentStatus" => htmlspecialchars($PaymentStatus, ENT_QUOTES) ,
				"DispatchStatus" => htmlspecialchars($DispatchStatus, ENT_QUOTES) 
			);
			array_push($orders, $order);
		}
	}
	$stmt->close();
	$conn->close();
	echo json_encode($orders);
}
catch(Exception $e) 
{
	echo 'Error: ' .$e->getMessage();
}
?>