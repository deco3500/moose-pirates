<?php
ini_set('display_errors', 'Off');

session_start();

if (!isset($_SESSION['user']) || $_SESSION['authenticated'] == false) {

 header("location: login.php");

}
$status = isset($_GET['status']) ? $_GET['status'] : '';


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

$query2 = "Select * from users where email <> '". $_SESSION['user']."' AND id not IN (Select friend_id FROM friends where id IN (SELECT id from users where email = '". $_SESSION['user']."'  ))";

$result2 = mysqli_query($conn, $query2);

$query3 = "Select keyword from user_keywords where id in (SELECT id from users where email = '". $_SESSION['user'] ."'  )";

$keywords = mysqli_query($conn, $query3);

$query4 = "Select * from users where email <> '". $_SESSION['user'] ."'  AND id IN (Select friend_id FROM friends where id IN (SELECT id from users where email = '". $_SESSION['user'] ."'  ))";

$friends = mysqli_query($conn, $query4);

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
       <div class="navbar-header navbar-right" >
      <a class="navbar-brand" href="settings.php"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
    </div>
 </div>
</nav>
<?php if ($status  == 'error') { echo '<div class=" center alert alert-danger">'. $_GET['message']. '</div>';} elseif ($status  == 'success') { echo '<div class=" center alert alert-info">'. $_GET['message']. '</div>';}?>
<div class="row">
<div class="infoList col-md-6 clearfix" >
	
		<form action="insert.php" method="post">
			<label style="color: #FFF">Keyword:</label> <input type="text" name="keyword">
		<input class="pull-right" type="submit">
		</form>
        </br>
        
        <ul class="list-group">
         <?php while ($row = mysqli_fetch_assoc($keywords)) {
          		echo '<li class="list-group-item">'.$row['keyword'].' <span class="badge"><a href="deleteKeyword.php?keyword='. $row['keyword'] .'"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span></a></span></li>';
		 } ?>
        </ul>

</div>
<div class="infoList col-md-6 clearfix" >

        <form action="insertFriend.php" method="post">
			<label style="color: #FFF"> Add a Friend: </label> <select name="friend" id="friend" required>
            				  <option disabled selected>-- <?= ('Add a Friend'); ?> --</option>
                              <?php while ($row = mysqli_fetch_assoc($result2)) {
                              		echo "<option value='". $row['id'] ."'>".$row['name'] ."</option>";
							  } ?>
                            </select>
                           
		<input class="pull-right" type="submit">
		</form>
        </br>
        
        <ul class="list-group">
         <?php while ($row = mysqli_fetch_assoc($friends)) {
          		echo '<li class="list-group-item">'.$row['name'].' <span class="badge"><a href="deletefriend.php?friend='.$row['id'].'"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span></a></span></li>';
		 } ?>
        </ul>

</div>
</div>



</body>
</html>