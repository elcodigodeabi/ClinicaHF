<!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Turnos</title>
</head>
<body>
    <h1>Ingreso de Turnos</h1>

    <!-- Formulario de ingreso de turno -->
    <form method="post" action="guardarturno.php">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="mail">Mail:</label>
        <input type="email" id="mail" name="mail" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="horario">Horario:</label>
        <input type="time" id="horario" name="horario" required><br><br>

        <label for="are_id">Área:</label>
        <select id="are_id" name="are_id" required>
            <option value="1">Cardiología</option>
            <option value="2">Neurología</option>
            <option value="3">Clínica General</option>
            <option value="4">Urología</option>
            <option value="5">Hematología</option>
            <option value="6">Cirugía</option>
        </select><br><br>

        <label for="med_id">Médico:</label>
        <select id="med_id" name="med_id" required>
            <option value="1">Huffmann Eduardo</option>
            <option value="2">Ventos Sabrina</option>
            <option value="3">Scholz Alejandro</option>
            <option value="4">Del Puerto Maria Fernanda</option>
            <option value="5">Cabrera Maria del Pilar</option>
            <option value="6">Suarez Jose Ignacio</option>
            <option value="7">Domenichini Federico</option>
            <option value="8">Tula Rovaletti Abelardo</option>
            <option value="9">Valdez Alarcon Marilina</option>
            <option value="10">Galeano Jose Antonio</option>
            <option value="11">Locatti Gabriel Alejandro</option>
            <option value="12">Prieto Juan Martin</option>
        </select><br><br>

        <input type="submit" value="Guardar Turno">
    </form>
</body>
</html>
