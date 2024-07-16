<?php
require("../session.php");

$name=htmlspecialchars(trim(strip_tags($_POST["name"])));
$profesor=$_SESSION['mail'];

if(!cursoExistente($name, $conexion)){

    $sql = "INSERT INTO grupos(IdGrupo, profesor) VALUES('$name', '$profesor')";
    $result = mysqli_query($conexion, $sql);
    header("location: ../index.php");
}
else{
    header("location: ../index.php?popup=show");
}

function cursoExistente($valor, $conexion){
    $sql= "SELECT COUNT(*) AS num FROM grupos WHERE IdGrupo='$valor' ";
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