<?php
// Incluir el archivo de clases
include("clases.php");

// Iniciar la sesión
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibimos los datos del formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    
    // Crear una instancia de la clase de conexión a la base de datos
    $conexion = new ConexionBD();
    
    // Verificar la conexión
    if (!$conexion->conectar()) {
        die("Error de conexión: " . $conexion->getError());
    }
    
    // Crear una instancia de la clase Usuario y pasarle la conexión
    $usuarioObj = new Usuario($conexion->getConexion());
    
    // Intentar autenticar al usuario
    if ($usuarioObj->autenticar($usuario, $contrasena)) {
        // Obtener el rol del usuario autenticado
        $rol = $usuarioObj->getRol();
        
        // Almacenar la información del usuario en una sesión
        $_SESSION["usuario_id"] = $usuarioObj->getId();
        $_SESSION["usuario"] = $usuarioObj->getUsuario();
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
        // Si la autenticación falla, muestra un mensaje de error
        echo "Error: Credenciales incorrectas.";
    }
    
    // Cerrar la conexión
    $conexion->cerrar();
} else {
    // Si no se enviaron datos del formulario, redirigir al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}
?>
