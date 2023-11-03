<?php
function regresarConexion() {
    $servidor = 'localhost';
    $username = 'root';
    $password = ''; 
    $database = 'proyecto'; 
    $port = 3306; 

    $conexion = mysqli_connect($servidor, $username, $password, $database, $port) or die ('Error de conexión a la base de datos');
    mysqli_set_charset($conexion, 'utf8');
    return $conexion;
}
?>
