<?php

$servername = "localhost";
$username = "root"; //Eneter Username for ESSCC Earthquake DB
$database="moose-pirates";
$password="MYPASSWORD123";

// Create connection
$conn = new mysqli($servername, $username, $password);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db( $conn, "moose-pirates") or die( "Unable to select database");

$keyword = $_POST['keyword'];

$query = "UPDATE user_keywords SET keyword = '" . $keyword . "'where id = 1";

$result = mysqli_query($conn, $query);

    	if (!$result) {
    		$error = mysqli_error($conn);
    	header("location: settings.php?status=error&message=". urlencode($error) ."");
    	}
    	$message = "Keyword Set";
    	header("location: settings.php?status=success&message=". urlencode($message) ."");
		
?>
