<?php
session_start();
require('connect.php');

$user_id = $_SESSION['user_id'];

$sql = "SELECT profilepic FROM db.users WHERE user_id = '$user_id'";
$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
$row = $result->fetch_array();

$profilepic = $row['profilepic'];

if (empty($profilepic)) {
  echo '<a href="./addprofilepic.php">Add a Profile Picture</a>';
} else {

  echo "<img id='profilepic' src='./profilepics/" . $user_id . "'>";
}



?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link href="./surfjournal.css" rel="stylesheet">
</head>


<body id="myjournal">
<?php

$username = ucfirst($_SESSION['username']);

echo '<div id="journalheader">';
echo '<h1 class="centertext">' . $username . "'s Journal</h1>";
echo '</div><br><br><br><br><br>';

$user_id = $_SESSION['user_id'];


$sql = "SELECT entry_id, entry, spot, time, date,
size, surface_conditions, swell_direction, swell_period, wind_direction,
wind_speed, tide_height, tide FROM db.entries WHERE user_id = '$user_id'";
$result = $conn->query($sql);


echo '<ul id="entrylist">';
while($row = $result->fetch_array())
  {
  $entry = $row['entry'];
  if (!empty($entry)) {
    $date = "<i>" . $row['date'] . " - </i>";
    $encoded_entry = urlencode(base64_encode($entry));
    if (strlen($entry) > 26) {
      $sub_entry = substr($entry, 0, 25) . "...";
    } else {
      $sub_entry = substr($entry, 0, 25);
    }
    $entry_id = $row['entry_id'];
    /*
    echo '<li><a href="readentry.php?entry=' . $encoded_entry . '&spot=' . $row['spot'] .
    '&time=' . $row['time'] .
    '&date=' . $row['date'] .
    '&size=' . $row['size'] .
    '&surface_conditions=' . $row['surface_conditions'] .
    '&swell_direction=' . $row['swell_direction'] .
    '&swell_period=' . $row['swell_period'] .
    '&wind_direction=' . $row['wind_direction'] .
    '&wind_speed=' . $row['wind_speed'] .
    '&tide_height=' . $row['tide_height'] .
    '&tide=' . $row['tide'] . '">' . $date .
     $sub_entry . '</a>';*/
     echo '<li id="entry_li"><a href="readentry.php?entry_id=' . $entry_id . '">' . $date . $sub_entry . '</a></li>';
   }
  //echo '<br />';
  }
echo '</ul>';

echo '<br /><a class="myButton" href="newentry.php' . SID . '">Add a New Entry</a>';
?>
<br><a class="pintopright" href="logout.php">logout</a>

</body>
</html>
