<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/../autoload.php';

define('SITE_URL', 'http://students.cse.unt.edu/~sm1030/Bookeshopping');

// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
$paypalApiContext = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		'AeVLJmUE5Utq2Att2K3vXXl-_xn5k72ULzKyZQ3FOR67PO40cHsax27Z3BmLEURvgnEtWr8yzRqxf8UI', //clientId
		'EJYkE8x4vggeIAqcReV8omvPO2FSdy5HXujL_pL_et9in6PmxJi1xEOxLo5DvgCzE3PVz6A_5FS-dsaX' 	//clientSectert
	)
);

// Step 2.1 : Between Step 2 and Step 3
$paypalApiContext->setConfig(
  array(
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'DEBUG'
  )
);
?>