<?php
require("../session.php");

$mail=htmlspecialchars(trim(strip_tags($_POST["email"])));
$name=htmlspecialchars(trim(strip_tags($_POST["name"])));
$dni=htmlspecialchars(trim(strip_tags($_POST["dni"])));
$password=htmlspecialchars(trim(strip_tags($_POST["pass"])));
$password2=htmlspecialchars(trim(strip_tags($_POST["pass2"])));
$rol=htmlspecialchars(trim(strip_tags($_POST["rol"])));

if(validarClave($password, $password2) && !usarioExistente($name, $mail, $dni, $conexion)){
    $_SESSION["login"] = true;
    $_SESSION["username"] = $name;
    $_SESSION["rol"] = $rol;
    $_SESSION["mail"] = $mail;

    $hash=password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(email, password, dni, nombre, rol) VALUES('$mail', '$hash', '$dni', '$name', '$rol')";
    $result = mysqli_query($conexion, $sql);
    header("location: ../index.php");
}
else{
    header("location: ../creacionUser.php");
}

function usarioExistente($valor, $valor2, $valor3, $conexion){
    $sql= "SELECT COUNT(*) AS num FROM usuarios WHERE email='$valor2' OR dni='$valor3' ";
    $result = mysqli_query($conexion, $sql);
    $array=mysqli_fetch_array($result);

    if($array["num"]>0){
        $_SESSION["usuarioExistente"] = true;
        return true;
    }
    else{
        $_SESSION['usuarioExistente'] = false;
        return false;
    }
    
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
?>