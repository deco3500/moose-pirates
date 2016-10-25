<?php
ini_set('display_errors', 'Off');
session_start();

if (isset($_SESSION['user']) || $_SESSION['authenticated'] == true) {

 header("location: index.php");

}


$_SESSION['keywords']  = $_SESSION['keywords']  ?: array();



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
      <a href="login.php" class="btn btn-lg btn-primary btn-block" style="margin-top:15px; background-color: #333">Sign In</a>
    </div>
 </div>
</nav>
    <div class="row" style="margin-left:10px">
    	<div class="col-md-3" style="padding-top: 50px">
        
        <form action="insertSession.php" method="post">
			<label style="color: #FFF">Keyword:</label> <input type="text" name="keyword">
		<input class="pull-right" type="submit">
		</form>
        </br>
        
        <ul class="list-group">
         <?php 
	
		 
		 foreach( $_SESSION['keywords'] as $row ) {
          		echo '<li class="list-group-item">'. $row .' <span class="badge"><a href="deleteSessionKeyword.php?keyword='. $row .'"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span></a></span></li>';
		 } ?>
        </ul>
        
        </br>
        
        <h3> Trending Key Words</h3>
        
        <ul class="list-group">
        	<li class="list-group-item"> Batman <span class="badge"><a href="insertSessionKeyword.php?keyword=Batman"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></li>
            <li class="list-group-item"> Joss Whedon <span class="badge"><a href="insertSessionKeyword.php?keyword= <?php echo urlencode('Joss Whedon')?>"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></li>
            <li class="list-group-item"> Moose News <span class="badge"><a href="insertSessionKeyword.php?keyword=<?php echo urlencode('Moose News')?>"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></li>
            <li class="list-group-item"> The Great Escape <span class="badge"><a href="insertSessionKeyword.php?keyword=<?php echo urlencode('The Great Escape')?>"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></li>
            <li class="list-group-item"> Donald Trump <span class="badge"><a href="insertSessionKeyword.php?keyword=<?php echo urlencode('Donald Trump')?>"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></li>
		
        </ul>
        
        <p> To be able to save your keywords create an account </p>
         </br>
                    <a href="signUp.php" class="btn btn-lg btn-primary btn-block" >Sign Up</a>
        </div>
        <div class="col-md-8">
        <div>
        <div class="row">
        <?php
			 if (empty($_SESSION['keywords'])) {
			 echo '<h3 style="margin-top: 50px">Please Set your keywords on the right to see articles that relate to your intrests </br></br> For the full experince we recommed creating an account and saving your Keywords, this will save you doing it next time </br></br> Moose News is designed to act as a homepage to make it even easier for you to receive your news</h3> ';
			 
		 }
		 
		foreach( $_SESSION['keywords'] as $row ) {
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
				'q' => $row,
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
							echo "<div class='col-md-4 col-sm-4 col-lg-3 col-xl-3 news_tile image'>";
							echo "<img src='" . $acc['image']['thumbnail']['contentUrl'] . "' height='100%' width='100%'</img>";
							echo  "<h2 class='ban1'><span><a href='". $acc['url'] ."' target='_blank'>" . $acc['name'] . "</a></span></h2>";
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
		
		?>
        </div>
        </div>
        
		</div>
        <div class="col-md-1 center" style=" text-align:center">
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
</body>
</html>
