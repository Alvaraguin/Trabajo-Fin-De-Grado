<!DOCTYPE html>
<html>
<head>
    <title>Login/NewUser</title>
    <link rel="stylesheet" href="./styles/general.css" />
    <link rel="stylesheet" href="./styles/common.css" />
</head>
<body>
    <header>
        <h1>Identifícate</h1>
    </header>

    <section id="new">

        <form action="./creacionUser.php">
            <button type="submit">Nuevo usuario</button>
        </form>
        <form action="./loginForm.php">
            <button type="submit">Login</button>
        </form>
        
        <br>
    </section>

    <?php require("./common/footer.php"); ?>


</body>
</html>