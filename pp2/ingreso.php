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
    <option value="3">General</option>
    <option value="4">Pediatría</option>
      </select><br><br>

<label for="med_id">Médico:</label>
<select id="med_id" name="med_id" required>
    <option value="1">Huffmann</option>
    <option value="2">Perez Pardo</option>
    <option value="3">Vargas</option>
    <option value="4">Abi</option>
</select><br><br>
        
        <input type="submit" value="Guardar Turno">
    </form>
</body>
</html>
