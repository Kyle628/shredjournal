<?php
session_start();
require('connect.php');

$user_id = $_SESSION['user_id'];
$entry = $conn->real_escape_string($_POST['entry']);
$entry = htmlspecialchars($entry);
$spot = $_POST['spot'];
$time = $_POST['time'];
$date = $_POST['date'];

$time = $conn->real_escape_string($time);
$time = htmlspecialchars($time);

$date = $conn->real_escape_string($date);
$date = htmlspecialchars($date);

$size = $_POST['size'];
$surface_conditions = $_POST['surface_conditions'];
$swell_direction = $_POST['swell_direction'];
$swell_period = $_POST['swell_period'];
$wind_direction = $_POST['wind_direction'];
$wind_speed = $_POST['wind_speed'];
$tide_height = $_POST['tide_height'];
$tide = $_POST['tide'];

// image stuff



if (count($_FILES) > 0 and !empty($_FILES['uploadpic']['tmp_name'])) {

if(is_uploaded_file($_FILES['uploadpic']['tmp_name'])) {
  $entrypic = 'this entry has a picture';
  $sql = "insert into db.entries (user_id, entry, spot, time, date,
  size, surface_conditions, swell_direction, swell_period, wind_direction,
  wind_speed, tide_height, tide, entrypic) values ('$user_id', '$entry', '$spot',
  '$time', '$date', '$size', '$surface_conditions', '$swell_direction',
  '$swell_period', '$wind_direction', '$wind_speed', '$tide_height',
  '$tide', '{$entrypic}')";

  $conn->query($sql) or trigger_error($conn->error."[$sql]");

  $entry_id = $conn->insert_id;

  $save_path= getcwd() . "/entrypics/"; // Folder where you wanna move the file.
  $myname = $entry_id; //You are renaming the file here
  move_uploaded_file($_FILES['uploadpic']['tmp_name'], $save_path.$myname); // Move the uploaded file to the desired folder

} else {
  header('index.html');
}

} else {

  $sql = "insert into db.entries (user_id, entry, spot, time, date,
  size, surface_conditions, swell_direction, swell_period, wind_direction,
  wind_speed, tide_height, tide) values ('$user_id', '$entry', '$spot',
  '$time', '$date', '$size', '$surface_conditions', '$swell_direction',
  '$swell_period', '$wind_direction', '$wind_speed', '$tide_height',
  '$tide')";

  $conn->query($sql) or trigger_error($conn->error."[$sql]");

}

header('Location: myjournal.php');
?>
