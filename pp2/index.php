<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="verificar.php" method="post">
        <label for="usuario">Usuario :</label>
        <input type="text" id="usuario" name="usuario" required pattern="[0-9]{8}" title="Ingresa 8 números"><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required pattern=".{8,}" title="Mínimo 8 caracteres"><br><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>

