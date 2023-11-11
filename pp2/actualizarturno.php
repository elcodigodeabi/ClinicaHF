<?php
include 'conexion.php'; // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $id_turno = $_POST["id_turnos"];
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

    // Conéctate a la base de datos
    $conexion = conectarBD();

    // Actualiza el turno en la base de datos
    $consultaActualizarTurno = $conexion->prepare("UPDATE turnos SET apellido = ?, nombre = ?, dni = ?, mail = ?, telefono = ?, fecha = ?, horario = ?, are_id = ?, med_id = ? WHERE id_turno = ?");
    $consultaActualizarTurno->bind_param("ssssssiiii", $apellido, $nombre, $dni, $mail, $telefono, $fechaFormateada, $horarioFormateado, $are_id, $med_id, $id_turno);

    if ($consultaActualizarTurno->execute()) {
        $mensaje = "El turno se ha actualizado exitosamente.";
        header("Location: secretaria.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        $mensaje = "Ha ocurrido un error al actualizar el turno: " . $conexion->error;
    }

    $consultaActualizarTurno->close();
    $conexion->close();
} else {
    $mensaje = "Error en la solicitud de actualización.";
}

header("Location: secretaria.php?mensaje=" . urlencode($mensaje));
exit();
?>
