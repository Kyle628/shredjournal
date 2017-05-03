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
<a href="#" id="logo"></a>
<nav>
  <ul id="navlist">
    <li class="navelement"><a href="./index.html">Home</a></li>
    <li class="navelement"><a type="button" data-toggle="modal" data-target="#contactModal">Contact</a></li>
  </ul>
</nav>

<?php

$user_id = $_SESSION['user_id'];

$sql = "SELECT profilepic FROM db.users WHERE user_id = '$user_id'";
$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
$row = $result->fetch_array();

$profilepic = $row['profilepic'];

if (empty($profilepic)) {
  echo '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#profileModal">Add Photo+</button>';
} else {

  echo "<a data-toggle='modal' data-target='#profileModal'><img id='profilepic' src='./profilepics/" . $user_id . "'></a>";
}


?>
<!-- Modal -->
<div id="profileModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload a Picture</h4>
      </div>
      <div class="modal-body">
          <form action="uploadimage.php" method="post" enctype="multipart/form-data">
              <input type="file" name="uploadpic" id="uploadpic" accept="image/*"/>
              <br>
              <input type="submit" name="submit" class="btn-primary" style="border-style: solid; border-color: white; border-radius: 5px;">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<body id="myjournal">
<?php

$username = ucfirst($_SESSION['username']);

echo '<div id="journalheader">';
echo '<h1 class="centertext" style="font-family: cursive;">' . $username . "'s Journal</h1>";
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
<!--<br><a class="pintopright" href="logout.php">logout</a>-->

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
