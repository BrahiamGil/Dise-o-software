<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $id_facultad = $_POST['facultad'];

$sql = "INSERT INTO tbl_carrera (id_carrera, nombre, id_facultad) VALUES (NULL, '$nombre', '$id_facultad')";

if ($conexion->query($sql) === TRUE) {
    echo '<script>
    window.onload = function() {
        swal("¡Carrera!", "Carrera insertada exitosamente", "success");
    };
</script>';

} else {
    echo '<script>
    window.onload = function() {
        swal("¡Carrera!", "Error al insertar la Carrera", "error");
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
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="container">

    <h1>Insertar Carrera</h1>

    <div class="formulario">
    <form method="post" action="insert_carrera.php">
        Nombre: <input type="text" name="nombre" required><br>
        Facultad:
        <select name="facultad">
            <option>Selecione una facultad</option>
            <?php
            if($resultado-> num_rows > 0){
                while($fila = $resultado-> fetch_assoc()){
                    echo '<option value="'.$fila['id_facultad'].'">'.$fila['nombre'].'</option>';
                    #<option value="3">Ingenieria</option>
                    #<option value="4">Derecho</option>
                    #<option value="5">Artes</option>
                }
            }else{
                echo '<option value="">No hay facultades</option>';
            }
            ?>
        </select><br>

        <input type="submit" value="Crear Carrera">
    </form>
    </div>
</div>
<!-- SweetAlert2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>