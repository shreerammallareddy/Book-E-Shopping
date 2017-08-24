<?php

//echo json_encode(session_status())."<br>";
//echo json_encode(phpversion())."<br>";
//echo json_encode(session_id())."<br>";
include 'common.php';

if ( is_session_started() === FALSE ) session_start();

// remove all session variables
session_unset();
// destroy the session
session_destroy();

echo json_encode("sign out");
?>