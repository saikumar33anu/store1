<?php
 

$url = "http://www.flipkart.com/rado-analog-watch-women/p/itmdsvdxqb3y3jvp?affid=amitlabnol";
 
$response = getPriceFromFlipkart($url);
 
echo json_encode($response);
 
/* Returns the response in JSON format */
 
function getPriceFromFlipkart($url) {
 
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10; labnol;) ctrlq.org");
	curl_setopt($curl, CURLOPT_FAILONERROR, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$html = curl_exec($curl);
	curl_close($curl);
 
	$regex = '/<meta itemprop="price" content="([^"]*)"/';
	preg_match($regex, $html, $price);
 
	$regex = '/<h1[^>]*>([^<]*)<\/h1>/';
	preg_match($regex, $html, $title);
 
	$regex = '/data-src="([^"]*)"/i';
	preg_match($regex, $html, $image);
 
	if ($price && $title && $image) {
		$response = array("price" => "Rs. $price[1].00", "image" => $image[1], "title" => $title[1], "status" => "200");
	} else {
		$response = array("status" => "404", "error" => "We could not find the product details on Flipkart $url");
	}
 
	return $response;
}











http://www.flipkart.com/moto-e-2nd-gen-4g/p/itme85hfdv6zztcj?pid=MOBE4G6GTH2QDACF&ref=L%3A-1875728449369783426&srno=p_1&query=moto+e&otracker=from-search





http://www.flipkart.com/asus-zenfone-max/p/itmedhzfdc6jhegv?pid=MOBEDHZFWGKNJMHF&ref=L%3A-8083296272571479391&srno=p_1&query=asus+zenfone+max&otracker=from-search





http://www.flipkart.com/woodland-outdoors-shoes/p/itmeb8bcphefg2zu?pid=SHOEB8BCN8DG2MQX&ref=L%3A-6676538350379643575&srno=p_1&query=woodland+shoes&otracker=from-search



http://www.flipkart.com/search?q=hard+disk&as=on&as-show=on&otracker=start&as-pos=1_q_hard



http://www.flipkart.com/search?q=moto+e&as=off&as-show=off&otracker=start




http://www.flipkart.com/search?q=hp+laptops&as=off&as-show=off&otracker=start








http://www.amazon.in/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=one+plus+one




http://www.amazon.in/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=watches&rh=i%3Aaps%2Ck%3Awatches




http://www.amazon.in/s/ref=nb_sb_noss_1?url=search-alias%3Daps&field-keywords=laptops&rh=i%3Aaps%2Ck%3Alaptops





