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

$friend = $_GET['friend'];

$query = "DELETE FROM friends WHERE id IN (SELECT id from users where email = '". $_SESSION['user']."') AND friend_id = '".$friend."'";

$result = mysqli_query($conn, $query);


    	if (!$result) {
    		$error = mysqli_error($conn);
    	header("location: settings.php?status=error&message=". urlencode($error) ."");
    	}
    	$message = "Friend ". $friend ." Removed";
    	header("location: settings.php?status=success&message=". urlencode($message) ."");
		
?>
