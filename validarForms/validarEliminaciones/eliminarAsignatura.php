<?php

require("../../session.php");

$subject = htmlspecialchars(trim(strip_tags($_GET['valor'])));
$sql = "SELECT id FROM subject WHERE name='$subject'";
$result=mysqli_query($conexion, $sql);
$cod=mysqli_fetch_assoc($result);

/*Eliminar de la tabla de asignaturas*/
$sql = "DELETE FROM subject WHERE name='$subject'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de matriculas*/
$sql = "DELETE FROM matriculas WHERE subjectCod='$cod'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de notificaciones de matriculacion*/
$sql = "DELETE FROM matnot WHERE curso='$cod'";
$result = mysqli_query($conexion, $sql);


header("location: ../../principal.php");
