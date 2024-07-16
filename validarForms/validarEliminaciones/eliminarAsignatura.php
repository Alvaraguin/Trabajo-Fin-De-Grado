<?php

require("../../session.php");

$grupo = htmlspecialchars(trim(strip_tags($_POST['type'])));

/*Eliminar de la tabla de asignaturas*/
$sql = "DELETE FROM grupos WHERE IdGrupo='$grupo'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de matriculas*/
$sql = "DELETE FROM matriculas WHERE subjectCod='$grupo'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de notificaciones de matriculacion*/
$sql = "DELETE FROM matnot WHERE curso='$grupo'";
$result = mysqli_query($conexion, $sql);


header("location: ../../index.php");
