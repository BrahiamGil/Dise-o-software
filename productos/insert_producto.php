<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $id_vendedor = $_POST['id_vendedor'];
    $existencia = $_POST['existencia'];
    $id_medida = $_POST['id_medida'];
    $valor_venta = $_POST['valor_venta'];
    $fecha_ultima_venta = $_POST['fecha_ultima_venta'];

    
    $sql = "INSERT INTO tbl_producto (nombre_producto, id_vendedor, existencia, id_unidad_de_medidad, valor_venta, fecha_ultima_venta) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros a la consulta
        $stmt->bind_param("siidss", $nombre_producto, $id_vendedor, $existencia, $id_medida, $valor_venta, $fecha_ultima_venta);
        
       
        if ($stmt->execute()) {
            echo '<script>
            window.onload = function() {
                swal("", "Producto Insertado Exitosamente", "success");
            };
            </script>';
        } else {
            echo '<script>
            window.onload = function() {
                swal("", "Error al insertar el producto", "error");
            };
            </script>';
        }

        
        $stmt->close();
    }
}


$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Insertar Producto</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Insertar Producto</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="insert_producto.php">
                       
                        <div class="mb-3">
                        <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                        </div>

                        
                        <div class="mb-3">
                        <label for="id_vendedor" class="form-label">Vendedor</label>
                        <select name="id_vendedor" id="id_vendedor" class="form-select" required>
                        <option value="">Seleccionar Vendedor</option>
                        
    <?php 
    include 'conexion.php';  

    // Se define la consulta SQL que recuperará el id y el nombre de los vendedores.
    $sql = "SELECT id_vendedor, nombre FROM tbl_vendedor";
    
    // Ejecuta la consulta SQL y almacena el resultado en $resultadoven.
    $resultadoven = $conexion->query($sql);
    
    // Verifica si la consulta ha devuelto al menos una fila (registros).
    if ($resultadoven->num_rows > 0) {
        
        // Si hay resultados, recorre cada fila y muestra las opciones.
        while ($filaven = $resultadoven->fetch_assoc()) {
            
            // Para cada fila, se genera una opción de selección <option> en HTML.
            // El valor de cada opción será el 'id_vendedor' y el texto visible será el 'nombre'.
            echo '<option value="' . $filaven['id_vendedor'] . '">' . $filaven['nombre'] . '</option>';
        }
    }
?>

</select>
    </div>

    <div class="mb-3">
    <label for="existencia" class="form-label">Existencias</label>
    <input type="number" class="form-control" id="existencia" name="existencia" required>
    </div>
    <div class="mb-3">
    <label for="id_medida" class="form-label">Medida</label>
        <select name="id_medida" id="id_medida" class="form-select" required>
            <option value="">Seleccionar Medida</option>
                <?php 
                $sql = "SELECT id_medida, nombre FROM tbl_unidad_de_medida";
                $resultadomed = $conexion->query($sql);
                if ($resultadomed->num_rows > 0) {
                while ($filamed = $resultadomed->fetch_assoc()) {
                echo '<option value="' . $filamed['id_medida'] . '">' . $filamed['nombre'] . '</option>';
                }
                 }
                ?>
                </select>
                </div>

                <div class="mb-3">
                <label for="valor_venta" class="form-label">Valor Venta</label>
                <input type="number" step="0.01" class="form-control" id="valor_venta" name="valor_venta" required>
                </div>

                <div class="mb-3">
                <label for="fecha_ultima_venta" class="form-label">Fecha Última Venta</label>
                <input type="date" class="form-control" id="fecha_ultima_venta" name="fecha_ultima_venta" required>
                </div>

                <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Ingresar Producto</button>
                <input type="reset" class="btn btn-danger" value="Eliminar">
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
