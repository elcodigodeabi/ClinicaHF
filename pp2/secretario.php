<?php
session_start();

// Incluir el archivo de clases
include("clases.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_valido'])) {
    header("Location: index.php");
    exit();
}

// Inicializar variables de error y éxito
$mensaje_error = "";
$mensaje_exito = "";

// Crear una instancia de la clase ConexionBD
$conexion = new ConexionBD();

// Verificar la conexión
if (!$conexion->conectar()) {
    die("Error de conexión: " . $conexion->getError());
}

// Crear una instancia de la clase Turno y buscar los turnos
$turno = new Turno($conexion->getConexion());

// Obtener los filtros de búsqueda desde el formulario
$filtroArea = isset($_GET['filtro_area']) ? $_GET['filtro_area'] : "";
$filtroProfesional = isset($_GET['filtro_profesional']) ? $_GET['filtro_profesional'] : "";
$filtroFecha = isset($_GET['filtro_fecha']) ? $_GET['filtro_fecha'] : "";

// Realizar la búsqueda de turnos utilizando los filtros
$resultado_turnos = $turno->buscarTurnos($filtroArea, $filtroProfesional, $filtroFecha);

?>

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
            <!-- Agrega las opciones desde la base de datos o tus clases -->
            <?php foreach ($turno->obtenerAreas() as $area) : ?>
                <option value="<?php echo $area['nombreArea']; ?>"><?php echo $area['nombreArea']; ?></option>
            <?php endforeach; ?>
        </select>
        
        <!-- Filtro por profesional -->
        <label for="filtro_profesional">Filtrar por Profesional:</label>
        <select name="filtro_profesional" id="filtro_profesional">
            <option value="">Todos</option>
            <!-- Agrega las opciones desde la base de datos o tus clases -->
            <?php foreach ($turno->obtenerProfesionales() as $profesional) : ?>
                <option value="<?php echo $profesional['nombreProfesional']; ?>"><?php echo $profesional['nombreProfesional']; ?></option>
            <?php endforeach; ?>
        </select>
        
        <!-- Filtro por fecha -->
        <label for="filtro_fecha">Filtrar por Fecha:</label>
        <input type="date" name="filtro_fecha" id="filtro_fecha" value="<?php echo $filtroFecha; ?>">
        
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
        <?php foreach ($resultado_turnos as $fila) : ?>
            <tr>
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo $fila["apellido"]; ?></td>
                <td><?php echo $fila["nombre"]; ?></td>
                <td><?php echo $fila["mail"]; ?></td>
                <td><?php echo $fila["tel"]; ?></td>
                <td><?php echo $fila["fecha"]; ?></td>
                <td><?php echo $fila["horario"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <!-- Botón para ingresar un nuevo turno -->
    <form action="cargar.php" method="post">
        <input type="submit" value="Ingresar Turno">
    </form>
    
    <form action="cerrar_sesion.php" method="post">
    <input type="submit" value="Cerrar Sesión">
    </form>

    <?php
    // Cerrar la
