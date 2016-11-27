
<html>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link href="./surfjournal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="./register.js"></script>
</head>

<body id="register">

<!--
<img id="job" src="whoisjob.jpeg">
-->

<h1 "whosejournal" class="centertext">Whose Journal is this?</h1>

<form class="centertext" action="processregister.php" method="post">
   Create Username:<br>
   <input id = "username_form" type="text" name="username" maxlength="15"/><br>
   <?php echo '<span style="color: red;">' . $_GET['usernameerror'] . '</span>'?><br>
   Create Password:<br>
   <input type="password" name="password" maxlength="15"/><br><br>
   <input class= "mybutton" type="submit"/>
</form>

</body>

</html>
