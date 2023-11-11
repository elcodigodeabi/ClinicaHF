<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = $_POST["apellido"];
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $mail = $_POST["mail"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];
    $horario = $_POST["horario"];
    $are_id = $_POST["are_id"];
    $med_id = $_POST["med_id"];

    $fechaFormateada = date("Y-m-d", strtotime($fecha));
    $horarioFormateado = date("H:i:s", strtotime($horario));

    $conexion = conectarBD();

    // Verificar si el médico tiene disponibilidad en el horario solicitado
    $consultaHorarioLaboral = $conexion->prepare("SELECT * FROM horarios_medicos WHERE med_id = ? AND dia_semana = DAYOFWEEK(?) AND ? BETWEEN hora_inicio AND hora_fin");
    $consultaHorarioLaboral->bind_param("iss", $med_id, $fechaFormateada, $horarioFormateado);
    $consultaHorarioLaboral->execute();
    $consultaHorarioLaboral->store_result();

    if ($consultaHorarioLaboral->num_rows > 0) {
        $consultaHorarioLaboral->close();

        // Verificar si el turno ya está ocupado
        $consultaDisponibilidad = $conexion->prepare("SELECT id FROM turnos WHERE fecha = ? AND horario = ? AND med_id = ?");
        $consultaDisponibilidad->bind_param("ssi", $fechaFormateada, $horarioFormateado, $med_id);
        $consultaDisponibilidad->execute();
        $consultaDisponibilidad->store_result();

        if ($consultaDisponibilidad->num_rows == 0) {
            $consultaDisponibilidad->close();

            // Insertar el turno
            $consultaInsertarTurno = $conexion->prepare("INSERT INTO turnos (apellido, nombre, mail, telefono, fecha, horario, are_id, med_id, dni) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $consultaInsertarTurno->bind_param("ssssssiii", $apellido, $nombre, $mail, $telefono, $fechaFormateada, $horarioFormateado, $are_id, $med_id, $dni);

            if ($consultaInsertarTurno->execute()) {
                $mensaje = "El turno se ha guardado exitosamente.";
                header("Location: coningreso.php?mensaje=" . urlencode($mensaje));
                exit();
            } else {
                $mensaje = "Ha ocurrido un error al guardar el turno: " . $conexion->error;
            }

            $consultaInsertarTurno->close();
        } else {
            $mensaje = "El turno ya está ocupado. Por favor, elige otro horario.";
        }
    } else {
        $mensaje = "El horario está por fuera del horario laboral del profesional.";
    }

    $conexion->close();
}

header("Location: ingreso.php?mensaje=" . urlencode($mensaje));
exit();
?>
