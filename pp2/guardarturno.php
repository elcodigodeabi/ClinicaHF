<?php
include 'conexion.php'; // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $apellido = $_POST["apellido"];
    $nombre = $_POST["nombre"];
    $mail = $_POST["mail"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];
    $horario = $_POST["horario"];
    $are_id = $_POST["are_id"];
    $med_id = $_POST["med_id"];

    // Conéctate a la base de datos
    $conexion = conectarBD();

    $consulta = $conexion->prepare("INSERT INTO turnos (apellido, nombre, mail, telefono, fecha, horario, are_id, med_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $consulta->bind_param("ssssssii", $apellido, $nombre, $mail, $telefono, $fecha, $horario, $are_id, $med_id);
    
    // Intenta ejecutar la consulta de inserción
    if ($consulta->execute()) {
        $mensaje = "El turno se ha guardado exitosamente.";
        header("Location: coningreso.php?mensaje=" . urlencode($mensaje));
exit();
    } else {
        $mensaje = "Ha ocurrido un error al guardar el turno: " . $conexion->error;
    }

    $consulta->close();
    $conexion->close();
}

// Redireccionar de vuelta a la página de ingreso después de guardar el turno
header("Location: ingreso.php?mensaje=" . urlencode($mensaje));
exit();
?>

