<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\CreditCard;

require __DIR__  . '/vendor/app/start.php';

	include 'common.php';
	//include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	//csrfguard_start();
	
$userId =  $_SESSION["userid"];
if (strpos($userId, 'Undefined index:') !== false) {
	echo "userid";
	header("Location: index.php");
	die();
}

$paynow =  $_SESSION["paynow"];
if ( $paynow !== "ok") {
	echo "paynow";
	header("Location: index.php");
	die();
}
$_SESSION["paynow"] = "";

$cartItems = getCartItemsForTheUser($userId);
if (count ($cartItems) < 1) {
	echo "cartItems";
	header("Location: index.php");
	die();
}

//begin paypal
$payer = new Payer();
$payer->setPaymentMethod('paypal');

//alternative: creditcard
/*$card = new CreditCard();
$card->setType("visa") 
	->setNumber("4148529247832259") 
	->setExpireMonth("11") 
	->setExpireYear("2019") 
	->setCvv2("012") 
	->setFirstName("Joe") 
	->setLastName("Shopper");
	
$fi = new FundingInstrument();
$fi->setCreditCard($card);

$payer = new Payer();
$payer->setPaymentMethod("credit_card")
	->setFundingInstruments(array($fi));

*/
$items = array();
$subtotal = 0;
foreach ($cartItems as $b) {
    if ((int)$b['Availability'] > 0)
	{
		$subtotal += (float)$b['Price'];
	}
	$item = new Item();
	$item->setName($b['BookName'])
	->setCurrency('USD')
	->setQuantity(1)
	->setTax(0.1)
	->setPrice($b['Price']);
	
	array_push($items, $item);
}
$shipping = 2.00;
$tax = ((float)$subtotal + (float) $shipping) * 0.10;
$tax = round($tax, 2);
$total = (float)$tax + (float)$subtotal + (float)$shipping;
	
$itemList = new ItemList();
$itemList->setItems($items);

$details = new Details();
$details->setShipping($shipping)
	->setTax($tax)
	->setSubtotal($subtotal);
	
$amount = new Amount();
$amount->setCurrency("USD")
	->setTotal($total)
	->setDetails($details);
	
$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription("Payment description")
	->setInvoiceNumber(uniqid());
	
	
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . "/pay.php?success=true")
	->setCancelUrl(SITE_URL . "/pay.php?success=false");
	
$payment = new Payment(); 
$payment->setIntent("sale") 
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions(array($transaction));

try { 
	$payment->create($paypalApiContext); 
} 
catch (Exception $ex) {
	die($ex);
}

$approvalUrl = $payment->getApprovalLink();
//echo $approvalUrl;

header("Location: {$approvalUrl}");