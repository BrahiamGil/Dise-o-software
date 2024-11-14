<?php
include 'conexion.php';
if (isset($_POST['actualizar'])) {
    $id_estudiante = $_POST['id_estudiante'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $semestre = $_POST['semestre']; 
    $carrera = $_POST['carrera'];

    $sql = "UPDATE tbl_estudiante 
            SET nombres='$nombres', apellidos='$apellidos', semestre=$semestre, id_carrera=$carrera
            WHERE id_estudiante=$id_estudiante";

    if ($conexion->query($sql) === TRUE) {
        echo '<script>
            window.onload = function() {
                swal("¡Actualizado!", "Actualización exitosa", "success");
            };
        </script>';
    } else {
        echo '<script>
            window.onload = function() {
                swal("¡Error!", "Error al actualizar: ' . $conexion->error . '", "error");
            };
        </script>';
    }
}


if (isset($_GET['id_estudiante'])) {
    $id_estudiante = $_GET['id_estudiante'];
    $sql = "SELECT * FROM tbl_estudiante WHERE id_estudiante=$id_estudiante";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo '<script>
            swal("¡Error!", "No se encontró el estudiante", "error");
        </script>';
    }
} else {
    echo '<script>
        swal("¡Error!", "No se recibió el ID del estudiante", "error");
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Actualizar Datos</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Datos</h1>
        <form method="POST" action="update.php">
            <input type="hidden" name="id_estudiante" value="<?php echo isset($fila['id_estudiante']) ? $fila['id_estudiante'] : ''; ?>">
            <label>Actualizar Nombre:</label>
            <input type="text" name="nombres" value="<?php echo isset($fila['nombres']) ? $fila['nombres'] : ''; ?>" required>
            <label>Actualizar Apellido:</label>
            <input type="text" name="apellidos" value="<?php echo isset($fila['apellidos']) ? $fila['apellidos'] : ''; ?>" required>
            <label>Actualizar Semestre:</label>
            <input type="number" name="semestre" value="<?php echo isset($fila['semestre']) ? $fila['semestre'] : ''; ?>" required>
            <label>Actualizar Carrera:</label>
            <input type="number" name="carrera" value="<?php echo isset($fila['id_carrera']) ? $fila['id_carrera'] : ''; ?>" required>
            <input type="submit" name="actualizar" value="Actualizar datos">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>

<?php
$conexion->close();
?>
