<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Secretaria</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION["usuario"]; ?></h1>
    
    <!-- Botón para cerrar sesión -->
    <form action="cerrar_sesion.php" method="post">
        <input type="submit" value="Cerrar Sesión">
    </form>
    
    <!-- Formulario de búsqueda -->
    <form action="secretaria.php" method="get">
        <!-- Filtro por área -->
        <label for="filtro_area">Filtrar por Área:</label>
        <select name="filtro_area" id="filtro_area">
            <option value="">Todos</option>
            <option value="area1">Cardiologia</option>
            <option value="area2">Neurologia</option>
            <option value="area1">General</option>
            <option value="area2">Pediatria</option>
            <!-- Agrega más opciones según tus áreas -->
        </select>
        
        <!-- Filtro por profesional -->
        <label for="filtro_profesional">Filtrar por Profesional:</label>
        <select name="filtro_profesional" id="filtro_profesional">
            <option value="">Todos</option>
            <option value="profesional1">Dr Huffmann</option>
            <option value="profesional2">Dr Perez Pardo</option>
            <option value="profesional1">Dr Vargas</option>
            <option value="profesional2">Dra Abi Rached</option>

            <!-- Agrega más opciones según tus profesionales -->
        </select>
        
        <!-- Filtro por fecha -->
        <label for="filtro_fecha">Filtrar por Fecha:</label>
        <input type="date" name="filtro_fecha" id="filtro_fecha">
        
        <input type="submit" value="Buscar">
    </form>
    
    <h2>Lista de Turnos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Mail</th>
            <th>Teléfono</th>
            <th>Fecha</th>
            <th>Horario</th>
        </tr>
        <?php
        // Agregar código PHP para manejar la búsqueda aquí
        while ($fila = $resultado_turnos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo $fila["apellido"]; ?></td>
                <td><?php echo $fila["nombre"]; ?></td>
                <td><?php echo $fila["mail"]; ?></td>
                <td><?php echo $fila["tel"]; ?></td>
                <td><?php echo $fila["fecha"]; ?></td>
                <td><?php echo $fila["horario"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    
    <!-- Botón para ingresar un nuevo turno -->
    <form action="cargar.php" method="post">
        <input type="submit" value="Ingresar Turno">
    </form>
</body>
</html>
