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


// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
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
        <div class="col-md-10">
        <h3> News Feed </h3>
        <div>
        <div class="row">
        <?php
	
		
		try
		{
		$response = $request->send();
		$news = json_decode ($response->getBody(), 1);
		file_put_contents('function.log', date('H:i:s') . __FUNCTION__ . __LINE__ . print_r($news  , true) . "\n", FILE_APPEND);
			foreach ($news['value'] as $acc) {
				echo "<div class='col-md-3 center'>";
                echo "<img src='" . $acc['image']['thumbnail']['contentUrl'] . "' height='200' width='200' </img>";
				echo  "<p><a href='". $acc['url'] ."' target='_blank'>" . $acc['name'] . "</a></p>";
				echo "</div>";
			    file_put_contents('function.log', date('H:i:s') . __FUNCTION__ . __LINE__ . print_r($acc['name']  , true) . "\n", FILE_APPEND);

				}
		}
		catch (HttpException $ex)
		{
			echo $ex;
		}
		?>
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
