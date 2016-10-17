<?php
session_start();

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

$keyword = $_GET['keyword'];

file_put_contents('function.log', date('H:i:s') . __FUNCTION__ . __LINE__ . print_r($keyword , true) . "\n", FILE_APPEND);

$query = "DELETE FROM user_keywords WHERE id IN (SELECT id from users where email = '". $_SESSION['user']."') AND keyword = '".$keyword."'";

$result = mysqli_query($conn, $query);

file_put_contents('function.log', date('H:i:s') . __FUNCTION__ . __LINE__ . print_r($result , true) . "\n", FILE_APPEND);


    	if (!$result) {
    		$error = mysqli_error($conn);
    	header("location: settings.php?status=error&message=". urlencode($error) ."");
    	}
    	$message = "Keyword Removed";
    	header("location: settings.php?status=success&message=". urlencode($message) ."");
		
?>
