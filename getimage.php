<?php
session_start();
require('connect.php');

$user_id = $_GET['user_id'];
$sql = "SELECT profilepic FROM db.users WHERE user_id = '$user_id'";
$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
$row = $result->fetch_array();

$profilepic = $row['profilepic'];
if (empty($profilepic)) $profilepic = "./kook.jpg";
header("Content-type: image/jpeg");
print $profilepic;
?>
