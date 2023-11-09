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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Médico y Horarios</title>
</head>
<body>
    <h2>Añadir Médico y Horarios</h2>

    <form action="procesar_formulario.php" method="post">
        <label for="nombre_medico">Nombre del Médico:</label>
        <input type="text" name="nombre_medico" required>

        <label for="especialidad">Especialidad:</label>
        <select name="especialidad" required>
            <!-- Opciones de especialidad obtenidas de la base de datos -->
            <?php
                // Realizar la conexión a la base de datos (asegúrate de tener la conexión adecuada aquí)
                $conexion = new mysqli('localhost', 'usuario', 'contraseña', 'baseclinica');

                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión a la base de datos: " . $conexion->connect_error);
                }

                // Obtener las especialidades de la base de datos
                $sql_especialidades = "SELECT * FROM areas";
                $result_especialidades = $conexion->query($sql_especialidades);

                // Mostrar las opciones en el formulario
                while ($row = $result_especialidades->fetch_assoc()) {
                    echo "<option value='" . $row['are_id'] . "'>" . $row['descripcion'] . "</option>";
                }

                // Cerrar la conexión
                $conexion->close();
            ?>
        </select>

        <label for="dia_semana">Día de la Semana:</label>
        <select name="dia_semana" required>
            <option value="1">Lunes</option>
            <option value="2">Martes</option>
            <option value="3">Miércoles</option>
            <option value="4">Jueves</option>
            <option value="5">Viernes</option>
            <!-- Puedes agregar más opciones según tus necesidades -->
        </select>

        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" required>

        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" name="hora_fin" required>

        <input type="submit" value="Agregar Médico y Horarios">
    </form>
</body>
</html>
formulario para dar de alta medicos

<?php
// Verificar si se han enviado datos por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Supongamos que los datos del formulario se reciben mediante $_POST
    $nombre_medico = $_POST['nombre_medico'];
    $especialidad = $_POST['especialidad'];
    $dia_semana = $_POST['dia_semana'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];

    // Realizar la conexión a la base de datos (asegúrate de tener la conexión adecuada aquí)
    $conexion = new mysqli('localhost', 'usuario', 'contraseña', 'baseclinica');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Escapa las variables para prevenir inyecciones SQL
    $nombre_medico = $conexion->real_escape_string($nombre_medico);
    $especialidad = $conexion->real_escape_string($especialidad);
    $dia_semana = $conexion->real_escape_string($dia_semana);
    $hora_inicio = $conexion->real_escape_string($hora_inicio);
    $hora_fin = $conexion->real_escape_string($hora_fin);

    // Insertar el médico en la tabla de médicos
    $sql_insertar_medico = "INSERT INTO medicos (descripcion) VALUES ('$nombre_medico')";
    $conexion->query($sql_insertar_medico);

    // Obtener el ID del médico recién insertado
    $id_medico = $conexion->insert_id;

    // Insertar el horario del médico en la tabla de horarios_medicos
    $sql_insertar_horario = "INSERT INTO horarios_medicos (med_id, are_id, dia_semana, hora_inicio, hora_fin)
                             VALUES ('$id_medico', '$especialidad', '$dia_semana', '$hora_inicio', '$hora_fin')";
    
    if ($conexion->query($sql_insertar_horario) === TRUE) {
        echo "Médico y horarios agregados con éxito.";
    } else {
        echo "Error al agregar el médico y horarios: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
CREATE TABLE dias (
    dia_id INT PRIMARY KEY,
    descripcion VARCHAR(20)
);

INSERT INTO dias (dia_id, descripcion) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sábado'),
(7, 'Domingo');

-- Modificar la tabla "horarios_medicos"
ALTER TABLE horarios_medicos
DROP COLUMN dia_semana;

ALTER TABLE horarios_medicos
ADD COLUMN dia_id INT,
ADD FOREIGN KEY (dia_id) REFERENCES dias(dia_id);
