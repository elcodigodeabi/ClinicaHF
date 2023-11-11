<?php
// procesarmedico.php

// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $are_id = $_POST["are_id"];
    $hora_inicio = $_POST["hora_inicio"];
    $hora_fin = $_POST["hora_fin"];
    // Puedes agregar más campos según la estructura de tu tabla medicos

    // Conéctate a la base de datos
    $conexion = conectarBD();

    // Prepara la consulta SQL para insertar un nuevo médico
    $sql = "INSERT INTO medicos (descripcion, dni, are_id) 
            VALUES ('$nombre', '$dni', $are_id)";

    // Ejecuta la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo médico creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Obtener el ID del médico recién insertado
    $medico_id = $conexion->insert_id;

    // Prepara la consulta SQL para insertar el horario del médico
    $sqlHorario = "INSERT INTO horarios_medicos (med_id, dia_semana, hora_inicio, hora_fin) 
                   VALUES ($medico_id, 1, '$hora_inicio', '$hora_fin')";

    // Ejecuta la consulta para el horario del médico
    if ($conexion->query($sqlHorario) === TRUE) {
        echo "Horario del médico creado con éxito";
    } else {
        echo "Error: " . $sqlHorario . "<br>" . $conexion->error;
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>
