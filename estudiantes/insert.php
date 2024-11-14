<?php

    include 'conexion.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = $_POST['nombre'];

        // Use prepared statements to prevent SQL injection
       $sql = "INSERT INTO tbl_facultad (id_facultad, nombre) VALUES (NULL, '$nombre')";


        if ($conexion->query($sql) === TRUE){
                echo '<script>
                window.onload = function() {
                    swal("¡Facultad!", "Facultad insertada exitosamente", "success");
                };
            </script>';
            
            } else {
                echo '<script>
                window.onload = function() {
                    swal("¡Facultad!", "Error al insertar la Facultad", "error");
                };
            </script>';
            }
            }
    $conexion-> close();

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="formulario">
        <h1>Insertar facultad</h1>
        <form method="POST" action="insert.php">
            Nombre: 
            <input type = "Text" name = "nombre" required >
            <input type="submit" value = "crear facultad">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>