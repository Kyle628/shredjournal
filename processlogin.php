<?php
//session_unset();
require('connect.php');

$username = ($_POST['username']);
$password = ($_POST['password']);

$username = $conn->real_escape_string($username);
$username = htmlspecialchars($username);

$password = $conn->real_escape_string($password);
$password = htmlspecialchars($password);

$password = hash("sha256", $password);


$sql = "SELECT username, password, user_id FROM db.users WHERE username = '$username'";

$result = $conn->query($sql);
$list = mysqli_fetch_array($result);


if ($list[0] == $username) {
  if ($list[1] == $password) {
    //echo 'logged in as ' . $username;
    session_start();
    $_SESSION['username']= $username;
    $_SESSION['user_id']= $list[2];

    header('Location: myjournal.php');
    //echo '<br /><a href="newentry.php' . SID . '">add a new entry</a>';

    //echo '<br /><a href="myjournal.php' . SID . '">go to my journal</a>';
  } else {
    echo '<script>
    function redirect() {
      window.location.replace("login.php?passworderror=incorrect password");
      return false;
    }
    redirect();
    </script>';
  }
} else {
  echo '<script>
  function redirect() {
    window.location.replace("login.php?usernameerror=username does not exist");
    return false;
  }
  redirect();
  </script>';
}
?>
