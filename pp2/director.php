<?php
session_start(); // Inicia la sesión
include 'conexion.php'; // Incluye el archivo de conexión

// Conéctate a la base de datos
$conexion = conectarBD();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Director</title>
</head>
<body>

    <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?> (Director)</h1>
    <!-- Formulario de búsqueda -->
    <form method="post" action="">
        <input type="text" name="buscar" placeholder="Buscar...">
        <input type="submit" value="Buscar">
    </form>
    <br><br>

    <form method="post" action="cargarmedicos.php">
        <input type="submit" value="Cargar Médicos">
    </form>
    <br><br>
    
    <!-- Tablero de turnos -->
    <h2>Tablero de Turnos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Mail</th>
            <th>Teléfono</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Area</th>
            <th>Medico</th>
        </tr>
        <?php
        // Realiza una consulta para obtener los datos de los turnos y sus descripciones de área y médico
        $sql = "SELECT t.id, t.apellido, t.nombre, t.dni, t.mail, t.telefono, t.fecha, t.horario, a.descripcion AS area, m.descripcion AS medico FROM turnos t
                JOIN areas a ON t.are_id = a.are_id
                JOIN medicos m ON t.med_id = m.med_id";
        $result = $conexion->query($sql);

        // Muestra los resultados en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['apellido'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['dni'] . "</td>";
            echo "<td>" . $row['mail'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['fecha'] . "</td>";
            echo "<td>" . $row['horario'] . "</td>";
            echo "<td>" . $row['area'] . "</td>";
            echo "<td>" . $row['medico'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>

    <h2>Lista de Médicos</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>DNI</th>
            <!-- Agregué las columnas faltantes -->
            <th>Área</th>
            <th>Horario Inicio</th>
            <th>Horario Fin</th>
        </tr>
        <?php
        // Realiza una consulta para obtener los datos de los médicos y sus horarios y áreas
        $sql = "SELECT m.*, a.descripcion AS area, h.hora_inicio, h.hora_fin FROM medicos m
                JOIN areas a ON m.are_id = a.are_id
                LEFT JOIN horarios_medicos h ON m.med_id = h.med_id
                GROUP BY m.med_id";
        $result = $conexion->query($sql);

        // Muestra los resultados en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "<td>" . $row['dni'] . "</td>";
            echo "<td>" . $row['area'] . "</td>";
            echo "<td>" . $row['hora_inicio'] . "</td>";
            echo "<td>" . $row['hora_fin'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
