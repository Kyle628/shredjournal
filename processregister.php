


<?php
require('connect.php');


$username = ($_POST['username']);
$password = ($_POST['password']);

$username = substr($username, 0, 15);
echo $username;

$username = $conn->real_escape_string($username);
$username = htmlspecialchars($username);

$password = $conn->real_escape_string($password);
$password = htmlspecialchars($password);

$password = hash("sha256", $password);

echo $password;


$sql = "insert into db.users (username, password) values ('$username',
'$password')";

if ($conn->query($sql) === TRUE) {
  echo "<script>
  function redirect() {
    window.location.replace('login.php?username=" . $username . "');
    return false;
  }
  redirect();
  </script>";
} else {
  echo "<script>
  function redirect() {
    window.location.replace('register.php?usernameerror=username taken');
    return false;
  }
  redirect();
  </script>";
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>
