<!DOCTYPE html>
<html>
<head>
    <title>Panel de Secretaria</title>
</head>
<body>
<?php
session_start(); // Inicia la sesión
?>
    <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?> (Secretaria)</h1>
    <!-- Formulario de búsqueda -->
    <form method="post" action="">
        <input type="text" name="buscar" placeholder="Buscar...">
        <input type="submit" value="Buscar">
    </form>
    <br><br>

    <!-- Botón para cargar turnos -->
    <form method="post" action="ingreso.php">
        <input type="submit" value="Cargar Turnos">
    </form>
    <br><br>
    
    <!-- Tablero de turnos -->
    <h2>Tablero de Turnos</h2>
    <table>
    <tr>
        <th>ID</th> <!-- Agregar columna para ID -->
        <th>Apellido</th>
        <th>Nombre</th>
        <th>DNI</th> <!-- Agregar la columna para DNI -->
        <th>Mail</th>
        <th>Teléfono</th>
        <th>Fecha</th>
        <th>Horario</th>
        <th>Area</th>
        <th>Medico</th>
        <th>Acciones</th> <!-- Nueva columna para acciones -->
    </tr>
        <?php
        include 'conexion.php'; // Incluye el archivo de conexión

        // Conéctate a la base de datos
        $conexion = conectarBD();

        // Realiza una consulta para obtener los datos de los turnos y sus descripciones de área y médico
        $sql = "SELECT t.id, t.apellido, t.nombre, t.dni, t.mail, t.telefono, t.fecha, t.horario, a.descripcion AS area, m.descripcion AS medico FROM turnos t
                JOIN areas a ON t.are_id = a.are_id
                JOIN medicos m ON t.med_id = m.med_id";
        $result = $conexion->query($sql);

        // Muestra los resultados en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>"; // Agregar esta línea para mostrar el ID
            echo "<td>" . $row['apellido'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['dni'] . "</td>"; // Agregar el campo DNI
            echo "<td>" . $row['mail'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['fecha'] . "</td>";
            echo "<td>" . $row['horario'] . "</td>";
            echo "<td>" . $row['area'] . "</td>";
            echo "<td>" . $row['medico'] . "</td>";
            echo "<td>
                 <form method='post' action='modificar.php'>
                     <input type='hidden' name='id_turno' value='" . $row['id'] . "'>
                     <button type='submit'>Modificar</button>
                 </form>
             </td>";
            echo "</tr>";
        }

        $conexion->close();
        ?>
    </table>
    <br><br>

    <!-- ... Tu código posterior ... -->
</body>
</html>
