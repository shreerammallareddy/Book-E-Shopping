<?php
try
{
		include 'common.php';
	include 'csrfguard.php';
	if ( is_session_started() === FALSE ) session_start();
	csrfguard_start();

	$searchtext = htmlspecialchars($_POST['searchtext'], ENT_QUOTES);
	$search = htmlspecialchars($_POST['search'], ENT_QUOTES);

	// Create connection from common.php
	$conn = getMysqliConn();

	$query = "";
	if ($search == 0 || $search == 2)
	{
		$query = "SELECT `BookId`, `BookName`, `AuthorName`, `Price`, `Availability`, `TotalSold`, `ImageLocation`, `CategoryName` 
		FROM `book_master` where Availability > 0 order by TotalSold DESC";
	}
	else if ($search == 1)
	{
		$query = "SELECT `BookId`, `BookName`, `AuthorName`, `Price`, `Availability`, `TotalSold`, `ImageLocation`, `CategoryName` 
		FROM `book_master` where Availability > 0 and (BookName like ? or AuthorName like ?) order by Availability DESC";
	}
	else if ($search == 3)
	{
		$query = "SELECT `BookId`, `BookName`, `AuthorName`, `Price`, `Availability`, `TotalSold`, `ImageLocation`, `CategoryName`
		FROM `book_master` where Availability > 0  and CategoryName=? order by TotalSold DESC";
	}
	else if ($search == 4)
	{
		$query = "SELECT `BookId`, `BookName`, `AuthorName`, `Price`, `Availability`, `TotalSold`, `ImageLocation`, `CategoryName` 
		FROM `book_master` ORDER BY BookName ASC";
	}

	$stmt = $conn->prepare($query);
	if ($search == 1) $stmt->bind_param("ss", $searchtext, $searchtext);
	else if ($search == 3) $stmt->bind_param("s", $searchtext);
	$stmt->execute();
	$result = $stmt->bind_result($BookId, $BookName, $AuthorName, $Price, $Availability, $TotalSold, $ImageLocation, $CategoryName);
	$stmt->store_result();

	$books = array();
	if ($stmt->num_rows > 0)
	{
		while ($stmt->fetch())
		{
			$book = array(
				"BookId" 		=> htmlspecialchars($BookId, ENT_QUOTES),
				"BookName" 		=> htmlspecialchars($BookName, ENT_QUOTES),
				"AuthorName" 	=> htmlspecialchars($AuthorName, ENT_QUOTES),
				"Availability" 	=> htmlspecialchars($Availability, ENT_QUOTES),
				"TotalSold" 	=> htmlspecialchars($TotalSold, ENT_QUOTES),
				"ImageLocation" => htmlspecialchars($ImageLocation, ENT_QUOTES),
				"Price" 		=> htmlspecialchars($Price, ENT_QUOTES)
			);
			array_push($books, $book);
		}
	}
	echo json_encode($books);
	$stmt->close();
	$conn->close();
}
catch(Exception $e) {
  echo 'Error: ' .$e->getMessage();
}
?>