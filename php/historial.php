<?php
// Verificar estado de sesión antes de iniciar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function registrarHistorial($accion, $modulo, $detalles = null) {
    // Solo registrar si hay una sesión activa
    if (!isset($_SESSION['correo']) || !isset($_SESSION['departamento'])) {
        return false;
    }
    
    $conexion = new mysqli('localhost', 'root', '', 'usuario');
    
    if ($conexion->connect_error) {
        error_log("Error de conexión al registrar historial: " . $conexion->connect_error);
        return false;
    }
    
    // Obtener información del cliente
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    $sql = "INSERT INTO user_history (usuario_correo, usuario_departamento, accion, modulo, detalles, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        error_log("Error preparando consulta de historial: " . $conexion->error);
        $conexion->close();
        return false;
    }
    
    $stmt->bind_param("sssssss", 
        $_SESSION['correo'],
        $_SESSION['departamento'],
        $accion,
        $modulo,
        $detalles,
        $ip_address,
        $user_agent
    );
    
    $result = $stmt->execute();
    
    if (!$result) {
        error_log("Error ejecutando consulta de historial: " . $stmt->error);
    }
    
    $stmt->close();
    $conexion->close();
    
    return $result;
}

// Función para obtener el historial (para el admin)
function obtenerHistorial($limite = 100, $usuario = null, $fecha_inicio = null, $fecha_fin = null) {
    $conexion = new mysqli('localhost', 'root', '', 'usuario');
    
    if ($conexion->connect_error) {
        return [];
    }
    
    $where_conditions = [];
    $params = [];
    $types = "";
    
    if ($usuario) {
        $where_conditions[] = "usuario_correo LIKE ?";
        $params[] = "%$usuario%";
        $types .= "s";
    }
    
    if ($fecha_inicio) {
        $where_conditions[] = "DATE(created_at) >= ?";
        $params[] = $fecha_inicio;
        $types .= "s";
    }
    
    if ($fecha_fin) {
        $where_conditions[] = "DATE(created_at) <= ?";
        $params[] = $fecha_fin;
        $types .= "s";
    }
    
    $where_sql = "";
    if (!empty($where_conditions)) {
        $where_sql = "WHERE " . implode(" AND ", $where_conditions);
    }
    
    $sql = "SELECT * FROM user_history 
            $where_sql 
            ORDER BY created_at DESC 
            LIMIT ?";
    
    $params[] = $limite;
    $types .= "i";
    
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        $conexion->close();
        return [];
    }
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $historial = [];
    while ($row = $result->fetch_assoc()) {
        $historial[] = $row;
    }
    
    $stmt->close();
    $conexion->close();
    
    return $historial;
}

// Función para obtener estadísticas
function obtenerEstadisticasHistorial($dias = 30) {
    $conexion = new mysqli('localhost', 'root', '', 'usuario');
    
    if ($conexion->connect_error) {
        return [];
    }
    
    $estadisticas = [];
    
    // Total de actividades en los últimos X días
    $sql = "SELECT COUNT(*) as total FROM user_history 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $dias);
    $stmt->execute();
    $stmt->bind_result($estadisticas['total_actividades']);
    $stmt->fetch();
    $stmt->close();
    
    // Actividades por día
    $sql = "SELECT DATE(created_at) as fecha, COUNT(*) as cantidad 
            FROM user_history 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
            GROUP BY DATE(created_at) 
            ORDER BY fecha DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $dias);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $estadisticas['actividades_por_dia'] = [];
    while ($row = $result->fetch_assoc()) {
        $estadisticas['actividades_por_dia'][] = $row;
    }
    $stmt->close();
    
    // Usuarios más activos
    $sql = "SELECT usuario_correo, usuario_departamento, COUNT(*) as actividades 
            FROM user_history
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
            GROUP BY usuario_correo, usuario_departamento 
            ORDER BY actividades DESC 
            LIMIT 10";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $dias);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $estadisticas['usuarios_activos'] = [];
    while ($row = $result->fetch_assoc()) {
        $estadisticas['usuarios_activos'][] = $row;
    }
    $stmt->close();
    
    // Módulos más utilizados
    $sql = "SELECT modulo, COUNT(*) as cantidad 
            FROM user_history
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
            GROUP BY modulo 
            ORDER BY cantidad DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $dias);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $estadisticas['modulos_populares'] = [];
    while ($row = $result->fetch_assoc()) {
        $estadisticas['modulos_populares'][] = $row;
    }
    $stmt->close();
    
    $conexion->close();
    
    return $estadisticas;
}

// Función para registrar acciones comunes predefinidas
function registrarAccionComun($tipo_accion, $objeto = null, $id_objeto = null, $detalles_extra = null) {
    $acciones = [
        'crear' => 'Creó nuevo registro',
        'editar' => 'Editó registro',
        'eliminar' => 'Eliminó registro',
        'consultar' => 'Consultó información',
        'exportar' => 'Exportó datos',
        'importar' => 'Importó datos',
        'login' => 'Inició sesión',
        'logout' => 'Cerró sesión',
        'buscar' => 'Realizó búsqueda',
        'filtrar' => 'Aplicó filtros',
        'descargar' => 'Descargó archivo',
        'subir' => 'Subió archivo'
    ];
    
    $accion = $acciones[$tipo_accion] ?? $tipo_accion;
    $detalles = "";
    
    if ($objeto) {
        $detalles = "Objeto: $objeto";
        if ($id_objeto) {
            $detalles .= " (ID: $id_objeto)";
        }
    }
    
    if ($detalles_extra) {
        $detalles .= $detalles ? ". $detalles_extra" : $detalles_extra;
    }
    
    $modulo = obtenerModuloActual();
    
    return registrarHistorial($accion, $modulo, $detalles);
}

// Función para determinar el módulo actual
function obtenerModuloActual() {
    $pagina_actual = basename($_SERVER['PHP_SELF']);
    return obtenerModuloPorPagina($pagina_actual);
}

// Función para registrar errores
function registrarError($tipo_error, $descripcion, $modulo = null) {
    if (!$modulo) {
        $modulo = obtenerModuloActual();
    }
    
    return registrarHistorial("Error: $tipo_error", $modulo, $descripcion);
}
?>