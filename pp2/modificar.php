<!DOCTYPE html>
<html>
<head>
    <title>Modificar Turno</title>
</head>
<body>
<?php
include 'conexion.php'; // Incluye el archivo de conexión

// Verifica si se ha proporcionado un id_turno válido
if (isset($_GET['id_turno'])) {
    $id_turno = $_GET['id_turno'];

    // Conéctate a la base de datos
    $conexion = conectarBD();

    // Realiza una consulta para obtener los datos del turno a modificar
    $consulta = $conexion->prepare("SELECT * FROM turnos WHERE id_turno = ?");
    $consulta->bind_param("i", $id_turno);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $turno = $resultado->fetch_assoc();
?>
        <h1>Modificar Turno</h1>
        <!-- Formulario de modificación -->
        <form method="post" action="actualizarturno.php">
            <input type="hidden" name="id_turno" value="<?php echo $turno['id_turno']; ?>">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $turno['apellido']; ?>" required><br><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $turno['nombre']; ?>" required><br><br>

            <label for="dni">DNI:</label>
            <input type="number" id="dni" name="dni" value="<?php echo $turno['dni']; ?>" required minlength="8" maxlength="8"><br><br>

            <label for="mail">Mail:</label>
            <input type="email" id="mail" name="mail" value="<?php echo $turno['mail']; ?>" required><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo $turno['telefono']; ?>" required><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $turno['fecha']; ?>" required><br><br>

            <label for="horario">Horario:</label>
            <input type="time" id="horario" name="horario" value="<?php echo $turno['horario']; ?>" required><br><br>

            <label for="are_id">Área:</label>
            <select id="are_id" name="are_id" required>
                <!-- Opciones de área -->
            </select><br><br>

            <label for="med_id">Médico:</label>
            <select id="med_id" name="med_id" required>
                <!-- Opciones de médico -->
            </select><br><br>

            <input type="submit" value="Actualizar Turno">
        </form>
<?php
    } else {
        echo "No se encontró un turno con el ID proporcionado.";
    }

    $consulta->close();
    $conexion->close();
} else {
    echo "No se proporcionó un ID de turno válido.";
}
?>
</body>
</html>
