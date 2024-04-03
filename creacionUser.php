<?php
require("session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration new user</title>
    <link rel="stylesheet" href="./styles/general.css" />
    <link rel="stylesheet" href="./styles/common.css" />
    <script src="./JS/buttons.js"></script>
</head>
<body>
    <header>
        <h1>Odontología</h1>
    </header>

    <section class="forms">
        <form action="./validarForms/validarNuevoUsuario.php" method="POST">
            <h2>Nuevo usuario</h2><br><br>
            <?php
                if(isset($_SESSION['usuarioExistente']) && $_SESSION['usuarioExistente'] === true){
                    echo "<h3>·Usuario ya existente</h3><br>";
                    unset($_SESSION["usuarioExistente"]);
                }
            ?>
            <label for="email">Correo electrónico</label>
            <br>
            <input type="email" id="email" name="email" placeholder="@ucm.es" required />
            <br>
        
            <label for="name">Nombre</label>
            <br>
            <input type="text" id="name" name="name" placeholder="Escribe tu nombre" required />
            <br>

            <label for="dni">Escribe tu DNI</label>
            <br>
            <input type="text" id="dni" name="dni" placeholder="XXXXXXXX L" maxlength="9" required />
            <br>

            <?php
                if(isset($_SESSION['claveMala']) && $_SESSION['claveMala'] === true){
                    echo "<h3>·Las contraseñas no coinciden</h3><br>";
                }
            ?>
            <label for="pass">Contraseña</label>
            <br>
            <input type="password" id="pass" name="pass" placeholder="Contraseña" required />
            <br>

            <label for="pass2">Repite la contraseña</label>
            <br>
            <input type="password" id="pass2" name="pass2" placeholder="Contraseña" required />
            <br>

            <p>¿Quién eres?</p>
            <select name="rol" required>
                <option value="" disabled selected>--Elige una opción--</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Profesor">Profesor</option>
                <option value="Administrador">Administrador</option>
            </select>
            <br><br>
            <div class="buttons">
                <button type="button" onclick="cancel()" class="cancel-button">Cancelar</button>

                <button type="submit">Crear usuario</button>
            </div>
            <br>
        </form>
    </section>


    <?php
        require("./common/footer.php");
    ?>

</body>
</html>