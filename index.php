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
    ?>

    
    <section id="index">
        <!-- Option 1-->
        <div>
            <h2>Cursos matriculados</h2><br>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>

            
    <?php
        if($_SESSION["rol"] === "Profesor"){
            $sql="SELECT name, id FROM subject WHERE teacher='{$_SESSION['mail']}'";
            $result=mysqli_query($conexion, $sql);
            while($subjects=mysqli_fetch_assoc($result)){
        
        
        
    ?>
            <tr>
                <td><?php echo "{$subjects['id']}" ?></td>
                <td><a href="./validarForms/validateSubject.php?valor=<?php echo "{$subjects['name']}" ?>" > <?php echo "{$subjects['name']}" ?> </a></td>
            </tr>
    <?php
            }
        }
        else{
            $sql= "SELECT name,id FROM subject AS sb JOIN matriculas AS mt ON mt.subjectCod=sb.id WHERE userMail='{$_SESSION['mail']}'";
            $result=mysqli_query($conexion, $sql);
            while($subjects=mysqli_fetch_assoc($result)){
    ?>
            <tr>
                <td><?php echo "{$subjects['id']}" ?></td>
                <td><a href="./validarForms/validateSubject.php?valor=<?php echo "{$subjects['name']}" ?>" > <?php echo "{$subjects['name']}" ?> </a></td>
            </tr>
    <?php
            }
        }
    }

    ?>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php require("./common/footer.php"); ?>

</body>
</html>