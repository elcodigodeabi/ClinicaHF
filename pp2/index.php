<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="verificar.php" method="POST">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" minlength="8" maxlength="8" required>
        <br><br>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" minlength="10" maxlength="10" required>
        <br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
