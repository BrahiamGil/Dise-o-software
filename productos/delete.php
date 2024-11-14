<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id_producto = intval($_POST['id_producto']); // Convertir a entero para mayor seguridad

    // Consulta SQL con marcador de posición
    $sql = "DELETE FROM tbl_producto WHERE id_producto = ?";

   
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular el parámetro (id_producto) a la consulta preparada
        $stmt->bind_param("i", $id_producto); // "i" indica que el parámetro es un entero

       
        if ($stmt->execute()) {
            header('Location: consulta.php?message=Producto eliminado con éxito');
            exit;
        } else {
            echo "Error al eliminar el producto: " . $stmt->error;
        }

        
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
}

$conexion->close();
?>

