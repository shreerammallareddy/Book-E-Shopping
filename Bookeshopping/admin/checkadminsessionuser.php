<?php
include '../common.php';
include '../csrfguard.php';
if ( is_session_started() === FALSE ) session_start();
csrfguard_start();

$isAdmin = $_SESSION["isAdmin"];
if ($isAdmin == "1")
{
	echo "Yes";
}
else
{
	echo "No";
}
?>