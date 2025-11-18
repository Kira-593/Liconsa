<?php
session_start();
require_once 'configuracion.php';

// Verificar que sea administrador
if (!isset($_SESSION['departamento']) || $_SESSION['departamento'] !== 'ADMIN') {
    header('Location: ../inicio.php');
    exit();
}

require_once 'historial.php';

// Conexión a la base de datos (necesaria para algunas consultas directas en esta página)
$conexion = new mysqli('localhost', 'root', '', 'usuario');
if ($conexion->connect_error) {
    // Si la conexión falla, registrar y mostrar un mensaje amigable
    error_log('Error de conexión en admin_historial.php: ' . $conexion->connect_error);
    echo "<div class=\"alert alert-danger\">Error de conexión a la base de datos. Intente más tarde.</div>";
    exit();
}
// Procesar filtros
$limite = isset($_GET['limite']) ? intval($_GET['limite']) : 100;
$usuario = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

// Obtener historial
$historial = obtenerHistorial($limite, $usuario, $fecha_inicio, $fecha_fin);
$estadisticas = obtenerEstadisticasHistorial(30);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Usuarios - Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-stat {
            border-left: 4px solid #0d6efd;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,.075);
        }
        .badge-login {
            background-color: #198754;
        }
        .badge-error {
            background-color: #dc3545;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1><i class="fas fa-history me-2"></i>Historial de Usuarios</h1>
                    <a href="../menuphp/php/menuP.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Volver al Menú
                    </a>
                </div>

                <!-- Estadísticas -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card card-stat">
                            <div class="card-body">
                                <h5 class="card-title">Total Actividades (30 días)</h5>
                                <h2 class="text-primary"><?php echo $estadisticas['total_actividades']; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stat">
                            <div class="card-body">
                                <h5 class="card-title">Usuarios Activos</h5>
                                <h2 class="text-success"><?php echo count($estadisticas['usuarios_activos']); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stat">
                            <div class="card-body">
                                <h5 class="card-title">Módulos</h5>
                                <h2 class="text-info"><?php echo count($estadisticas['modulos_populares']); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stat">
                            <div class="card-body">
                                <h5 class="card-title">Registros Mostrados</h5>
                                <h2 class="text-warning"><?php echo count($historial); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" placeholder="Buscar usuario...">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Límite</label>
                                <select class="form-select" name="limite">
                                    <option value="50" <?php echo $limite == 50 ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?php echo $limite == 100 ? 'selected' : ''; ?>>100</option>
                                    <option value="200" <?php echo $limite == 200 ? 'selected' : ''; ?>>200</option>
                                    <option value="500" <?php echo $limite == 500 ? 'selected' : ''; ?>>500</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search me-1"></i>Filtrar
                                </button>
                                <a href="admin_history.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh me-1"></i>Limpiar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Actividad por Módulo (Últimos 7 días)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $modulos_stats = [];
                    $sql_modulos = "SELECT modulo, COUNT(*) as total 
                                   FROM historial_usuario 
                                   WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                                   GROUP BY modulo 
                                   ORDER BY total DESC";
                    $result_modulos = $conexion->query($sql_modulos);
                    if ($result_modulos) {
                        while ($row = $result_modulos->fetch_assoc()) {
                            $modulos_stats[] = $row;
                        }
                    } else {
                        error_log('Error en consulta de módulos: ' . $conexion->error);
                    }
                    
                    foreach ($modulos_stats as $modulo): 
                        $porcentaje = ($modulo['total'] / max(1, $estadisticas['total_actividades'])) * 100;
                    ?>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <span><?php echo $modulo['modulo']; ?></span>
                            <strong><?php echo $modulo['total']; ?></strong>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?php echo $porcentaje; ?>%">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- Tabla de Historial -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Registros de Actividad</h5>
                        <span class="badge bg-primary"><?php echo count($historial); ?> registros</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Fecha/Hora</th>
                                        <th>Usuario</th>
                                        <th>Departamento</th>
                                        <th>Módulo</th>
                                        <th>Acción</th>
                                        <th>Detalles</th>
                                        <th>IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($historial)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                <p class="text-muted">No se encontraron registros</p>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($historial as $registro): ?>
                                            <tr>
                                                <td><?php echo date('d/m/Y H:i:s', strtotime($registro['created_at'])); ?></td>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($registro['usuario_correo']); ?></strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo htmlspecialchars($registro['usuario_departamento']); ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($registro['modulo']); ?></span>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $badge_class = 'bg-primary';
                                                    if (strpos($registro['accion'], 'fallido') !== false) {
                                                        $badge_class = 'bg-danger';
                                                    } elseif (strpos($registro['accion'], 'exitoso') !== false) {
                                                        $badge_class = 'bg-success';
                                                    } elseif (strpos($registro['accion'], 'error') !== false) {
                                                        $badge_class = 'bg-warning text-dark';
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $badge_class; ?>">
                                                        <?php echo htmlspecialchars($registro['accion']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted"><?php echo htmlspecialchars($registro['detalles'] ?? 'N/A'); ?></small>
                                                </td>
                                                <td>
                                                    <code><?php echo htmlspecialchars($registro['ip_address']); ?></code>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>