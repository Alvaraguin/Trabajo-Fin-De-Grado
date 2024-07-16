<?php

require("../../session.php");

$grupo = htmlspecialchars(trim(strip_tags($_POST['type'])));
$alumno = $_SESSION['mail'];

$sql = "INSERT INTO matnot(usuario, curso) VALUES('$alumno', '$grupo')";
$result = mysqli_query($conexion, $sql);
if($result){
    header("location: ../../index.php");
}