<?php
session_start();
unset($_SESSION['error']);
unset($_SESSION['authenticated']);
unset($_SESSION['user']);
header('Location: index.php');

?>