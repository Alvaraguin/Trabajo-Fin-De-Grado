<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Odontología</h1>
    </header>
    <div class="fondo-oscuro" id="fondoOscuro"></div>
    <div class="pop-up" id="eliminacionUser">
        <h1>¿Seguro que quieres eliminar el perfil?</h1>
        <br><br>
        <p>Esta acción no tiene vuelta atrás</p>
        <br><br>
        <button class="cancel-button" onclick="showHide('eliminacionUser')">Cancelar</button>
        <a href="./validarForms/validateDelete.php"><button type="button" id="confirm">Confirmar</button></a>
    </div>
    <nav>
        <ul class="menu-horizontal">
            <li>
                <a href="">Perfil</a>
                <ul class="menu-vertical">
                    <li><a href="">Modificar perfil</a></li>
                    <li><a href="">Eliminar</a></li>
                </ul>
            </li>
        </ul>
        <?php
        if(isset($_SESSION['login'])){
            if($_SESSION['rol']!=='Administrador'){
        ?>
        <a href="./index.php">Cursos</a> |
        <a href="./modifyForm.php">Modificar perfil</a> |
        <?php
                if($_SESSION['rol']==='Estudiante'){
        ?>
        <a href="">Matricularse</a> |
        <?php
                }
            }
        ?>
        <a href="#" onclick="showHide('eliminacionUser')">Eliminar perfil</a> |
        <?php
            echo"Hola, {$_SESSION['username']}";
        ?>
        |
        <a href="./validarForms/validateLogout.php">Salir</a>
        <?php
        }
        else{
            echo("<p>Identifícate</p>");
        
        }
        ?>
    </nav>
</body>
</html>