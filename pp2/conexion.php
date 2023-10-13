<?php
function conectarBD() {
    // Datos de conexión a la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $baseDeDatos = "baseclinica";

    // Intentar establecer la conexión a la base de datos
    $conexion = new mysqli($servidor, $usuario, $contrasena, $baseDeDatos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}
?>
