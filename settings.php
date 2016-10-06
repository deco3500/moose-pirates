<?php
ini_set('display_errors', 'Off');
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
      <a class="navbar-brand" href="index.php">Moose Pirates</a>
      
    </div>
       <div class="navbar-header" style="text-align: right;">
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