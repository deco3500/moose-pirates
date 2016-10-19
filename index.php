<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['authenticated'] == false) {

 header("location: login.php");

}

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

$query2 = "Select id from users where email = '". $_SESSION['user']."'";

$result2 = mysqli_query($conn, $query2);

$request = NULL;

while ($row = mysqli_fetch_assoc($result2)) {
$query = "Select keyword from user_keywords where id in (Select friend_id FROM friends where id = ". $row['id'].") OR id = ". $row['id']."
";

}

$result = mysqli_query($conn, $query);



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
    <div class="row">
        <div class="col-md-11">
        <div>
        <div class="row">
        <?php
		if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			require_once 'HTTP/Request2.php';
			
			$request = new Http_Request2('https://api.cognitive.microsoft.com/bing/v5.0/news/search');
			$url = $request->getUrl();
			
			$headers = array(
				// Request headers
				'Ocp-Apim-Subscription-Key' => '2d1dd243b2d14531a77d2655db73d8d4',
			);
			
			$request->setHeader($headers);
			
			$parameters = array(
				// Request parameters
				'q' => $row['keyword'],
				'count' => '8',
				'offset' => '0',
				'mkt' => 'en-us',
				'safeSearch' => 'Moderate',
			);
			
			$url->setQueryVariables($parameters);
			
			$request->setMethod(HTTP_Request2::METHOD_GET);
			
			// Request body
			$request->setBody("{body}");
					try
					{
					$response = $request->send();
					$news = json_decode ($response->getBody(), 1);
					
					if (empty($news)){
						echo "please set your keywords in settings to see articles that relate to your specific intrests";
					}
					else{
					$news = json_decode ($response->getBody(), 1);
	
						foreach ($news['value'] as $acc) {
						if (isset($acc['image']['thumbnail']['contentUrl'])){
							echo "<div class='col-md-3 col-sm-4 news_tile image'>";
							echo "<img src='" . $acc['image']['thumbnail']['contentUrl'] . "' height='100%' width='100%'</img>";
							echo  "<h2><span><a href='". $acc['url'] ."' target='_blank'>" . $acc['name'] . "</a></span></h2>";
							echo "</div>";
							
						}
			
						}
							}
					}
					catch (HttpException $ex)
					{
						
						echo $ex;
			}
		}
		} else{
			echo "<h3>Please set your keywords in settings to see articles that relate to your specific intrests</h3>";
			
		}
		?>
        </div>
        </div>
        
		</div>
        <div class="col-md-1 center" style=" text-align:center">
                  <div class="sidebar-nav-fixed pull-right affix">
                <div class="well">
                    <ul class="nav ">
                        <li> <a class="btn btn-social-icon btn-lg btn-facebook"><span class="fa fa-facebook"></span></a>
                        </li>
                        <li><a class="btn btn-social-icon btn-lg btn-reddit"><span class="fa fa-reddit"></span></a> 
                        </li>
                        <li><a class="btn btn-social-icon btn-lg btn-google"><span class="fa fa-google"></span></a>
                        </li>
                        <li><a class="btn btn-social-icon btn-lg btn-twitter"><span class="fa fa-twitter"></span></a>
                        </li>
                        <li><a class="btn btn-social-icon btn-lg btn-instagram"><span class="fa fa-instagram"></span></a> 
                        </li>
                    </ul>
                </div>
                <!--/.well -->
        </div>

</div>
</body>
</html>
