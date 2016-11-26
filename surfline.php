<?php
require('connect.php');

$spot_id = $_GET['spot_id'];

$request = "http://api.surfline.com/v1/forecasts/$spot_id?resources=id,surf,tide,wind&days=1";
$response  = file_get_contents($request);
$json  = json_decode($response);

//echo $response;
//echo var_dump($json);
$tides = $json->Tide->dataPoints;
$max_height = $json->Surf->surf_max[0][0];
$swell_direction = $json->Surf->swell_direction1[0][0];
$swell_period = $json->Surf->swell_period1[0][0];
$wind_direction = $json->Wind->wind_direction[0][0];
$wind_speed = $json->Wind->wind_speed[0][0];

$high_tides = [];
$low_tides = [];
$num_low_tides = 0;
$num_high_tides = 0;
foreach ($tides as $tide) {
  if ($tide->type == "High" && $num_high_tides < 2) {
    array_push($high_tides, $tide->Rawtime);
    $num_high_tides += 1;
} else if ($tide->type == "Low" && $num_low_tides < 2) {
    array_push($low_tides, $tide->Rawtime);
    $num_low_tides += 1;
}
}

$report = array('max_height' => $max_height, 'swell_direction' => $swell_direction,
 'swell_period' => $swell_period, 'wind_direction' => $wind_direction, 'wind_speed' => $wind_speed,
'high_tides' => $high_tides, 'low_tides' => $low_tides);
echo json_encode($report);
//header('Content-Type: application/json');
//echo $response;
//echo $json[0]->timestamp;
//$maxBreakingHeight = $json[0]->swell->maxBreakingHeight;
//echo $json[0]->swell->maxBreakingHeight;

//$json_to_send = json_encode(array('maxBreakingHeight' => $maxBreakingHeight, 8 => "eight"));
//$json_received = json_decode($json_to_send);
//echo $json_received->maxBreakingHeight;

?>
