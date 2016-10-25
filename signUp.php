<?php

 session_start();
  
$servername = "localhost";
$username = "root"; 
$database="moose-pirates";
$password="MYPASSWORD123";

// Create connection
$conn = new mysqli($servername, $username, $password);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db( $conn, "moose-pirates") or die( "Unable to select database");

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Check to see if the user is already logged in. If so, redirect them to the index page.
if (isset($_SESSION['user']) && $_SESSION['authenticated'] == true) {
  header("Location: index.php");
}

//Make sure user has entered all details - sign user up into DB and redirect them to index.php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
  $password = md5($_POST['password']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);


  $query = "INSERT INTO users VALUES(NULL, '".$name." ','".$email."', '".$password."' )";

  $result = mysqli_query($conn, $query);

  //Check for DB insertion errors
  if (!$result) {
    $_SESSION['error'] = mysqli_error($conn);
    header("Location: signUp.php");
  } else {
    unset($_SESSION['error']);
    $_SESSION['user'] = $_POST['email'];
    $_SESSION['authenticated'] = true;
    header('Location: index.php');
  }
}


 ?>




<!doctype html>
<html>
<head>

<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link href="css/docs.css" rel="stylesheet" >
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-social.css" type="text/css" />
<meta charset="UTF-8">
<title>Moose Pirates</title>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid" >
    <div class="navbar-header" >
    <div class="header_logo" id="logo">
					<a href="index.php">
						<img src="image/moose_news.png" class="img-responsive"  alt="Moose Pirates" style="height:75px">
						</a>
				</div>
    </div>
       <div class="navbar-header navbar-right" >
      <a href="login.php" class="btn btn-lg btn-primary btn-block" style="margin-top:15px; background-color: #333 ">Sign In</a>
    </div>
 </div>
</nav>
    <div class="row">
        <div class="col-md-11">
        <div>
        <div class="row">
        <div class="col-md-4">
	<div class="container">
    
        <?php
      if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
      }
     ?>

      <form class="form-signin" method="POST" action="signUp.php">
        <h3 class="form-signin-heading">Sign Up</h3>
        <label for="fnameInput" class="text-info">Name</label>
        <input type="text" id="fnamInput" class="form-control" name="name" placeholder="Name" required autofocus>
        <br>
        <label for="inputEmail" class="text-info">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <br>
        <label for="inputPassword" class="text-info">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br>
        <p>Already have an account? <a href="login.php">Login Here</a></p>

      </form>


    </div> <!-- /container -->
        </div>
        </div>
        </div>
        
		</div>
        <div class="col-md-1 center">
                  <div class="sidebar-nav-fixed pull-right affix">
                <div class="well">
                    <ul class="nav ">
                        <li> <a href="http://www.facebook.com" target='_blank' class="btn btn-social-icon btn-lg btn-facebook"><span class="fa fa-facebook"></span></a>
                        </li>
                        <li><a href="http://www.reddit.com" target='_blank' class="btn btn-social-icon btn-lg btn-reddit"><span class="fa fa-reddit"></span></a> 
                        </li>
                        <li><a href="http://www.google.com" target='_blank' class="btn btn-social-icon btn-lg btn-google"><span class="fa fa-google"></span></a>
                        </li>
                        <li><a href="http://www.twitter.com" target='_blank' class="btn btn-social-icon btn-lg btn-twitter"><span class="fa fa-twitter"></span></a>
                        </li>
                        <li><a href="http://www.instagram.com" target='_blank' class="btn btn-social-icon btn-lg btn-instagram"><span class="fa fa-instagram"></span></a> 
                        </li>
                    </ul>
                </div>
                <!--/.well -->
        </div>    
        </div>

</div>
</body>
</html>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>