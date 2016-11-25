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
  <button id="autofill">Autofill</button>

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
  <input id ="time" type="time" name="time" value="17:20:00"><br><br>
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
  <select id="surface_conditions" name="surface_conditions">
    <option value=""></option>
    <option value="choppy">choppy</option>
    <option value="regular">regular</option>
    <option value="glassy">glassy</option>
  </select>
  Swell-Direction:
  <select id = "swell_direction" name="swell_direction">
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
  <select id ="swell_period" name="swell_period">
    <option value=""></option>
    <option value="1-5">1-5</option>
    <option value="5-8">5-8</option>
    <option value="8-10">8-10</option>
    <option value="10-12">10-12</option>
    <option value="12+">12+</option>
  </select><br><br>
  Wind-Direction:
  <select id = "wind_direction" name="wind_direction">
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
  Wind-Speed:
  <select id="wind_speed" name="wind_speed">
    <option value=""></option>
    <option value="Light">Light</option>
    <option value="Regular">Regular</option>
    <option value="Strong">Strong</option>
  </select><br><br>
  Tide-Height:
  <select id="tide_height" name="tide_height">
    <option value=""></option>
    <option value="high">high</option>
    <option value="medium">medium</option>
    <option value="low">low</option>
  </select>
  Tide in/out:
  <select id="incoming_outgoing" name="tide">
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
$('#autofill').click(function() {
    $.get("./surfline.php",function(json) {
      report = JSON.parse(json)
      console.log(report);
      // check surf height and autofill size select form
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
      // check wind speed and fill surface quality form
      var reported_wind_speed = parseInt(report['wind_speed']);
      if (reported_wind_speed < 4) {
        $('#surface_conditions option[value="glassy"]').prop('selected', true);
        $('#wind_speed option[value="Light"]').prop('selected', true);
    } else if (reported_wind_speed < 10) {
        $('#surface_conditions option[value="regular"]').prop('selected', true);
        $('#wind_speed option[value="Regular"]').prop('selected', true);
    } else {
        $('#surface_conditions option[value="choppy"]').prop('selected', true);
        $('#wind_speed option[value="Strong"]').prop('selected', true);
      }

      //check swell direction and autofill
      var reported_swell_direction = report['swell_direction']
      if (reported_swell_direction <= 45) {
        $('#swell_direction option[value="N"]').prop('selected', true);
    } else if (reported_swell_direction <= 135) {
        $('#swell_direction option[value="E"]').prop('selected', true);
    } else if (reported_swell_direction <= 225) {
        $('#swell_direction option[value="S"]').prop('selected', true);
    } else if (reported_swell_direction <= 315) {
        $('#swell_direction option[value="W"]').prop('selected', true);
    } else {
        $('#swell_direction option[value="N"]').prop('selected', true);
    }

      //check swell-period and autofill
      var reported_swell_period = report['swell_period']
      if (reported_swell_period <= 5) {
        $('#swell_period option[value="1-5"]').prop('selected', true);
    } else if (reported_swell_period <= 8) {
        $('#swell_period option[value="5-8"]').prop('selected', true);
    } else if (reported_swell_period <= 10) {
        $('#swell_period option[value="8-10"]').prop('selected', true);
    } else if (reported_swell_period <= 12) {
        $('#swell_period option[value="10-12"]').prop('selected', true);
    } else {
        $('#swell_period option[value="12+"]').prop('selected', true);
    }

    //check wind direction and autofill
    var reported_wind_direction = report['wind_direction']
    if (reported_wind_direction <= 45) {
      $('#wind_direction option[value="N"]').prop('selected', true);
    } else if (reported_wind_direction <= 135) {
      $('#wind_direction option[value="E"]').prop('selected', true);
    } else if (reported_wind_direction <= 225) {
      $('#wind_direction option[value="S"]').prop('selected', true);
    } else if (reported_wind_direction <= 315) {
      $('#wind_direction option[value="W"]').prop('selected', true);
    } else {
      $('#wind_direction option[value="N"]').prop('selected', true);
    }

    var reported_high_tide1 = parseInt(report['high_tides'][0].split(" ")[3].substring(0, 2));
    var reported_high_tide2 = parseInt(report['high_tides'][1].split(" ")[3].substring(0, 2));
    var reported_low_tide1 = parseInt(report['low_tides'][0].split(" ")[3].substring(0, 2));
    var reported_low_tide2 = parseInt(report['low_tides'][1].split(" ")[3].substring(0, 2));
    var time_of_entry = parseInt(document.getElementById('time').value);
    //var time_difference = Math.abs(reported_high_tide - time_of_entry);

    console.log(reported_high_tide1);
    console.log(reported_high_tide2);
    console.log(reported_low_tide1);
    console.log(reported_low_tide2);

    if (Math.abs(reported_high_tide1 - time_of_entry) <= 2 ||
        Math.abs(reported_high_tide2 - time_of_entry) <= 2)
    {
      $('#tide_height option[value="high"]').prop('selected', true);
    } else if (Math.abs(reported_low_tide1 - time_of_entry) <= 2 ||
               Math.abs(reported_low_tide2 - time_of_entry) <= 2)
    {
      $('#tide_height option[value="low"]').prop('selected', true);
    } else {
      $('#tide_height option[value="medium"]').prop('selected', true);
    }

    if(time_of_entry >= reported_low_tide1 && time_of_entry <= reported_high_tide1) {
        $('#incoming_outgoing option[value="incoming"]').prop('selected', true);
    } else if (time_of_entry >= reported_low_tide2 && time_of_entry <= reported_high_tide2) {
        $('#incoming_outgoing option[value="incoming"]').prop('selected', true);
    } else {
        $('#incoming_outgoing option[value="outgoing"]').prop('selected', true);
    }



    });
});




</script>

</body>

</html>
