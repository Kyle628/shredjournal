
<html>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<link href="./surfjournal.css" rel="stylesheet">
</head>

<body id="register">

<img id="job" src="whoisjob.jpeg">

<form class="centertext" action="processregister.php" method="post">
   Create Username:<br>
   <input type="text" name="username" maxlength="15"/><br>
   <?php echo '<span style="color: red;">' . $_GET['usernameerror'] . '</span>'?><br>
   Create Password:<br>
   <input type="password" name="password" maxlength="15"/><br><br>
   <input class= "mybutton" type="submit"/>
</form>

</body>

</html>
