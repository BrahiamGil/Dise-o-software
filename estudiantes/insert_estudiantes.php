<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_estudiante = $_POST['id_estudiante'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $semestre = $_POST['semestre'];
    $id_genero = $_POST['id_genero'];
    $id_carrera = $_POST['id_carrera'];
    $telefono_fijo = $_POST['telefono_fijo'];
    $telefono_opcional = $_POST['telefono_opcional'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $salario_deuda = $_POST['salario_deuda']; 
    $correo = $_POST['correo'];
    // Usar prepared statement
    $sql = "INSERT INTO tbl_estudiante (id_estudiante, nombres, apellidos, semestre, id_genero, id_carrera,
    telefono_fijo, telefono_opcional, fecha_ingreso, salario_deuda, correo) 
    VALUES ('$id_estudiante','$nombres','$apellidos','$semestre','$id_genero','$id_carrera','$telefono_fijo',
    '$telefono_opcional','$fecha_ingreso', '$salario_deuda','$correo')";


if ($conexion->query($sql) === TRUE) {
    echo '<script>
    window.onload = function() {
        swal("¡Estudiante!", "Estudiante insertado exitosamente", "success");
    };
</script>';

} else {
    echo '<script>
    window.onload = function() {
        swal("¡Estudiantes!", "Error al insertar el Estudiante", "error");
    };
</script>';
}
}

$conexion->close(); 
?>

<?php
include 'conexion.php';
$sql = "SELECT id_carrera, nombre FROM tbl_carrera";
$resultado_carrera = $conexion->query($sql);
?>

<?php
$sql = "SELECT id_genero, nombre FROM tbl_genero";
$resultado_genero = $conexion->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="style.css">
    
    <title>Insertar Estudiante</title>
</head>
<body>
    <div class="formulario">
        <h1>Ingrese sus datos</h1>
        <form method="POST" action="insert_estudiantes.php">
            ID Estudiante
            <input type="number" name="id_estudiante" required><br>
            Nombres
            <input type="text" name="nombres" required><br>
            Apellidos
            <input type="text" name="apellidos" required><br>
            Semestre
            <input type="number" name="semestre" required><br>
            Género<br>
            <select name="id_genero" required><br>
                <?php
                if ($resultado_genero->num_rows > 0) {
                    while ($fila1 = $resultado_genero->fetch_assoc()) {
                        echo '<option value="' . $fila1['id_genero'] . '">' . $fila1['nombre'] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay carreras</option>';
                }
                ?>
            </select><br>

            Carrera<br>
            <select name="id_carrera" required><br>
                <?php
                if ($resultado_carrera->num_rows > 0) {
                    while ($fila2 = $resultado_carrera->fetch_assoc()) {
                        echo '<option value="' . $fila2['id_carrera'] . '">' . $fila2['nombre'] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay carreras</option>';
                }
                ?>
            </select><br>
            Telefono celular: <input type="number" name="telefono_fijo" required><br>
            Telefono fijo: <input type="number" name="telefono_opcional"><br>
            Fecha ingreso: <input type="date" name="fecha_ingreso" required><br>
            Saldo deuda: <input type="number" name="salario_deuda" required><br>
            Correo: <input type="email" name="correo" required><br>
            <input type="submit" value="Crear estudiante">
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>

