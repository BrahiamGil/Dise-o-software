<?php
include 'conexion.php';

$sql = "SELECT tbl_estudiante.id_estudiante, tbl_estudiante.nombres, tbl_estudiante.apellidos, 
    tbl_carrera.nombre AS carrera, tbl_genero.nombre AS genero, tbl_estudiante.semestre, 
    tbl_estudiante.fecha_ingreso
    FROM tbl_estudiante
    INNER JOIN tbl_genero 
    ON tbl_estudiante.id_genero = tbl_genero.id_genero 
    INNER JOIN tbl_carrera ON tbl_estudiante.id_carrera = tbl_carrera.id_carrera;";

$resultado = $conexion->query($sql);
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Consulta</h1>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Carrera</th>
                    <th>Género</th>
                    <th>Semestre</th>
                    <th>Fecha de Ingreso</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' .($row["id_estudiante"]) . '</td>';
                        echo '<td>' .($row["nombres"]) . '</td>';
                        echo '<td>' .($row["apellidos"]) . '</td>';
                        echo '<td>' .($row["carrera"]) . '</td>';
                        echo '<td>' .($row["genero"]) . '</td>';                
                        echo '<td>' .($row["semestre"]) . '</td>';
                        echo '<td>' .($row["fecha_ingreso"]) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-center">No existen estudiantes</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


