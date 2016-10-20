
<?php
require('connect.php');
?>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link href="./surfjournal.css" rel="stylesheet">
</head>

<body id="loginpage">

<div id="login">
<h1>Login</h1>

<?php
  $usernameerror = $_GET['usernameerror'];

  $usernameerror = $conn->real_escape_string($usernameerror);
  $usernameerror = htmlspecialchars($usernameerror);

  $passworderror = $_GET['passworderror'];

  $passworderror = $conn->real_escape_string($passworderror);
  $passworderror = htmlspecialchars($passworderror);

 ?>

<form action="processlogin.php" method="post">
   Username:<br>
   <input type="text" name="username" value=<?php echo $_GET['username']; ?>><br>
   <?php

    echo '<span style="color: red;">' . $usernameerror . '</span>';
   ?><br>
   Password:<br>
   <input type="password" name="password"/><br>
   <?php echo '<span style="color: red;">' . $passworderror . '</span>';
   ?><br><br>
   <input class="mybutton" type="submit"/><br><br>
</form>

</div>

<a href="./register.php">Actually, Let Me Start a New Journal</a>


</body>
</html>
