<?php
session_start();


$keyword = $_GET['keyword'];

$key = array_search($keyword, $_SESSION['keywords']);

if( $key !== false) {
    unset($_SESSION['keywords'][$key]);
}

$message = "Keyword Set";
header("location: test.php?test=success&message=". urlencode($message) ."");
	
		
?>
