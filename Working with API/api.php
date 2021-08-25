<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$request = $_POST['request'];
	$QUERY = $_POST['query'];


if($request=="IMAGE"){
	$URL = "https://pixabay.com/api/?key=23078725-ddb796c2e2d26efa41b9e8f92&q=".urlencode($QUERY);	
}else{
	$URL = "https://pixabay.com/api/videos/?key=23078725-ddb796c2e2d26efa41b9e8f92&q=".urlencode($QUERY);
}


$curl = curl_init($URL);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
$decoded = json_decode($response,True);


if($decoded['total'] == 0){
	echo "<h2  class='text-warning' >Record! Not Found...!</h2>";
	exit();
}



		if($request=="IMAGE"){

				echo "<div class='container'>
						<div class='row'>";
				$i = 0;
				foreach ($decoded['hits'] as $key => $value) {
					echo "<div class='col-lg-3  col-md-4 col-sm-6'>
							<div class=''>";
					echo "<img class='rounded  shadow p-1 mb-4 bg-white' width='100%' height='50%' src='".$value['previewURL']."' />";
					/*echo  "<div class='row'>
								<div class='col-lg-6'>Views: ".$value['views']."</div>
								<div class='col-lg-6'>Likes: ".$value['likes']."</div>
							</div>";*/
					echo "</div></div>";
					$i++;	
					if($i == 4){
						echo "	</div>
							<div class='row''>";
						$i=0;	
					}
				}
				echo "	</div>
					</div>";
		}else{

				echo "<div class='container'>
						<div class='row'>";
				$i = 0;
				foreach ($decoded['hits'] as $key => $value) {
					echo "<div class='col-lg-3 col-md-4  col-sm-6'>";
					echo "<video width='100%' class='shadow p-1 mb-4 bg-white' height='300' controls> 
							<source src='".$value['videos']['tiny']['url']."' type='video/mp4'>
							Your browser does not support the video tag.
						</video>";
					/*	
					echo  "<div class='row'>
								<div class='col'>Views: ".$value['views']."</div>
								<div class='col'>Likes: ".$value['likes']."</div>
							</div>";*/
					echo "</div>";
					$i++;	
					if($i == 4){
						echo "	</div>
							<div class='row''>";
						$i=0;	
					}
					
				}

				echo "	</div>
					</div>";

		}

}








?>
