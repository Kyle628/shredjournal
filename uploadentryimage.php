<?php
session_start();
require('connect.php');
$user_id = $_SESSION['user_id'];
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
$dimensions = explode('"', $imageProperties[3]);
$width = $dimensions[1];
$height = $dimensions[3];
if (intval($width) > 5000 or intval($height) > 5000) {
  echo '<p style="color:red;">Picture Was Too Large</p><br>';
} else {

$sql = "UPDATE db.users
SET profilepic = '{$imgData}'
where user_id = '$user_id'";

$current_id = $conn->query($sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysql_error());
if(isset($current_id)) {
header("Location: myjournal.php");
}}}}
?>
