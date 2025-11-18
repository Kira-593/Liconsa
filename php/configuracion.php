<?php
// Configuración global del sistema
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir funciones del historial
require_once 'historial.php';

// Función para registrar actividad automáticamente
function registrarActividad($accion, $modulo, $detalles = null) {
    // Solo registrar si hay una sesión activa
    if (!isset($_SESSION['correo']) || !isset($_SESSION['departamento'])) {
        return false;
    }
    
    // Si no se proporcionan detalles, capturar información automática
    if ($detalles === null) {
        $detalles = "Página: " . basename($_SERVER['PHP_SELF']);
        if (!empty($_SERVER['QUERY_STRING'])) {
            $detalles .= "? Parámetros: " . $_SERVER['QUERY_STRING'];
        }
    }
    
    return registrarHistorial($accion, $modulo, $detalles);
}

// Registrar acceso a página automáticamente
function registrarAccesoPagina() {
    if (!isset($_SESSION['correo'])) {
        return;
    }
    
    $pagina_actual = basename($_SERVER['PHP_SELF']);
    $modulo = obtenerModuloPorPagina($pagina_actual);
    
    registrarActividad("Accedió a página", $modulo);
}

// Función para determinar el módulo basado en la página
function obtenerModuloPorPagina($pagina) {
    $modulos = [
        'menuP.php' => 'Menú Principal',
        'admin_history.php' => 'Administración',
        'reportes.php' => 'Reportes',
        'usuarios.php' => 'Gestión de Usuarios',
        'inventario.php' => 'Inventario',
        'ventas.php' => 'Ventas',
        'clientes.php' => 'Clientes',
        'proveedores.php' => 'Proveedores',
        'configuracion.php' => 'Configuración'
    ];
    
    return $modulos[$pagina] ?? 'Sistema';
}

// Registrar acceso cuando se incluye este archivo
registrarAccesoPagina();
?>