<?php
session_start();

// Incluir el archivo de clases
include("clases.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_valido'])) {
    header("Location: index.php");
    exit();
}

// Inicializar variables de error y éxito
$mensaje_error = "";
$mensaje_exito = "";

// Verificar si se ha enviado un nuevo turno desde el formulario de carga de datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nuevo_turno'])) {
    // Obtener los datos ingresados por el usuario
    $dni = $_POST['dni'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];
    $area = $_POST['area']; // Agregamos el campo de área
    $profesional = $_POST['profesional']; // Agregamos el campo de profesional

    // Validar que los campos requeridos estén completos
    if (!empty($dni) && !empty($apellido) && !empty($nombre) && !empty($mail) && !empty($tel) && !empty($fecha) && !empty($horario) && !empty($area) && !empty($profesional)) {
        // Crear una instancia de la clase de conexión a la base de datos
        $conexion = new ConexionBD();
        
        // Verificar la conexión
        if (!$conexion->conectar()) {
            die("Error de conexión: " . $conexion->getError());
        }
        
        // Crear una instancia de la clase Turno con los datos ingresados
        $nuevo_turno = new Turno(null, $dni, $apellido, $nombre, $mail, $tel, $fecha, $horario, $area, $profesional);
        
        // Guardar el turno en la base de datos
        if ($nuevo_turno->guardar($conexion->getConexion())) {
            $mensaje_exito = "El turno se ha registrado correctamente.";
        } else {
            $mensaje_error = "Error al registrar el turno en la base de datos.";
        }
        
        // Cerrar la conexión
        $conexion->cerrar();
    } else {
        $mensaje_error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cargar Turnos</title>
</head>
<body>
    <h2>Ingresar Turno</h2>
    <form method="post">
        <!-- Campos del formulario -->
        <!-- ... (otros campos) ... -->
        
        <!-- Selección de Área -->
        <label for="area">Área:</label>
        <select name="area" id="area" required>
            <option value="cardiologia">Cardiología</option>
            <option value="neurologia">Neurología</option>
            <option value="general">General</option>
            <option value="pediatria">Pediatría</option>
        </select><br><br>
        
        <!-- Selección de Profesional -->
        <label for="profesional">Profesional:</label>
        <select name="profesional" id="profesional" required>
            <option value="1">Huffmann</option>
            <option value="2">Perez Pardo</option>
            <option value="3">Vargas</option>
            <option value="4">Abi Rached</option>
        </select><br><br>

        <input type="submit" name="nuevo_turno" value="Agregar Turno">
    </form>

    <p><a href="secretario.php">Volver al Tablero</a></p>

    <?php if (isset($mensaje_error)) : ?>
        <p><?php echo $mensaje_error; ?></p>
    <?php endif; ?>
    
    <?php if (isset($mensaje_exito)) : ?>
        <p><?php echo $mensaje_exito; ?></p>
    <?php endif; ?>
</body>
</html>
