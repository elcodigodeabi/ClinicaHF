<?php
include 'conexion.php'; // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $apellido = $_POST["apellido"];
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $mail = $_POST["mail"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];
    $horario = $_POST["horario"];
    $are_id = $_POST["are_id"];
    $med_id = $_POST["med_id"];

    // Conéctate a la base de datos
    $conexion = conectarBD();

    // Verificar si el horario está disponible
    $consultaDisponibilidad = $conexion->prepare("SELECT id FROM turnos WHERE fecha = ? AND horario = ? AND med_id = ?");
    $consultaDisponibilidad->bind_param("ssi", $fecha, $horario, $med_id);
    $consultaDisponibilidad->execute();
    $consultaDisponibilidad->store_result();

    // Si no hay ningún turno en el mismo horario, guarda el turno
    if ($consultaDisponibilidad->num_rows == 0) {
        $consultaDisponibilidad->close();

        $consulta = $conexion->prepare("INSERT INTO turnos (apellido, nombre, mail, telefono, fecha, horario, are_id, med_id, dni) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("ssssssiii", $apellido, $nombre, $mail, $telefono, $fecha, $horario, $are_id, $med_id, $dni);

        // Intenta ejecutar la consulta de inserción
        if ($consulta->execute()) {
            $mensaje = "El turno se ha guardado exitosamente.";
            header("Location: coningreso.php?mensaje=" . urlencode($mensaje));
            exit();
        } else {
            $mensaje = "Ha ocurrido un error al guardar el turno: " . $conexion->error;
        }

        $consulta->close();
    } else {
        $mensaje = "El horario no está disponible. Por favor, elige otro horario.";
    }

    $conexion->close();
}

// Redireccionar de vuelta a la página de ingreso después de guardar el turno
header("Location: ingreso.php?mensaje=" . urlencode($mensaje));
exit();
?>
