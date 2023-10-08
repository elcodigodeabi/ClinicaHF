<?php
// Iniciar la sesión
session_start();

// Comprobamos si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibimos los datos del formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    
    // Realiza la conexión a la base de datos (reemplaza con tus propios datos de conexión)
    $conexion = new mysqli("localhost", "usuario_bd", "contrasena_bd", "nombre_bd");
    
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    // Consultar la base de datos para verificar las credenciales
    $consulta = "SELECT id, usuario, rol FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param("ss", $usuario, $contrasena);
    $sentencia->execute();
    $sentencia->store_result();
    
    // Comprobar si se encontró un usuario con las credenciales proporcionadas
    if ($sentencia->num_rows === 1) {
        // Obtener los datos del usuario
        $sentencia->bind_result($id, $usuario, $rol);
        $sentencia->fetch();
        
        // Almacenar la información del usuario en una sesión
        $_SESSION["usuario_id"] = $id;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["rol"] = $rol;
        
        // Redirigir según el rol del usuario
        if ($rol === "1") {
            header("Location: secretaria.php");
        } elseif ($rol === "2") {
            header("Location: director.php");
        } else {
            echo "Rol desconocido.";
        }
    } else {
        // Si no se encontró el usuario, muestra un mensaje de error
        echo "Error: Credenciales incorrectas.";
    }
    
    // Cerrar la conexión y liberar recursos
    $sentencia->close();
    $conexion->close();
} else {
    // Si no se enviaron datos del formulario, redirigir al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}
?>
