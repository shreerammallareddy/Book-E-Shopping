<?php

include '../common.php';
include '../csrfguard.php';
if ( is_session_started() === FALSE ) session_start();
csrfguard_start();

$book = htmlspecialchars($_POST['book'], ENT_QUOTES);
$auth = htmlspecialchars($_POST['auth'], ENT_QUOTES);
$avail = htmlspecialchars($_POST['avail'], ENT_QUOTES);

// Create connection from common.php
$conn = getMysqliConn();
$stmt = $conn->prepare("update book_master set availability = ? where bookname =? and authorname=?");
$stmt->bind_param("sss",$avail, $book, $auth);
$stmt->execute();

$stmt->close();
$conn->close();
?>