<?php
require("../../session.php");

$name=htmlspecialchars(trim(strip_tags($_POST["name"])));
$tipo=htmlspecialchars(trim(strip_tags($_POST["type"])));
$asignatura = $_SESSION['subject'];

$archivo = $_FILES['archivo']['name'];
$dir_tmp = $_FILES['archivo']['tmp_name'];
$dir = "../../Files/".$archivo;
move_uploaded_file($dir_tmp,$dir);

$sql = "INSERT INTO actividades(nombre, asignatura, tipo, archivo) VALUES('$name', '$asignatura', '$tipo', '$archivo')";
$result = mysqli_query($conexion, $sql);
if($result){
    header("location: ../../principal.php");
}
else{
    print("Fallo");
}