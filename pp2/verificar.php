<?php
session_start(); // Inicia la sesión
include 'conexion.php'; // Incluye el archivo de conexión

// Verifica si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    
    // Conéctate a la base de datos
    $conexion = conectarBD();

    // Evitar la inyección SQL usando consultas preparadas
    $consulta = $conexion->prepare("SELECT nombre, rol_id FROM usuario WHERE usuario = ? AND contrasena = ?");
    $consulta->bind_param("ss", $usuario, $contrasena);

    // Ejecuta la consulta
    $consulta->execute();
    $consulta->store_result();

    // Verifica si se encontró un usuario con las credenciales proporcionadas
    if ($consulta->num_rows == 1) {
        $consulta->bind_result($nombre, $rol_id);
        $consulta->fetch();

        // Almacena el rol en la sesión
        $_SESSION['rol_id'] = $rol_id;
        // Después de que el usuario inicie sesión con éxito, configura la variable de sesión
        $_SESSION['nombre'] = $nombre; // Reemplaza 'Nombre del Usuario' con el nombre real del usuario


        // Redirige al usuario según el rol
        if ($rol_id == 1) {
            header("Location: secretaria.php");
        } elseif ($rol_id == 2) {
            header("Location: director.php");
        } else {
            echo "Rol no válido.";
        }
    } else {
        echo "Credenciales incorrectas. Inténtalo de nuevo.";
    }

    $consulta->close();
    $conexion->close();
}
?>
