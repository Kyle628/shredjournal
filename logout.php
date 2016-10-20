<?php
session_start();
session_unset();
echo '<p>You have logged out</p>';
echo '<a href="login.php">Login</a>';

?>
