<?php

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



$query = "Select keyword from user_keywords where id = 1";

$result = mysqli_query($conn, $query);




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
		<form class="form-signin" method="POST" action="actionLogin.php">
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