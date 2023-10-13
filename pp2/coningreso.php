<!DOCTYPE html>
<html>
<head>
    <title>Resultado del Guardado</title>
</head>
<body>
    <h1>Resultado del Guardado</h1>
    
    <p><?php echo isset($_GET['mensaje']) ? $_GET['mensaje'] : ""; ?></p>
    
    <form method="post" action="secretaria.php">
        <input type="submit" value="Volver">
    </form>
</body>
</html>
