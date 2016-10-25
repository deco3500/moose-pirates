<?php
ini_set('display_errors', 'Off');

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

  if (isset($_SESSION['user']) && $_SESSION['authenticated'] == true) {
    header("Location: index.php");
  } else {
    //Check that the user has entered an email and a password
    if (isset($_POST['email']) && isset($_POST['password'])) {
      $email = $_POST['email'];
      $password = md5($_POST['password']);
      $query = "SELECT * FROM users WHERE email ='".$email."';";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        die(mysqli_error($conn));
      } else {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['password'] == $password) {
            $_SESSION['authenticated'] = true;
          }
        }
      }



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
		<form class="form-signin" method="POST" action="login.php">
                <h3 class="form-signin-heading">Please sign in</h3>
                <?php 
				      if ($result && $_SESSION['authenticated']) {
							$_SESSION['user'] = $_POST['email'];
							header('Location: index.php');
						  } else if ($result) {
							echo "</br><p style='color: white;'>Incorrect Username/Password</p>";
						  }
				?>
                <label for="inputEmail" class="text-info">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                <label for="inputPassword" class="text-info">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                <div class="checkbox">
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <br>
                <p>Don't have an account? <a href="signUp.php">Sign Up Here</a></p>
        </form>
        </div>
        
       	<div id="introduction" class="col-md-5">
         
                <div style="padding-left: 30px;">
                    <h3>Sign Up Now!</h3>
                    <h3>It's free and always will be</h3><br>
					<ul>
					<article>Get latest news everyday!</article>
					<article>News based on your key interest.</article>
					<article>Get connected with your friends.</article>
					<article>Share it through Facebook and Twitter</article>
					</ul>
                    </br>
                    <a href="signUp.php" class="btn btn-lg btn-primary btn-block" >Sign Up</a>
                </div>
                
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

</div>
</body>
</html>
