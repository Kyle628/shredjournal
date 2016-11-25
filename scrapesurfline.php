<? php
$request = "http://api.surfline.com/v1/forecasts/4190?resources=id,surf,tide,wind&days=1";
$response  = file_get_contents($request);
$json  = json_decode($response);
?>
