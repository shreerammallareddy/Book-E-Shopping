<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

include 'common.php';

require __DIR__  . '/vendor/app/start.php';

if ( is_session_started() === FALSE ) session_start();

if (!isset($_GET["success"]) ||  !isset($_GET["paymentId"]) || !isset($_GET["PayerID"])) 
{
	header("Location: index.php");
	die();
}

if ($_GET["success"] !== "true")
{
	if ( is_session_started() === FALSE ) session_start();
	$_SESSION["paymentmade"] = "failed";
	//echo "Payment failed";
	header("Location: completepayment.php");
	die();
}
$token = !isset($_GET["token"]) ? "": $_GET["token"];
$paymentId = $_GET["paymentId"];
$payerId = $_GET["PayerID"];

$servername = "localhost";
$username = "myself";
$password = "myself";
$dbname = "wordpress";

$conn = getMysqliConn();

$query1 = "SELECT OrderId FROM `order_master` WHERE TransactionId=?";

$stmt1 = $conn->prepare($query1);
$stmt1->bind_param("s", $paymentId);
$stmt1->execute();
$result = $stmt1->bind_result($orderId);
$stmt1->store_result();
$greater = $stmt1->num_rows > 0;

/*if ($greater)
{
	$_SESSION["paymentmade"] = "paymentAlreadyProcessed";
	//echo "payment";
	header("Location: completepayment.php");
	die();
}*/



$payment = Payment::get($paymentId, $paypalApiContext);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);
try
{
	//$result = $payment->execute($execute, $paypalApiContext);
}
catch (Exception $ex)
{
	die($ex);
}


$userId =  $_SESSION["userid"];

$shippingInfo = $_SESSION["shippingInfo"];

$shipping = json_decode($shippingInfo, true);

$orderQuery = 
"INSERT INTO `order_master`(`CustomerId`, `TransactionId`, `PayerId`, `Token`, 
`Amount`, `FullName`, `Address`, `City`, `State`, `Zipcode`, `Contact`, 
`PaymentStatus`, `DispatchStatus`, `CancelStatus`, `OrderDate`)
VALUES ('{$userId}','{$paymentId}','{$payerId}','{$token}','0',?,?,?,?,?,?,'Paid','In Progress','N/A', NOW());";

$cartItems = getCartItemsForTheUser($userId);
//echo (json_encode($cartItems));


$conn->autocommit(FALSE);
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("ssssss", $shipping["fullname"], $shipping["address"], $shipping["city"], 
	$shipping["state"], $shipping["zipcode"], $shipping["contactNumber"]);
$stmt->execute();
$newOrderId = mysqli_insert_id($conn);
//echo "new order id: ".$newOrderId."<br>";
$stmt->close();

foreach ($cartItems as $b) {
    if ((int)$b['Availability'] > 0)
	{
		$bookid = $b['BookId'];
		
		$stmt = $conn->prepare("INSERT INTO `order_details`(`OrderId`, `ItemId`) VALUES ('{$newOrderId}','{$bookid}')");
		$stmt->execute();
		$stmt->close();
		
		$stmt = $conn->prepare("UPDATE `book_master` SET `Availability`=`Availability` - 1,`TotalSold`= `TotalSold` + 1 WHERE BookId = '{$bookid}'");
		$stmt->execute();
		$stmt->close();
	}
}

/* commit transaction */
if (!$conn->commit()) {
    print("Transaction commit failed\n");
    exit();
}

$conn->close();

deleteCartItemsForTheUser($userId);
$_SESSION["shippingInfo"] = "";
$_SESSION["paymentmade"] = "success";
//echo "Payment made";
header("Location: completepayment.php");
?>