<?php
require("../session.php");

$sql = "INSERT INTO deletenot(userMail) VALUES('{$_SESSION['mail']}')";
$result = mysqli_query($conexion, $sql);

$sql = "DELETE FROM usuarios WHERE email='{$_SESSION['mail']}'";
$result = mysqli_query($conexion, $sql);

if(isset($_SESSION))
	unset($_SESSION);
$_SESSION['login'] = false;
echo "<h1 align='center';> Gracias por haber usado nuestros servicios </h1>";
echo '<meta http-equiv="refresh" content="1;URL=../index.php" />';

session_destroy();