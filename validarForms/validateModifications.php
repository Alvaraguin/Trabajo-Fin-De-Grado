<?php
require("../session.php");

$name=htmlspecialchars(trim(strip_tags($_POST["name"])));
$dni=htmlspecialchars(trim(strip_tags($_POST["dni"])));
$password=htmlspecialchars(trim(strip_tags($_POST["pass"])));
$password2=htmlspecialchars(trim(strip_tags($_POST["pass2"])));

if($name!==""){
    $_SESSION["username"] = $name;

    $sql = "UPDATE usuarios SET nombre='$name' WHERE email='{$_SESSION['mail']}'";
    $result = mysqli_query($conexion, $sql);
    if($dni==="" && $password=""){
        header("location: ../index.php");
    }
}

if($dni!== "" && validarDni($dni, $conexion)) {
    $sql = "UPDATE usuarios SET dni='$dni' WHERE email='{$_SESSION['mail']}'";
    $result = mysqli_query($conexion, $sql);
    if($password=""){
        header("location: ../index.php");
    }
}
else{
    header("location: ../modifyForm.php");
}

if($password!=="" && validarClave($password, $password2)){
    
    $hash=password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET password='$hash' WHERE email='{$_SESSION['mail']}'";
    $result = mysqli_query($conexion, $sql);
    header("location: ../index.php");
}
else{
    header("location: ../modifyForm.php");
}

function validarClave($valor, $valor2){
    if($valor!=$valor2){
        $_SESSION["claveMala"] = true;
        return false;
    }
    else{
        $_SESSION['claveMala'] = false;
        return true;
    }
}
function validarDni($dni, $conexion){
    $sql= "SELECT COUNT(*) AS num FROM usuarios WHERE dni='$dni' ";
    $result = mysqli_query($conexion, $sql);
    $array=mysqli_fetch_array($result);

    if($array["num"]>0){
        $_SESSION["dniUsado"] = true;
        return true;
    }
    else{
        $_SESSION['dniUsado'] = false;
        return false;
    }
}
