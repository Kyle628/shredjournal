<?php
session_start();
echo $_SESSION['username'] . "'s Profile";

$username = $_SESSION['username'];

echo '<br /><a href="logout.php?' . SID . '">logout</a>';

require('connect.php');
$sql = "SELECT score FROM db.users WHERE username = '$username'";
$result = $conn->query($sql);
$list = mysqli_fetch_array($result);


$score = $list[0];
echo '<br />';
echo $score;
?>
