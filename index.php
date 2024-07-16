<?php
    require("session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Página principal</title>
    <link rel="stylesheet" href="./styles/general.css" />
    <link rel="stylesheet" href="./styles/common.css" />
    <script src="./JS/buttons.js"></script>
</head>
<body>
    <div class="fondo-oscuro" id="fondoOscuro"></div>
    <div class="pop-up" id="crearGrupo">
        <h1>Añadir grupo</h1>
        <form action="./validarForms/validateNewSubject.php" method="post">
        <?php
            if(isset($_SESSION['cursoExistente']) && $_SESSION['cursoExistente'] === true){
                echo "<h3>·Ya existe un curso con esos datos</h3><br>";
                unset($_SESSION["cursoExistente"]);
            }
        ?>
            <label for="name">Letra</label><br>
            <input type="text" id="name" name="name" placeholder="Escribe la letra del grupo" required /><br>

            <div class="buttons">
                <button type="button" onclick="showHide('crearGrupo')" class="cancel-button">Cancelar</button>
                <button type="submit">Crear grupo</button>
            </div>
            <br>
        </form>
    </div>

    <div class="pop-up" id="eliminacionGrupo">
        <h1>Eliminar grupo</h1>
        <form action="./validarForms/validarEliminaciones/eliminarAsignatura.php" method="post">
        <?php
            $sql="SELECT IdGrupo FROM grupos WHERE profesor='{$_SESSION['mail']}'";
            $result=mysqli_query($conexion, $sql);
                  
                            ?>
            <label>¿Qué grupo quieres eliminar?</label><br><br>
            <select name="type" required>
                <option value="" disabled selected>--Elige una opcion</option>
                <?php while($grupos=mysqli_fetch_assoc($result)){ ?>
                
                <option value=<?php echo "{$grupos['IdGrupo']}" ?>>Grupo <?php echo "{$grupos['IdGrupo']}" ?></option>
                <?php } ?>
            </select><br><br>
            <div class="buttons">
                <button type="button" onclick="showHide('eliminacionGrupo')" class="cancel-button">Cancelar</button>
                <button type="submit">Eliminar grupo</button>
            </div>
            <br>
        </form>
    </div>

    <div class="pop-up" id="matriculacion">
        <h1>Solicitud matriculacion</h1>
        <form action="./validarForms/validarIncorporaciones/matriculacion.php" method="post">
        <?php
            $sql="SELECT IdGrupo FROM grupos";
            $result=mysqli_query($conexion, $sql);
        ?>
            <label>¿En qué grupo te quieres matricular?</label><br><br>
            <select name="type" required>
                <option value="" disabled selected>--Elige una opcion</option>
                <?php while($grupos=mysqli_fetch_assoc($result)){ ?>
                
                <option value=<?php echo "{$grupos['IdGrupo']}" ?>>Grupo <?php echo "{$grupos['IdGrupo']}" ?></option>
                <?php } ?>
            </select><br><br>
            <div class="buttons">
                <button type="button" onclick="showHide('matriculacion')" class="cancel-button">Cancelar</button>
                <button type="submit">Enviar solicitud</button>
            </div>
            <br>
        </form>
    </div>
    <!-- Header -->
    <?php
        require("./common/header.php");
        if(!isset($_SESSION['login']) || $_SESSION['login'] === false){
            header("Location: ./loginForm.php");
        }
        else{
            if(isset($_SESSION["subject"])){
                unset($_SESSION["subject"]);
            }
    
            if($_SESSION['rol'] === 'Administrador'){
                header("Location: ./principal.php");
            }
            elseif($_SESSION['rol'] === 'Estudiante'){
                $sql="SELECT subjectCod FROM matriculas WHERE userMail='{$_SESSION['mail']}'";
                $result=mysqli_query($conexion, $sql);
                $subject=mysqli_fetch_assoc($result);
                if($subject === NULL){
                    echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><h3>No estás matriculado en ningún grupo</h3><br><br>";
                    echo"<div class='buttons'><button type=\"button\" class=\"acceptButton\" onclick=\"showHide('matriculacion')\">Matricúlate</button></div>";
                }
                else{
                    $_SESSION["subject"] = $subject['subjectCod'];
                    header("Location: ./principal.php");
                }
            }
            else{         
    ?>
                <section id="index">

                    <div>
                        <h2>Grupos matriculados</h2><br>
                    </div>
        
                    <table>
                        <thead>
                            <tr>
                                <th>Grupo</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="SELECT IdGrupo FROM grupos WHERE profesor='{$_SESSION['mail']}'";
                                $result=mysqli_query($conexion, $sql);
                                while($grupo=mysqli_fetch_assoc($result)){      
                            ?>
                                    <tr>
                                        <td><a href="./validarForms/validateSubject.php?valor=<?php echo "{$grupo['IdGrupo']}" ?>" > Grupo <?php echo "{$grupo['IdGrupo']}" ?> </a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table><br><br>
                    <div class='buttons'>
                        <button type="button" class="cancel-button" onclick="showHide('eliminacionGrupo')">Eliminar grupo</button>
                        <button type="button" class="acceptButton" onclick="showHide('crearGrupo')">Crear grupo</button>
                    </div>
                </section>

    <!-- Footer -->
    <?php 
            }
        }
    require("./common/footer.php");
    ?>

</body>
</html>