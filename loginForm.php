<?php
require("./session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>LoginForm</title>
    <link rel="stylesheet" href="./styles/general.css" />
    <link rel="stylesheet" href="./styles/common.css" />
    <script src="./JS/buttons.js"></script>
</head>
<body>
    <header class="forms">
        <h1>Odontología</h1>
    </header>

    <section class="forms">
        <form action="./validarForms/validateLogin.php" method="post">
            <h2>Inicio de sesión</h2><br><br>
            <?php
            if(isset($_SESSION['error']) && $_SESSION['error'] === true){
                echo "<h3>·Datos incorrectos</h3><br>";
                unset($_SESSION["error"]);
            }
            ?>
            <label for="mail">Introduce tu correo</label><br>
            <input type="email" name="mail" id="mail" placeholder="@ucm.es" required />
            <br>
            <label for="pass">Contraseña</label><br>
            <input type="password" name="pass" id="pass" placeholder="Contraseña" required />
            <br><br>
            <div class="buttons">
                <button type="submit">Iniciar sesión</button>
            </div>
                <br>
        </form>
        <p id="enlace">No tienes cuenta, pincha <a href="./creacionUser.php">AQUÍ</a></p>
    </section>
    
    <?php require("./common/footer.php"); ?>

</body>
</html>