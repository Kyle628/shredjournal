<?php
session_start();
require('connect.php');
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body id="newentry">

<head>
<link href="./surfjournal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>


<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM db.seaweed";
$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
$seaweed_spots = array();
while ($row = $result->fetch_array()) {
  $seaweed_spot = $row;
  array_push($seaweed_spots, $seaweed_spot);
}

?>

<h1 id="howwasthesesh" class="centertext">How Was The Sesh?</h1>

<h2>Get Conditions From:</h1>
  <select id="seaweed_select" name="seaweed_spot">
    <option value=""></option>
    <?php
    foreach ($seaweed_spots as $a_spot) {
      $spot_name = $a_spot['spot'];
      $seaweed_id = $a_spot['spot_id'];
      echo "<option value=$seaweed_id>$spot_name</option>";
    }
    ?>
  </select>
  <?php
    echo "<script>var spot_id = document.getElementById('seaweed_select').value;</script>";
    ?>
  <button>Autofill</button>

<?php echo '<br /><a class="mybutton" href="myjournal.php' . SID . '">Back To My Journal</a>'; ?>
<br><br>
<form action="submitentry.php" method="post" enctype="multipart/form-data" id="entryform">
  Rate The Session (1-10):
  <select name="rating">
    <option value=""></option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
  </select><br><br>
  <?php
  $sql = "SELECT spot FROM db.spots WHERE user_id = '$user_id'";
  $result = $conn->query($sql);
  echo 'Spot: <select name="spot">';
  echo '<option value=""></option>';
  while($row = $result->fetch_array()) {
    echo '<option value="' . $row['spot'] . '">' . $row['spot'] . '</option></br>';
  }
  echo '</select><a href="addspot.html">+</a><br><br>';
  //
  $sql = "SELECT board FROM db.boards WHERE user_id = '$user_id'";
  $result = $conn->query($sql);
  echo 'Board: <select name="board">';
  echo '<option value=""></option>';
  while($row = $result->fetch_array()) {
    echo '<option value="' . $row['board'] . '">' . $row['board'] . '</option></br>';
  }
  echo '</select><a href="addboard.html">+</a><br><br>';


  ?>
  Time:
  <input type="time" name="time" value="16:20:00"><br><br>
  Date:
  <input id="date" type="date" name="date">
  Size:
  <select id = "size" name="size">
    <option value=""></option>
    <option value="ankleknee">Ankle-Knee</option>
    <option value="kneechest">Knee-Chest</option>
    <option value="overhead">Overhead</option>
    <option value="doubleoverhead">Double Overhead+</option>
  </select><br><br>
  Surface Conditions:
  <select name="surface_conditions">
    <option value=""></option>
    <option value="choppy">choppy</option>
    <option value="regular">regular</option>
    <option value="glassy">glassy</option>
  </select>
  Swell-Direction:
  <select name="swell_direction">
    <option value=""></option>
    <option value="N">N</option>
    <option value="NNE">NNE</option>
    <option value="NE">NE</option>
    <option value="ENE">ENE</option>
    <option value="E">E</option>
    <option value="ESE">ESE</option>
    <option value="SE">SE</option>
    <option value="SSE">SSE</option>
    <option value="S">S</option>
    <option value="SSW">SSW</option>
    <option value="SW">SW</option>
    <option value="WSW">WSW</option>
    <option value="W">W</option>
    <option value="WNW">WNW</option>
    <option value="NW">NW</option>
    <option value="NNW">NNW</option>
  </select>

  Swell-Period(seconds):
  <select name="swell_period">
    <option value=""></option>
    <option value="5">1-5</option>
    <option value="8">6-8</option>
    <option value="10">8-10</option>
    <option value="12">10-12</option>
    <option value="13">13+</option>
  </select><br><br>
  Wind-Direction:
  <select name="wind_direction">
    <option value=""></option>
    <option value="offshore">offshore</option>
    <option value="onshore">onshore</option>
  </select>
  Wind-Speed:
  <select name="wind_speed">
    <option value=""></option>
    <option value="none">None</option>
    <option value="light">Light</option>
    <option value="strong">Strong</option>
  </select><br><br>
  Tide-Height:
  <select name="tide_height">
    <option value=""></option>
    <option value="high">high</option>
    <option value="medium">medium</option>
    <option value="low">low</option>
  </select>
  Tide in/out:
  <select name="tide">
    <option value=""></option>
    <option value="incoming">incoming</option>
    <option value="outgoing">outgoing</option>
  </select><br><br>

  <label>Upload A Photo!</label><br/>
  <input name="uploadpic" type="file" class="inputFile" accept="image/*" /><br>

  <textarea name="entry" form="entryform" rows="20" cols="75"></textarea>
  <input type="submit" href="myjournal.php"/><br>


</form>

<br><a class="pintopright" href="logout.php">logout</a>

<script>
document.getElementById('date').valueAsDate = new Date();
var report;
$.get("./surfline.php",function(json) {
  report = JSON.parse(json)
  console.log(report);
  var reported_height = parseInt(report['max_height']);
  if (reported_height < 4) {
    $('#size option[value="ankleknee"]').prop('selected', true);
  } else if (reported_height < 7) {
    $('#size option[value="kneechest"]').prop('selected', true);
  } else if (reported_height < 10) {
    $('size').val('overhead');
    $('#size option[value="overhead"]').prop('selected', true);
  } else {
    $('#size option[value="doubleoverhead"]').prop('selected', true);
  }
  console.log(reported_height);
});



</script>

</body>

</html>
