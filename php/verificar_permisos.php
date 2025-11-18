<?php
// Verificar si la sesión ya está iniciada antes de llamar session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function verificarPermiso($permiso_requerido) {
    // Si no hay sesión activa, redirigir al login
    if (!isset($_SESSION['correo'])) {
        header("Location: ../inicio.php");
        exit();
    }
    
    $departamento_usuario = $_SESSION['departamento'] ?? '';
    $es_admin = ($departamento_usuario === 'ADMIN');
    
    // Si es admin, tiene acceso a todo
    if ($es_admin) {
        return true;
    }
    
    // Si no es admin, solo puede acceder a formularios
    if ($permiso_requerido === 'formularios' || $permiso_requerido === 'modificacion') {
        return true;
    }
    
    // Si no es admin y quiere acceder a otra cosa, mostrar error
    echo "<script>
        alert('No tienes permisos para acceder a esta sección. Solo puedes llenar formularios.');
        window.history.back();
    </script>";
    exit();
}

// Funciones específicas para cada tipo de permiso
function puedeConsultar() {
    return verificarPermiso('consultas');
}

function puedeModificar() {
    return verificarPermiso('modificacion');
}

function puedeEliminar() {
    return verificarPermiso('eliminacion');
}
?>