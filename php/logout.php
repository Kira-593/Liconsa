<?php
// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'historial.php';

// Registrar cierre de sesión
if (isset($_SESSION['correo'])) {
    registrarAccionComun('logout', 'Sistema', null, "Sesión finalizada");
}

// Destruir sesión completamente
$_SESSION = array();

// Si se desea destruir la cookie de sesión, también se puede hacer:
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redirigir al login
header('Location: ../inicio.php');
exit();
?>