<?php
// Supongamos que los datos del formulario se reciben mediante $_POST
$fecha_solicitada = $_POST['fecha'];
$hora_solicitada = $_POST['hora'];
$id_medico = $_POST['id_medico'];

// Realiza la conexión a la base de datos (asegúrate de tener la conexión adecuada aquí)
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'baseclinica');

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Escapa las variables para prevenir inyecciones SQL
$fecha_solicitada = $conexion->real_escape_string($fecha_solicitada);
$hora_solicitada = $conexion->real_escape_string($hora_solicitada);
$id_medico = $conexion->real_escape_string($id_medico);

// Verificar la disponibilidad del turno
$sql_disponibilidad = "SELECT * FROM horarios_medicos 
                      WHERE med_id = $id_medico 
                        AND dia_semana = DAYOFWEEK('$fecha_solicitada') 
                        AND '$hora_solicitada' BETWEEN hora_inicio AND hora_fin";

$resultado_disponibilidad = $conexion->query($sql_disponibilidad);

if ($resultado_disponibilidad->num_rows > 0) {
    // El médico está disponible en el horario solicitado, puedes insertar el turno
    $sql_insertar_turno = "INSERT INTO turnos (apellido, nombre, mail, telefono, fecha, horario, med_id) 
                           VALUES ('Apellido', 'Nombre', 'correo@ejemplo.com', '123456789', '$fecha_solicitada', '$hora_solicitada', $id_medico)";

    if ($conexion->query($sql_insertar_turno) === TRUE) {
        echo "Turno asignado con éxito.";
    } else {
        echo "Error al asignar el turno: " . $conexion->error;
    }
} else {
    // El médico no está disponible en el horario solicitado
    echo "El médico no está disponible en el horario solicitado.";
}

// Cierra la conexión
$conexion->close();
?>
logica para asignacion de turnos.
