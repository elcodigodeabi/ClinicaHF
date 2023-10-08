<?php
session_start();

if (!isset($_SESSION['turnos'])) {
    $_SESSION['turnos'] = [];
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_valido'])) {
    header("Location: index.php");
    exit();
}


// Inicializar variables de error
$mensaje_error = "";

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

    // Validar que los campos requeridos estén completos
    if (!empty($dni) && !empty($apellido) && !empty($nombre) && !empty($mail) && !empty($tel) && !empty($fecha) && !empty($horario)) {
        // Crear un nuevo turno con los datos ingresados
        $nuevo_turno = [
            'dni' => $dni,
            'apellido' => $apellido,
            'nombre' => $nombre,
            'mail' => $mail,
            'tel' => $tel,
            'fecha' => $fecha,
            'horario' => $horario
        ];
        $_SESSION['turnos'][] = $nuevo_turno; 
    } else {
        $mensaje_error = "Todos los campos son obligatorios.";
    }

    $mensaje_exito = "El turno se ha registrado correctamente.";
    } else {
        $mensaje_error = "Todos los campos son obligatorios.";
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
        <label for="dni">DNI :</label>
        <input type="number" name="dni" required minlength="8" maxlength="8"><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label for="mail">Correo Electrónico:</label>
        <input type="email" name="mail" required><br><br>

        <label for="tel">Teléfono:</label>
        <input type="number" name="tel" id="tel" pattern="[0-9]{12,}" required><br><br>

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

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required><br><br>

        <label for="horario">Horario:</label>
        <input type="time" name="horario" required><br><br>

        <input type="submit" name="nuevo_turno" value="Agregar Turno">
    </form>

    <p><a href="secretario.php">Volver al Tablero</a></p>

    <?php if (isset($mensaje_error)) : ?>
        <p><?php echo $mensaje_error; ?></p>
    <?php endif; ?>
</body>
</html>
