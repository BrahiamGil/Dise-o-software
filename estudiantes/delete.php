<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $sql = "DELETE FROM tbl_estudiante WHERE id_estudiante = $id";

    if ($conexion->query($sql) === TRUE) {
        echo '<script>
        window.onload = function() {
            swal("¡Borrado!", "Estudiante Borrado exitosamente", "success");
        };
        </script>';
    } else {
        echo '<script>
        window.onload = function() {
            swal("¡Borrado!", "Error al Borrar: ' . $conexion->error . '", "error");
        };
        </script>';
    }
}

$conexion->close();
?>

<?php
include 'conexion.php';
$sql = "SELECT id_facultad, nombre FROM tbl_facultad";
$resultado = $conexion->query($sql);
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
        <h1>Eliminar Estudiante</h1>
        <form method="get" action="delete.php">
            Identificación Estudiante <input type="number" name="id" required>
            <br>
            <input type="submit" value="Borrar estudiante">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>  
</body>
</html>
