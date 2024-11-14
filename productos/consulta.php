<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Productos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Consulta de Productos</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre Producto</th>
                    <th>Existencia</th>
                    <th>Valor Venta</th>
                    <th>Fecha Última Venta</th>
                    <th>Nombre Vendedor</th>
                    <th>Unidad de Medida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'conexion.php';
            $sql = "SELECT 
                        tbl_producto.id_producto, 
                        tbl_producto.nombre_producto, 
                        tbl_producto.existencia, 
                        tbl_producto.valor_venta, 
                        tbl_producto.fecha_ultima_venta, 
                        tbl_vendedor.nombre AS nombre_vendedor, 
                        tbl_unidad_de_medida.nombre AS unidad_medida
                    FROM 
                        tbl_producto
                    INNER JOIN 
                        tbl_vendedor ON tbl_producto.id_vendedor = tbl_vendedor.id_vendedor 
                    INNER JOIN 
                        tbl_unidad_de_medida ON tbl_producto.id_unidad_de_medidad = tbl_unidad_de_medida.id_medida;";

            // Ejecutamos la consulta SQL
            $resultado = $conexion->query($sql);

            
            if (!$resultado) {
                die("Error en la consulta: " . $conexion->error);
            }

            if ($resultado->num_rows > 0) {
                // Iteramos sobre los resultados y mostramos cada fila de datos en la tabla
                while ($row = $resultado->fetch_assoc()) {
                    echo '<tr id="row_' . $row["id_producto"] . '">';  
                    echo '<td>' . $row["id_producto"] . '</td>';  
                    echo '<td>' . $row["nombre_producto"] . '</td>';  
                    echo '<td>' . $row["existencia"] . '</td>';  
                    echo '<td>' . number_format($row["valor_venta"], 2, ',', '.') . '</td>';  
                    echo '<td>' . date('d/m/Y', strtotime($row["fecha_ultima_venta"])) . '</td>'; 
                    echo '<td>' . $row["nombre_vendedor"] . '</td>';  
                    echo '<td>' . $row["unidad_medida"] . '</td>'; 

                    echo '<td class="text-center">
                            <!-- Botón de editar (redirige a update.php con el ID del producto) -->
                            <a href="update.php?id_producto=' . $row['id_producto'] . '" class="btn btn-warning btn-sm" title="Editar Producto">
                                <span class="material-icons">edit</span>
                            </a>
                            
                            <!-- Formulario para eliminar producto (envía el ID a delete.php) -->
                            <form action="delete.php" method="POST" style="display:inline;" class="d-inline-block">
                                <input type="hidden" name="id_producto" value="' . $row['id_producto'] . '">
                                <!-- Botón de eliminar con confirmación antes de proceder -->
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Producto" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este producto?\');">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                          </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No existen productos</td></tr>';
            }
            $conexion->close();
            ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center p-3">
        <form class="form-inline" action="insert_producto.php" method="get">
            <button class="btn btn-primary text-white" type="submit">Agregar Producto</button>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
