<?php
session_start();
require('connect.php');

$sql = "SELECT entrypic FROM db.entries WHERE entry_id = 137";
$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
$row = $result->fetch_array();

$entrypic = $row['entrypic'];
if (empty($entrypic)) $entrypic = "./kook.jpg";
header("Content-type: image/*");
print $entrypic;

?>
