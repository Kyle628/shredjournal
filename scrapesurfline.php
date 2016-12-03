<?php
require('connect.php');

for ($i = 2; $i < 1000; $i += 1) {

    $request = "http://api.surfline.com/v1/forecasts/$i?resources=id,surf";
    $response  = file_get_contents($request);
    $json  = json_decode($response);

    $spot_name = $json->name;
    $spot_id = $json->id;
    $max_height = $json->Surf->surf_max;


    if (!empty($max_height)) {
        echo $i;
        echo '<br>';
        echo $spot_name;

        $spot_name = $conn->real_escape_string($spot_name);
        $spot_name = htmlspecialchars($spot_name);
        $sql = "insert into db.surfline (spot_id, spot) values ('$i',
        '$spot_name')";

        if ($conn->query($sql) === TRUE) {
          echo "stored ";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
