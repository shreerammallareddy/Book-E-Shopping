<?php
echo 'Current PHP version: ' . phpversion();
$servername = "student-db.cse.unt.edu";
$username = "sm1030";
$password = "sm1030";
$dbname = "sm1030";

echo "server: ".$servername."<br>";
echo "user: ".$username."<br>";
echo "pass: ".$password."<br>";
echo "db: ".$dbname."<br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else
{
$conn->close();
echo "connected";
}
?>