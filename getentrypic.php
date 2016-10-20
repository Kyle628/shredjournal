<?php
session_start();
require('connect.php');

$entry_id = $_GET['entry_id'];
$sql = "SELECT entrypic FROM db.entries WHERE entry_id = '$entry_id'";
$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
$row = $result->fetch_array();

$entrypic = $row['entrypic'];
if (empty($entrypic)) $entrypic = "./kook.jpg";
header("Content-type: image/jpeg");
print $entrypic;
?>
