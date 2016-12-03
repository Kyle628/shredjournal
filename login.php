
<?php
require('connect.php');
?>

<html>


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link href="./surfjournal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<nav>
  <ul id="navlist" style="text-align: left;">
    <li class="navelement"><a href="./index.html">Home</a></li>
    <li class="navelement"><a type="button" data-toggle="modal" data-target="#contactModal">Contact</a></li>
  </ul>
</nav>
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



</body>
<!-- Modal -->
<div id="contactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Me</h4>
      </div>
      <div class="modal-body">
        <p>kyjoconn@gmail.com</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</html>
