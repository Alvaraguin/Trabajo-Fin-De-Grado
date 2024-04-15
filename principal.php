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
<!-- Contenedor de la izquierda -->
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
<!-- Contenedor del centro -->
        <div class="container-center">
       
            <?php
            if($_SESSION["rol"]=== "Administrador"){
            ?>
            <h1>Matriculación</h1>
            <p>&#x2605; Esta es una estrella sólida.</p>
            <p>&#x2606; Esta es una estrella vacía.</p>
            <?php
            }
            else{
            ?>
            <h1><?php  echo"{$_SESSION['subject']}"; ?></h1><br>
            <?php
            }
            ?>
            
        </div>



<!-- Contenedor de la derecha -->
        <div class="container">
        <?php
            if($_SESSION["rol"]=== "Administrador"){
        ?>
            <h1>Cursos existentes</h1><br>
            <div class="addButton"><button type="button" class="acceptButton" onclick="showHide('anadirAsignatura')">Añadir curso</button></div><br>
            <ul>
        <?php
            $sql="SELECT name, id FROM subject";
            $result=mysqli_query($conexion, $sql);
            while($curso=mysqli_fetch_assoc($result)){
        ?>
                
            <div class="deleteSubject">
                <p>·<?php echo"{$curso['id']}"; ?>: <?php echo"{$curso['name']}"; ?></p>
                <a href="./validarForms/validarEliminaciones/eliminarAsignatura.php?valor=<?php echo "{$curso['name']}" ?>"><button type="button">Eliminar</button></a>
            </div><br>
        <?php
                }
        }
        else{
        ?>
            <h1>Favoritos</h1><br>
        <?php
            }
        ?>
        </div>
    </section>
    
    <!-- Footer-->
    <?php
        require("./common/footer.php");
    ?>



<!-- Pop ups -->
    <div class="fondo-oscuro" id="fondoOscuro"></div>
    <div class="pop-up" id="anadirAsignatura">
        <h1>Añadir curso</h1>
        <?php
            if(isset($_SESSION['cursoExistente']) && $_SESSION['cursoExistente'] === true){
                echo "<h3>·Ya existe un curso con esos datos</h3><br>";
                unset($_SESSION["cursoExistente"]);
            }
        ?>
        <form action="./validarForms/validateNewSubject.php" method="post">
            <label for="codigo">Código del curso(1-5 dígitos)</label><br>
            <input type="text" id="codigo" name="codigo" placeholder="Escribe el código del curso" minlength="1" maxlength="5" required /><br>

            <label for="name">Nombre</label><br>
            <input type="text" id="name" name="name" placeholder="Escribe el nombre del curso" required /><br>

            <label>Asigna un profesor:</label>
            <select name="profesor" required>
                <option value="" disabled selected>--Elige una opcion</option>
                <?php 
                $sql="SELECT email FROM usuarios WHERE rol='Profesor'";
                $result=mysqli_query($conexion, $sql);
                while($profesor=mysqli_fetch_assoc($result)){
                    echo "<option value='{$profesor['email']}'>{$profesor['email']}</option>";
                }
                ?>
            </select>
            <br><br>
            <div class="buttons">
                <button type="button" onclick="showHide('anadirAsignatura')" class="cancel-button">Cancelar</button>
                <button type="submit">Crear curso</button>
            </div>
            <br>
        </form>
    </div>

    <script>
        window.onload = function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('popup') && urlParams.get('popup') === 'show') {
                showHide('anadirAsignatura'); // Llama a la función para abrir el popup
            }
        };
    </script>
</body>
</html>