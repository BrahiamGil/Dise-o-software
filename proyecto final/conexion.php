<?php

$host = "localhost"; //conecando al servidor mySQL also with the MySQL port
$bd_name = "db_productos"; //Nombre de la base de datos
$username = "root"; //usuario mySQL
$password = ""; //Contraseña  de mySQL

// mysql -u root -p -h localhost -P 3306 bd_exito


// Conectarse a la base de datos mySQL
$conexion = new mysqli($host, $username, $password, $bd_name);

/*Verificar la conexion 

if ($conexion->connect_error) {
    die("Error de conexion: " . $conexion-> connect_error);

}else{
    echo "Conectado exitosamente"; 
}
*/
?>





