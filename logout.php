<?php
session_start();
unset($_SESSION['error']);
unset($_SESSION['authenticated']);
unset($_SESSION['user']);
unset($_SESSION['keywords']);
header('Location: index.php');

?>