<?php
session_start();
if(isset($_SESSION))
	unset($_SESSION);
$_SESSION['login'] = false;
echo "<h1 align='center';> HASTA PRONTO </h1>";
echo '<meta http-equiv="refresh" content="1;URL=../index.php" />';

session_destroy();
