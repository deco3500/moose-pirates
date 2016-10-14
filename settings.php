<?php
ini_set('display_errors', 'Off');

session_start();

if (!isset($_SESSION['user']) || $_SESSION['authenticated'] == false) {

 header("location: adminLogin.php");

}
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!doctype html>
<html>
<head>

<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta charset="UTF-8">
<title>Moose Pirates</title>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    <div class="header_logo" id="logo">
					<a href="index.php">
						<img src="image/moose_news.png" class="img-responsive"  alt="Moose Pirates" style="height:75px">
						</a>
				</div>
    </div>
    </div>
       <div class="navbar-header navbar-right">
      <a class="navbar-brand" href="settings.php"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
    </div>
 </div>
</nav>

<div class="center" >
	<?php if ($status  == 'error') { echo '<div class="alert alert-danger">'. $_GET['message']. '</div>';} elseif ($status  == 'success') { echo '<div class="alert alert-info">'. $_GET['message']. '</div>';}?>
		<form action="insert.php" method="post">
			Keyword: <input type="text" name="keyword"><br>
		<input type="submit">
		</form>

</div>


</body>
</html>