<?php
	include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();

$userId =  $_SESSION["userid"];
if (strpos($userId, 'Undefined index:') !== false) {
	die("User not logged in");
}
$cartItems = getCartItemsForTheUser($userId);
$subtotal = 0;
foreach ($cartItems as $b) {
    if ((int)$b['Availability'] > 0)
	{
		$subtotal += (float)$b['Price'];
	}
}
$shipping = 2.00;
$tax = ((float)$subtotal + (float) $shipping) * 0.10;
$tax = round($tax, 2);
$total = (float)$tax + (float)$subtotal + (float)$shipping;
echo json_encode(
	array (
		"cartItems" => $cartItems,
		"subtotal" => htmlspecialchars($subtotal, ENT_QUOTES),
		"shipping" => htmlspecialchars($shipping, ENT_QUOTES),
		"tax" => htmlspecialchars($tax, ENT_QUOTES),
		"total" => htmlspecialchars($total, ENT_QUOTES)
	)
);

?>