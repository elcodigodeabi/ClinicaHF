<!DOCTYPE html>
<html>
<head>
    <title>Cargar Médicos</title>
</head>
<body>

    <h2>Cargar Médicos</h2>
    
    <!-- Formulario para cargar médicos -->
    <form method="post" action="procesarmedico.php">
        <label for="nombre">Nombre y apellido completo:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" required>
        <br>

        <label for="are_id">Área:</label>
        <select id="are_id" name="are_id" required>
            <option value="1">Cardiología</option>
            <option value="2">Neurología</option>
            <option value="3">Clínica General</option>
            <option value="4">Urología</option>
            <option value="5">Hematología</option>
            <option value="6">Cirugía</option>
        </select><br><br>

        <label for="hora_inicio">Hora de inicio:</label>
        <input type="time" name="hora_inicio" required>
        <br>

        <label for="hora_fin">Hora de fin:</label>
        <input type="time" name="hora_fin" required>
        <br>

        <!-- Puedes agregar más campos según la estructura de tu tabla medicos -->

        <input type="submit" value="Guardar Médico">
    </form>

</body>
</html>
