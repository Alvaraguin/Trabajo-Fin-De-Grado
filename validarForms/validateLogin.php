<?php
require("../session.php");

$mail = htmlspecialchars(trim(strip_tags($_POST["mail"])));
$clave = htmlspecialchars(trim(strip_tags($_POST["pass"])));

$sql = "SELECT password AS pas FROM usuarios WHERE email='$mail'";
$result = mysqli_query($conexion, $sql);
$array = mysqli_fetch_array($result);

if(password_verify($clave,$array['pas'])){
    $sql="SELECT email,nombre FROM usuarios WHERE email='$mail'";
    $result=mysqli_query($conexion, $sql);
    $nombre=mysqli_fetch_assoc($result);
    $_SESSION['error'] = false;
    $_SESSION['login'] = true;
    $_SESSION['mail'] = $nombre['email'];
    $_SESSION['username'] = $nombre['nombre'];
    $_SESSION['rol'] = specifyRol($conexion, $mail);
    header("location: ../index.php");
}
else{
    $_SESSION['error'] = true;
    header("location: ../loginForm.php");
}


function specifyRol($conexion, $user){
    $sql="SELECT rol FROM usuarios WHERE email='$user'";
    $result=mysqli_query($conexion, $sql);
    $rol=mysqli_fetch_assoc($result);
    return $rol['rol'];
}
?>