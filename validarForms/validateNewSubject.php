<?php
require("../session.php");

$cod=htmlspecialchars(trim(strip_tags($_POST["codigo"])));
$name=htmlspecialchars(trim(strip_tags($_POST["name"])));
$profesor=htmlspecialchars(trim(strip_tags($_POST["profesor"])));

if(!cursoExistente($cod, $name, $conexion)){

    $sql = "INSERT INTO subject(name, teacher, id) VALUES('$name', '$profesor', '$cod')";
    $result = mysqli_query($conexion, $sql);
    header("location: ../principal.php");
}
else{
    header("location: ../principal.php?popup=show");
}

function cursoExistente($valor, $valor2, $conexion){
    $sql= "SELECT COUNT(*) AS num FROM subject WHERE id='$valor' OR name='$valor2' ";
    $result = mysqli_query($conexion, $sql);
    $array=mysqli_fetch_array($result);

    if($array["num"]>0){
        $_SESSION["cursoExistente"] = true;
        return true;
    }
    else{
        $_SESSION['cursoExistente'] = false;
        return false;
    }
    
}