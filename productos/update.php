<?php
include 'conexion.php';

if (isset($_POST['actualizar'])) {
    $id_producto = $_POST['id_producto']; 
    $nombre_producto = $_POST['nombre_producto']; 
    $existencia = $_POST['existencia']; 
    $valor_venta = $_POST['valor_venta']; 
    $id_vendedor = $_POST['id_vendedor'];
    
    $sql = "UPDATE tbl_producto 
            SET nombre_producto=?, existencia=?, valor_venta=?, id_vendedor=? 
            WHERE id_producto=?"; 

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssssi", $nombre_producto, $existencia, $valor_venta, $id_vendedor, $id_producto);

        if ($stmt->execute()) {
            echo '<script>
                window.onload = function() {
                    swal("¡Actualizado!", "Actualización exitosa", "success");
                };
            </script>';
        } else {
            echo '<script>
                window.onload = function() {
                    swal("¡Error!", "Error al actualizar: ' . $stmt->error . '", "error");
                };
            </script>';
        }
        $stmt->close();
    } else {
        echo '<script>
            window.onload = function() {
                swal("¡Error!", "Error al preparar la consulta SQL", "error");
            };
        </script>';
    }
}

// Comprobar si se ha recibido el id
if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto']; // Obtener el id

    // Consulta SQL preparada para obtener los datos del producto
    $sql = "SELECT * FROM tbl_producto WHERE id_producto=?";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();

        // Verificar si se encontró el producto en la base de datos
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
        } else {
            echo '<script>
                swal("¡Error!", "No se encontró el producto", "error");
            </script>';
        }
        $stmt->close();
    } else {
        echo '<script>
            window.onload = function() {
                swal("¡Error!", "Error al preparar la consulta SQL", "error");
            };
        </script>';
    }
} else {
    echo '<script>
        swal("¡Error!", "No se recibió el ID del producto", "error");
    </script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Datos del Producto</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Actualizar Producto</h3>
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="update.php">
                        <input type="hidden" name="id_producto" value="<?php echo isset($fila['id_producto']) ? $fila['id_producto'] : ''; ?>">
                        <div class="mb-3">
                            <label for="id_producto" class="form-label">Identificación del producto</label>
                            <input type="text" id="id_producto" name="id_producto" class="form-control" 
                        
                                   value="<?php echo isset($fila['id_producto']) ? $fila['id_producto'] : ''; ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                            <input type="text" id="nombre_producto" name="nombre_producto" class="form-control" 
                                   value="<?php echo isset($fila['nombre_producto']) ? $fila['nombre_producto'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="existencia" class="form-label">Existencia</label>
                            <input type="number" id="existencia" name="existencia" class="form-control" 
                                   value="<?php echo isset($fila['existencia']) ? $fila['existencia'] : ''; ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label for="valor_venta" class="form-label">Valor de Venta</label>
                            <input type="number" step="0.01" id="valor_venta" name="valor_venta" class="form-control" 
                                   value="<?php echo isset($fila['valor_venta']) ? $fila['valor_venta'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_vendedor" class="form-label">ID del Vendedor</label>
                            <input type="number" id="id_vendedor" name="id_vendedor" class="form-control" 
                                   value="<?php echo isset($fila['id_vendedor']) ? $fila['id_vendedor'] : ''; ?>" required>
                        </div>

                       
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="actualizar" class="btn btn-success">Actualizar datos</button>
                            <a href="lista_productos.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

$conexion->close();
?>


