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

      if ($result && $_SESSION['authenticated']) {
        $_SESSION['user'] = $_POST['email'];
        header('Location: index.php');
      } else {
        echo "Incorrect Username/Password";
      }

    }

}

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
  <div class="container-fluid" >
    <div class="navbar-header" >
    <div class="header_logo" id="logo">
					<a href="index.php">
						<img src="image/moose_news.png" class="img-responsive"  alt="Moose Pirates" style="height:75px">
						</a>
				</div>
    </div>
       <div class="navbar-header navbar-right" >
      <a class="navbar-brand" href="settings.php" ><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true" style="font-size:40px"></span></a>
    </div>
 </div>
</nav>
    <div class="row">
        <div class="col-md-10">
        <div>
        <div class="row">
        <div class="col-md-4">
		<form class="form-signin" method="POST" action="login.php">
                <h2 class="form-signin-heading">Please sign in</h2>
                <label for="inputEmail" class="text-info">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                <label for="inputPassword" class="text-info">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="remember-me"> Remember me
                  </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <br>
                <p>Don't have an account? <a href="signUp.php">Sign Up Here</a></p>
        </form>
        </div>
        </div>
        </div>
        
		</div>
        <div class="col-md-2">
        	<a href="http://www.facebook.com"><div id="facebook" class="tile">
            Facebook
			</div></a>  
            <a href="http://www.youtube.com"><div id="youtube" class="tile">
            Youtube
			</div></a>
            <a href="http://www.google.com"><div id="google" class="tile">
            Google
			</div></a>
            <a href="http://www.imdb.com"><div id="imdb" class="tile">
            IMDB
			</div></a>     
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