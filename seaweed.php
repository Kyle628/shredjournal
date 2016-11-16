<?php
require('connect.php');

$request = "http://api.surfline.com/v1/forecasts/4190?resources=surf,tide,wind&days=1";
$response  = file_get_contents($request);
$json  = json_decode($response);

//echo $response;
//echo var_dump($json);
$tides = $json->Tide->dataPoints;
$max_height = $json->Surf->surf_max[0];
$swell_direction = $json->Surf->swell_direction1[0][0];
$swell_period = $json->Surf->swell_period1[0][0];
$wind_direction = $json->Wind->wind_direction[0][0];
$wind_speed = $json->Wind->wind_speed[0][0];
$lowtides = array();
$hightides = array();
foreach ($tides as $tide) {
  if ($tide->type == "Low") {
    array_push($lowtides, $tide->Rawtime);
    //echo "Low";
    //echo $tide->Rawtime;
  } else if (($tide->type == "High")) {
    array_push($hightides, $tide->Rawtime);
  }
}
//echo $json[0]->timestamp;
//$maxBreakingHeight = $json[0]->swell->maxBreakingHeight;
//echo $json[0]->swell->maxBreakingHeight;

//$json_to_send = json_encode(array('maxBreakingHeight' => $maxBreakingHeight, 8 => "eight"));
//$json_received = json_decode($json_to_send);
//echo $json_received->maxBreakingHeight;

?>
