<?php
session_start();
require('connect.php');
$board = $_POST['board'];
$board = $conn->real_escape_string($board);
$board = htmlspecialchars($board);
$user_id = $_SESSION['user_id'];
$sql = "insert into db.boards (user_id, board) values ('$user_id', '$board')";
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
