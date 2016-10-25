<?php
session_start();


$keyword = $_GET['keyword'];

if (!in_array($keyword, $_SESSION['keywords'])){
array_push($_SESSION['keywords'], $keyword);
}
$message = "Keyword Set";
header("location: test.php?test=success&message=". urlencode($message) ."");
	
?>
