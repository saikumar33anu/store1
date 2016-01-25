<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>comparision store</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0-rc.1/angular.min.js"></script>
    <script src="js/app.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body ng-app="store">
      <img src="gjicon.jpg" id="icon" alt="GJicon">
    <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Home</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="comparision.php">COMPARE</a></li>
            <li id="abt"><a href="About.html">ABOUT</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
      </nav>
   <div ng-include="'nav.html'"></div>


<?php 

	$search = $_POST["name"];
	$middle = explode(" ", $search);
	$replaced = join("+",$middle);

	$url = "http://www.amazon.in/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=".$replaced;
 

	$response = getPriceFromAmazon($url);	 
	$initialPrice = $response[0];
	$initialtitle = $response[1];
	// echo json_encode($response2);
	 
	/* Returns the response in JSON format */
 
		function getPriceFromAmazon($url) {
		 
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10");
			curl_setopt($curl, CURLOPT_FAILONERROR, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$html = curl_exec($curl);
			curl_close($curl);
		 
			$regex='/<span class="a-size-base a-color-price s-price a-text-bold"><span.*?><\/span>(.*?)/';
			preg_match_all($regex, $html, $price, PREG_SET_ORDER);
			
		 
			  $regex = '/<h2 class="a-size-medium a-color-null s-inline s-access-title a-text-normal"[^>]*>([^<]*)<\/h2>/';
			  preg_match_all($regex, $html, $title, PREG_SET_ORDER);
		 
			 // $regex = '/data-src="([^"]*)"/i';
			 // preg_match($regex, $html, $image);
		 
			 if ($price) {
			 		// $intialResponse = $price[0][0];
			 		// $middleResponse = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
			 		// $finalResponse = $middleResponse * 0.01;
			 		$response = array($price,$title);
					
			 } else {
			 	$response = array("status" => "404", "error" => "We could not find the product details on Flipkart $url");
			 }
			// return $response2;
			 return $response;
			// return $response2;
	}

		$url2 = "http://www.snapdeal.com/search?keyword=".$replaced."&santizedKeyword=&catId=&categoryId=&suggested=false&vertical=&noOfResults=48&clickSrc=go_header&lastKeyword=&prodCatId=&changeBackToAll=false&foundInAll=false&categoryIdSearched=&cityPageUrl=&url=&utmContent=&dealDetail=&sort=rlvncy";
 

	$response2 = getPriceFromSnapdeal($url2);
	// echo json_encode($response);	 
	// echo json_encode($responsejson_encode2);
	 $initialPrice2 = $response2[0];
	$initialtitle2 = $response2[1];
	/* Returns the response in JSON format */
 
		function getPriceFromSnapdeal($url2) {
		 
			$curl2 = curl_init($url2);
			curl_setopt($curl2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10");
			curl_setopt($curl2, CURLOPT_FAILONERROR, true);
			curl_setopt($curl2, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$html = curl_exec($curl2);
			curl_close($curl2);
		 
			$regex='/<span class="product-price">(.*?)<\/span>/';
			preg_match_all($regex, $html, $price2, PREG_SET_ORDER);
			
		 
			  $regex = '/<p class="product-title"[^>]*>([^<]*)<\/p>/';							  
			  preg_match_all($regex, $html, $title2, PREG_SET_ORDER);
		 
			 // $regex = '/data-src="([^"]*)"/i';
			 // preg_match($regex, $html, $image);
		 
			  if ($price2 ) {
			// 	$finalResponse = $price[3][1];
			// 		// $intialResponse = $price[0][0];
			// 		// $middleResponse = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
			// 		// $finalResponse = $middleResponse * 0.01;
			// 	// $middleTitle = $title[3][1];
			// 	// $finalTitle = substr($middleTitle,0,-1);
			 	$response2 = array($price2,$title2);
				// 	$response = $price;
			  } else {
			  	$response = array("status" => "404", "error" => "We could not find the product details on Flipkart $url");
			  }
			  // return $response;
			return $response2;
	}

	?>
	

	<div class="main">
		<h3 class="text-left">
		Top results for <b><?php $search = $_POST["name"]; echo $search; ?></b>:
		</h3>
		<h5>Top 7 results will be displayed related to your search....so be particular</h5>
		<div class="main_box">
			<div class="row">
				<div class="col-md-6">
					
					<div class="list">			
						<h2><?php
							
							$secondTitle = $initialtitle[0][0];
						 echo $secondTitle;
					    ?></h2>	
					    <p style="margin-top:60px;"><img src="images/amazon.jpg"> Rs.<?php 	
					    $secondPrice = $initialPrice[0][0];
							// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
							// $finalPrice = $middlePrice * 0.01;
							echo $secondPrice;
					    ?></p>
					</div>
					<div class="list">			
						<h2><?php
							
							$secondTitle = $initialtitle[1][0];
						 echo $secondTitle;
					    ?></h2>	
					    <p style="margin-top:60px;"><img src="images/amazon.jpg">Rs.<?php 	
					    $secondPrice = $initialPrice[1][0];
							// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
							// $finalPrice = $middlePrice * 0.01;
							echo $secondPrice;
					    ?></p>
					</div>
					<div class="list">			
						<h2><?php
							
							$secondTitle = $initialtitle[2][0];
						 echo $secondTitle;
					    ?></h2>	
					    <p style="margin-top:60px;"><img src="images/amazon.jpg">Rs.<?php 	
					    $secondPrice = $initialPrice[2][0];
							// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
							// $finalPrice = $middlePrice * 0.01;
							echo $secondPrice;
					    ?></p>
					</div>
					<div class="list">			
					<h2><?php
						
						$secondTitle = $initialtitle[3][0];
					 echo $secondTitle;
				    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/amazon.jpg">Rs.<?php 	
				    $secondPrice = $initialPrice[3][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice;
				    ?></p>
					</div>
					<div class="list">			
					<h2><?php
						
						$secondTitle = $initialtitle[4][0];
					 echo $secondTitle;
				    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/amazon.jpg">Rs.<?php 	
				    $secondPrice = $initialPrice[4][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice;
				    ?></p>
					</div>
					<div class="list">			
					<h2><?php
						
						$secondTitle = $initialtitle[5][0];
					 echo $secondTitle;
				    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/amazon.jpg">Rs.<?php 	
				    $secondPrice = $initialPrice[5][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice;
				    ?></p>
					</div>
					<div class="list">			
					<h2><?php
						
						$secondTitle = $initialtitle[6][0];
					 echo $secondTitle;
				    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/amazon.jpg">Rs.<?php 	
				    $secondPrice = $initialPrice[6][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice;
				    ?></p>
					</div>
				</div>
				<div class="col-md-6">
					
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[0][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"> <?php 	
				    $secondPrice2 = $initialPrice2[0][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[1][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"><?php 	
				    $secondPrice2 = $initialPrice2[1][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[2][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"><?php 	
				    $secondPrice2 = $initialPrice2[2][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[3][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"><?php 	
				    $secondPrice2 = $initialPrice2[3][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[4][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"><?php 	
				    $secondPrice2 = $initialPrice2[4][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[5][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"><?php 	
				    $secondPrice2 = $initialPrice2[5][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
					<div class="list">
						<h2><?php
				
						$secondTitle2 = $initialtitle2[6][0];
					 echo $secondTitle2;
					    ?></h2>	
				    <p style="margin-top:60px;"><img src="images/snapdeal.png"><?php 	
				    $secondPrice2 = $initialPrice2[6][0];
						// $middlePrice = intval(preg_replace('/[^0-9]+/', '', $intialResponse), 10);
						// $finalPrice = $middlePrice * 0.01;
						echo $secondPrice2;
				    ?></p>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<footer>
     <header>
       <h3 class="text-center">Thanks for using our service!!!</h>
     </header>
   </footer>
</body>
</html>