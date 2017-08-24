<?php

include '../common.php';
include '../csrfguard.php';
if ( is_session_started() === FALSE ) session_start();
csrfguard_start();

$book = htmlspecialchars($_POST['book'], ENT_QUOTES);
$auth = htmlspecialchars($_POST['auth'], ENT_QUOTES);
$price = htmlspecialchars($_POST['price'], ENT_QUOTES);
$avail = htmlspecialchars($_POST['avail'], ENT_QUOTES);
$image = htmlspecialchars($_POST['image'], ENT_QUOTES);
$imageLocation = (image == "")? "Images/No_Image.png" : "Images/".$image;

// Create connection from common.php
$conn = getMysqliConn();
$stmt = $conn->prepare("INSERT INTO `book_master`(`BookName`, `AuthorName`, `Price`, `Availability`, `TotalSold`, `ImageLocation`) 
VALUES (?,?,?,?,'0',?)");
$stmt->bind_param("sssss",$book, $auth, $price, $avail, $imageLocation);
$stmt->execute();
echo "success";
$stmt->close();
$conn->close();
?>