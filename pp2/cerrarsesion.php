<?php
// Iniciar la sesión (asegúrate de que esto esté en todas las páginas donde necesites utilizar sesiones)
session_start();

// Destruir la sesión actual
session_destroy();

// Redirigir al usuario a la página de inicio (index.php en este caso)
header("Location: index.php");
exit();
?>
