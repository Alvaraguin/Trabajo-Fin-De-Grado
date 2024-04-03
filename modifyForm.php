<?php
require("./session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modify</title>
    <link rel="stylesheet" href="./styles/general.css" />
    <link rel="stylesheet" href="./styles/common.css" />
    <script src="./JS/buttons.js"></script>
</head>
<body>
    <header>
        <h1>Modificar perfil</h1>
    </header>

    <section class="forms">
        <form action="./validarForms/validateModifications.php" method="post">
            <?php
            if(isset($_SESSION['dniUsado']) && $_SESSION['dniUsado'] === true){
                echo "<h3>·El dni introducido ya está en uso</h3><br>";
                unset($_SESSION["dniUsado"]);
            }
            if(isset($_SESSION['claveMala']) && $_SESSION['claveMala'] === true){
                echo "<h3>·Las contraseñas no coinciden</h3><br>";
                unset($_SESSION["claveMala"]);
            }
            $sql="SELECT * FROM usuarios WHERE email='{$_SESSION['mail']}'";
            $result=mysqli_query($conexion, $sql);
            $usuario=mysqli_fetch_assoc($result);
            ?>
            <label for="mail">Correo</label>
            <input type="email" name="mail" id="mail" placeholder="<?php echo"{$usuario['email']}"; ?>" disabled /><br>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="nombre" placeholder="<?php echo"{$usuario['nombre']}"; ?>"/><br>
            <label for="dni">Escribe tu DNI</label>
            <input type="text" id="dni" name="dni" placeholder="<?php echo"{$usuario['dni']}"; ?>" minlength="9" maxlength="9" /><br>
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass" placeholder="Nueva contraseña" /><br>
            <label for="pass2">Repite la nieva contraseña</label>
            <input type="password" name="pass2" id="pass2" placeholder="Repite contraseña" />
            <br><br>
            <div class="buttons">
                <button type="button" onclick="cancel()" class="cancel-button">Cancelar</button>

                <button type="submit">Modificar</button>
            </div>
            <br>
        </form>
    </section>
    
    <?php require("./common/footer.php"); ?>

</body>
</html>