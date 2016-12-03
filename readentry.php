<?php
session_start();
require('connect.php');
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link href="./surfjournal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<nav>
  <ul id="navlist">
    <li class="navelement"><a href="./index.html">Home</a></li>
    <li class="navelement"><a type="button" data-toggle="modal" data-target="#contactModal">Contact</a></li>
  </ul>
</nav>

<body id="readentry">


<?php

echo '<br /><a class="mybutton" href="myjournal.php' . SID . '">Back To My Journal</a><br /><br />';

echo '<div id="entryconditions">';
/*
$entry = urldecode(base64_decode($_GET['entry']));
$spot = $_GET['spot'];
$time = $_GET['time'];
$date = $_GET['date'];
$size = $_GET['size'];
$surface_conditions = $_GET['surface_conditions'];
$swell_direction = $_GET['swell_direction'];
$swell_period = $_GET['swell_period'];
$wind_direction = $_GET['wind_direction'];
$wind_speed = $_GET['wind_speed'];
$tide_height = $_GET['tide_height'];
$tide = $_GET['tide'];
*/

$entry_id = $_GET['entry_id'];

$sql = "SELECT entry, spot, time, date,
size, surface_conditions, swell_direction, swell_period, wind_direction,
wind_speed, tide_height, tide, entrypic, board FROM db.entries WHERE entry_id = '$entry_id'";
$result = $conn->query($sql);

$row = $result->fetch_array();

$entry = $row['entry'];
$spot = $row['spot'];
$board = $row['board'];
$time = $row['time'];
$date = $row['date'];
$size = $row['size'];
$surface_conditions = $row['surface_conditions'];
$swell_direction = $row['swell_direction'];
$swell_period = $row['swell_period'];
$wind_direction = $row['wind_direction'];
$wind_speed = $row['wind_speed'];
$tide_height = $row['tide_height'];
$tide = $row['tide'];
$entrypic = $row['entrypic'];



if ($spot !== '') {
  echo '<b>Spot: </b>' . $spot;
  echo '<br /><br />';
}
if ($board !== '') {
  echo '<b>Board: </b>' . $board;
  echo '<br /><br />';
}
if ($time !== '') {
  echo '<b>Time: </b>' . $time;
  echo '<br /><br />';
}
if ($date !== '') {
echo '<b>Date: </b>' . $date;
echo '<br /><br />';
}
if ($size !== '') {
echo '<b>Size: </b>' . $size;
echo '<br /><br />';
}
if ($surface_conditions !== '') {
echo '<b>Surface Conditions</b>: ' . $surface_conditions;
echo '<br /><br />';
}
if ($swell_direction !== '') {
echo '<b>Swell Direction: </b>' . $swell_direction;
echo '<br /><br />';
}
if ($swell_period !== '') {
echo '<b>Swell Period</b>: ' . $swell_period;
echo '<br /><br />';
}
if ($wind_direction !== '') {
echo '<b>Wind Direction</b>: ' . $wind_direction;
echo '<br /><br />';
}
if ($wind_speed !== '') {
echo '<b>Wind Speed</b>: ' . $wind_speed;
echo '<br /><br />';
}
if ($tide_height !== '') {
echo '<b>Tide Height</b>: ' . $tide_height;
echo '<br /><br />';
}
if ($tide !== '') {
echo '<b>Tide</b>: ' . $tide;
echo '<br /><br />';
}
echo '</div>';
echo '<br /><br />';
echo '<div id="entry">';
echo '<div style="width: 100%;"><strong>Entry</strong>: ' . $entry . '</div>';
echo '</div><br>';

if (!empty($entrypic)) {
echo "<img id='entrypic' src='./entrypics/" . $entry_id . "'>";
}
?>




</body>
<!-- Modal -->
<div id="contactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Me</h4>
      </div>
      <div class="modal-body">
        <p>kyjoconn@gmail.com</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</html>
