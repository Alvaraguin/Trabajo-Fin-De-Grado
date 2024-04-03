<?php
    require("session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" href="./styles/general.css" />
    <link rel="stylesheet" href="./styles/common.css" />
    <link rel="stylesheet" href="./styles/adminView.css" />
    <script src="./JS/buttons.js"></script>
</head>
<body>
    <?php
        if(!isset($_SESSION['login']) || $_SESSION['login'] === false){
            header("Location: ./loginForm.php");
        }
    ?>
    <!-- Header -->
    <?php
        require("./common/header.php");
    ?>

    <section id="principal">

        <div class="container">
            <?php
            if($_SESSION['rol']==="Administrador"){
            ?>
            <h1>Perfiles a eliminar</h1><br>
            <?php
            $sql="SELECT userMail FROM deletenot";
            $result=mysqli_query($conexion, $sql);
            while($perfil=mysqli_fetch_assoc($result)){
            ?>
            <div class="deletezone">
                <p>Perfil a eliminar: <?php echo"{$perfil['userMail']}"; ?></p><br>
                <a href=""><button type="button">Eliminar</button></a>
            </div>
            <?php
            }
            }
            else{
            ?>
    
            <h1>Participantes</h1><br>
            <h2>Mejores amigos</h2>
            <h2>Estudiantes</h2>
            <h2>Profesores</h2>


            <?php
            }
            ?>
        </div>
        <div class="container-center">
            <?php
            if($_SESSION["rol"]=== "Administrador"){
            ?>
            <h1>Cursos existentes</h1>
            <?php
            }
            else{
            ?>
            <h1><?php  echo"{$_SESSION['subject']}"; ?></h1><br>
            <?php
            }
            ?>
            
        </div>
        <div class="container">
            <h1>Entregas</h1><br>
        </div>
    </section>
    
    <!-- Footer-->
    <?php
        require("./common/footer.php");
    ?>



</body>
</html>