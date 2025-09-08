<?php
session_start();
session_destroy(); // Destruir todas las sesiones activas
header("Location: ../../inicio.php"); // Redirigir a la página de inicio de sesión
exit();
?>