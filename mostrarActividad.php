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
        $nombre = $_GET['valor'];
        $sql = "SELECT * FROM actividades WHERE nombre='$nombre' AND asignatura='{$_SESSION['subject']}'";
        $result = mysqli_query($conexion, $sql);
        $actividad=mysqli_fetch_array($result);
        $file = $actividad['archivo']
    ?>

    
    <section id="index">
        <?php
        $directorio = './Files/';
        if (isset($file)) {
            $file = basename($file);
            $filePath = $directorio . '/' . $file;
            if (file_exists($filePath) && strpos(realpath($filePath), realpath($directorio)) === 0) {
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $allowedVideoExtensions = ['mp4', 'avi'];

                if (in_array($fileExtension, $allowedImageExtensions)) {
                    echo "<img class='archivo' src=\"$filePath\" alt=\"Archivo\" >";
                } elseif (in_array($fileExtension, $allowedVideoExtensions)) {
                    echo "<video width=\"600\" controls>
                            <source src=\"$filePath\" type=\"video/$fileExtension\">
                            Tu navegador no soporta la etiqueta de video.
                        </video>";
                } elseif ($fileExtension === 'pdf') {
                    echo "<iframe class='archivo' src=\"$filePath\"></iframe>";
                } else {
                    
                }
            } else {
                echo "El archivo no existe o no está permitido.";
            }
        } else {
            echo "No se ha especificado ningún archivo.";
        }
        ?>
        <div class="buttons">
            <button type="button" onclick="cancel()" class="cancel-button">Volver</button>
            <button type="button" class="accept-button">Descargar</button>
        </div>
        
    </section>

    <!-- Footer -->
    <?php require("./common/footer.php"); ?>

</body>
</html>