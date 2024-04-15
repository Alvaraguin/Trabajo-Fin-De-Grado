<?php

require("../../session.php");

$perfil = htmlspecialchars(trim(strip_tags($_GET['valor'])));

/*Eliminar de la tabla de amigos*/
$sql = "DELETE FROM amigos WHERE usuario='$perfil' OR mailamigo='$perfil'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de matriculas*/
$sql = "DELETE FROM matriculas WHERE userMail='$perfil'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de notificaciones de matriculacion*/
$sql = "DELETE FROM matnot WHERE usuario='$perfil'";
$result = mysqli_query($conexion, $sql);

/*Eliminar de la tabla de notificaciones de eliminacion de perfil*/
$sql = "DELETE FROM deletenot WHERE userMail='$perfil'";
$result = mysqli_query($conexion, $sql);


header("location: ../../principal.php");
