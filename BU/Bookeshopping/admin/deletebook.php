<?php
include '../common.php';
include '../csrfguard.php';
if ( is_session_started() === FALSE ) session_start();
csrfguard_start();

$book = htmlspecialchars($_POST['book'], ENT_QUOTES);
$auth = htmlspecialchars($_POST['auth'], ENT_QUOTES);
if ($book=="" || $auth =="") 
{
	echo "Please provide values.";
	die();
}
$conn = getMysqliConn();
$stmt = $conn->prepare("delete from  book_master  where bookname =? and authorname=?");
$stmt->bind_param("ss", $book, $auth);
$stmt->execute();

$stmt->close();
$conn->close();
?>