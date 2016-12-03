<?php
include('connect.php');

$searchTerm = $_GET['term'];
$data = array();

    //get matched data from skills table
    $query = $conn->query("SELECT * FROM db.surfline WHERE spot LIKE '%".$searchTerm."%' ORDER BY spot ASC");
    while ($row = $query->fetch_assoc()) {
        $row_copy = array('label'=>$row['spot'], 'value'=>$row['spot_id']);
        $data[] = $row_copy;
    }

    //return json data
    echo json_encode($data);
?>
