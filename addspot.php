<?php
session_start();
require('connect.php');
$spot = $_POST['spot'];
$spot = $conn->real_escape_string($spot);
$spot = htmlspecialchars($spot);
$user_id = $_SESSION['user_id'];
$sql = "insert into db.spots (user_id, spot) values ('$user_id', '$spot')";
if ($conn->query($sql) === TRUE) {
    echo "<script>
    function redirect() {
      window.location.replace('newentry.php');
      return false;
    }
    redirect();
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 ?>
