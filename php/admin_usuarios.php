<?php
session_start();

// Verificar que sea administrador
if (!isset($_SESSION['departamento']) || $_SESSION['departamento'] !== 'ADMIN') {
    header('Location: ../inicio.php');
    exit();
}

// Incluir funciones del historial
require_once 'historial.php';

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'usuario');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Variables para mensajes
$mensaje = '';
$tipo_mensaje = '';

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $user_id = $_POST['user_id'] ?? '';
    
    switch ($action) {
        case 'editar':
            // Actualizar usuario
            $Nombre = trim($_POST['Nombre']);
            $Ap_P = trim($_POST['Ap_P']);
            $Ap_M = trim($_POST['Ap_M']);
            $correo = trim($_POST['correo']);
            $departamento = $_POST['departamento'];
            $claveF = trim($_POST['claveF']);
            $activo = isset($_POST['activo']) ? 1 : 0;
            
            $sql = "UPDATE users SET Nombre = ?, Ap_P = ?, Ap_M = ?, correo = ?, departamento = ?, claveF = ?, activo = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssssssii", $Nombre, $Ap_P, $Ap_M, $correo, $departamento, $claveF, $activo, $user_id);
            
            if ($stmt->execute()) {
                $mensaje = "Usuario actualizado correctamente";
                $tipo_mensaje = "success";
                
                // Registrar en historial
                registrarHistorial(
                    "Actualizó usuario", 
                    "Gestión de Usuarios", 
                    "Actualizó datos del usuario: $correo (ID: $user_id)"
                );
            } else {
                $mensaje = "Error al actualizar usuario: " . $stmt->error;
                $tipo_mensaje = "danger";
            }
            $stmt->close();
            break;
            
        case 'eliminar':
            // Eliminar usuario (marcar como inactivo)
            $sql = "UPDATE users SET activo = 0 WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $user_id);
            
            if ($stmt->execute()) {
                $mensaje = "Usuario desactivado correctamente";
                $tipo_mensaje = "success";
                
                // Registrar en historial
                registrarHistorial(
                    "Desactivó usuario", 
                    "Gestión de Usuarios", 
                    "Desactivó usuario ID: $user_id"
                );
            } else {
                $mensaje = "Error al desactivar usuario: " . $stmt->error;
                $tipo_mensaje = "danger";
            }
            $stmt->close();
            break;
            
        case 'activar':
            // Reactivar usuario
            $sql = "UPDATE users SET activo = 1 WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $user_id);
            
            if ($stmt->execute()) {
                $mensaje = "Usuario activado correctamente";
                $tipo_mensaje = "success";
                
                // Registrar en historial
                registrarHistorial(
                    "Activó usuario", 
                    "Gestión de Usuarios", 
                    "Activó usuario ID: $user_id"
                );
            } else {
                $mensaje = "Error al activar usuario: " . $stmt->error;
                $tipo_mensaje = "danger";
            }
            $stmt->close();
            break;
            
        case 'cambiar_password':
            $nueva_password = trim($_POST['nueva_password']);
            
            if (empty($nueva_password)) {
                $mensaje = "La contraseña no puede estar vacía";
                $tipo_mensaje = "danger";
            } else {
                // Encriptar la nueva contraseña
                $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET contraseña = ? WHERE id = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("si", $password_hash, $user_id);
                
                if ($stmt->execute()) {
                    $mensaje = "Contraseña actualizada correctamente";
                    $tipo_mensaje = "success";
                    
                    // Registrar en historial
                    registrarHistorial(
                        "Cambió contraseña", 
                        "Gestión de Usuarios", 
                        "Cambió contraseña del usuario ID: $user_id"
                    );
                } else {
                    $mensaje = "Error al cambiar contraseña: " . $stmt->error;
                    $tipo_mensaje = "danger";
                }
                $stmt->close();
            }
            break;
    }
}

// Primero, verificar si la columna 'activo' existe, si no, agregarla
$check_column = $conexion->query("SHOW COLUMNS FROM users LIKE 'activo'");
if ($check_column->num_rows == 0) {
    // Agregar columna activo si no existe
    $conexion->query("ALTER TABLE users ADD COLUMN activo TINYINT(1) DEFAULT 1");
}

// Obtener lista de usuarios
$filtro = $_GET['filtro'] ?? 'todos';
$busqueda = $_GET['busqueda'] ?? '';

$where_conditions = [];
$params = [];
$types = "";

if ($filtro === 'activos') {
    $where_conditions[] = "activo = 1";
} elseif ($filtro === 'inactivos') {
    $where_conditions[] = "activo = 0";
}

if (!empty($busqueda)) {
    $where_conditions[] = "(Nombre LIKE ? OR Ap_P LIKE ? OR Ap_M LIKE ? OR correo LIKE ? OR departamento LIKE ?)";
    $param_busqueda = "%$busqueda%";
    $params = array_fill(0, 5, $param_busqueda);
    $types = str_repeat("s", 5);
}

$where_sql = "";
if (!empty($where_conditions)) {
    $where_sql = "WHERE " . implode(" AND ", $where_conditions);
}

$sql = "SELECT * FROM users $where_sql ORDER BY id DESC";
$stmt = $conexion->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$resultado = $stmt->get_result();
$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Obtener estadísticas
$sql_stats = "SELECT 
    COUNT(*) as total,
    SUM(activo = 1) as activos,
    SUM(activo = 0) as inactivos,
    COUNT(DISTINCT departamento) as departamentos
    FROM users";
$stats_result = $conexion->query($sql_stats);
$estadisticas = $stats_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_usuarios.css">
    
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><i class="fas fa-users-cog me-2"></i>Gestión de Usuarios</h1>
                    <div>
                        <a href="../menuphp/php/menuP.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Volver al Menú
                        </a>
                        <a href="admin_historial.php" class="btn btn-info ms-2">
                            <i class="fas fa-history me-1"></i>Historial
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensajes -->
        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $tipo_mensaje; ?> alert-dismissible fade show" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card card-stat">
                    <div class="card-body">
                        <h5 class="card-title">Total Usuarios</h5>
                        <h2 class="text-primary"><?php echo $estadisticas['total']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios Activos</h5>
                        <h2 class="text-success"><?php echo $estadisticas['activos']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios Inactivos</h5>
                        <h2 class="text-danger"><?php echo $estadisticas['inactivos']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat">
                    <div class="card-body">
                        <h5 class="card-title">Departamentos</h5>
                        <h2 class="text-warning"><?php echo $estadisticas['departamentos']; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros y Búsqueda</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Filtrar por estado</label>
                        <select class="form-select" name="filtro">
                            <option value="todos" <?php echo $filtro === 'todos' ? 'selected' : ''; ?>>Todos los usuarios</option>
                            <option value="activos" <?php echo $filtro === 'activos' ? 'selected' : ''; ?>>Solo activos</option>
                            <option value="inactivos" <?php echo $filtro === 'inactivos' ? 'selected' : ''; ?>>Solo inactivos</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Buscar usuario</label>
                        <input type="text" class="form-control" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>" placeholder="Buscar por nombre, apellidos, correo o departamento...">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Buscar
                        </button>
                        <a href="admin_usuarios.php" class="btn btn-outline-secondary">
                            <i class="fas fa-refresh me-1"></i>Limpiar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Lista de Usuarios</h5>
                <span class="badge bg-primary"><?php echo count($usuarios); ?> usuarios</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Usuario</th>
                                <th>Información</th>
                                <th>Departamento</th>
                                <th>Estado</th>
                                <th>Modificar usuario</th>
                                <th>Cambiar contraseña</th>
                                <th>Activar/Desactivar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($usuarios)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No se encontraron usuarios</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3">
                                                    <?php echo strtoupper(substr($usuario['Nombre'], 0, 1) . substr($usuario['Ap_P'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <strong><?php echo htmlspecialchars($usuario['Nombre'] . ' ' . $usuario['Ap_P'] . ' ' . $usuario['Ap_M']); ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo htmlspecialchars($usuario['correo']); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <small>
                                                <strong>Clave Firma:</strong> <?php echo htmlspecialchars($usuario['claveF']); ?><br>
                                                <strong>ID:</strong> <?php echo $usuario['id']; ?>
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?php echo htmlspecialchars($usuario['departamento']); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $usuario['activo'] ? 'badge-activo' : 'badge-inactivo'; ?>">
                                                <?php echo $usuario['activo'] ? 'Activo' : 'Inactivo'; ?>
                                            </span>
                                        </td>
                                        <td align="center">
                                            <!-- Botón Editar -->
                                            <button type="button" class="btn btn-warning btn-sm btn-action" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalEditarUsuario"
                                                    data-usuario='<?php echo htmlspecialchars(json_encode($usuario), ENT_QUOTES); ?>'>
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td align="center">
                                            <!-- Botón Cambiar Contraseña -->
                                            <button type="button" class="btn btn-info btn-sm btn-action" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalCambiarPassword"
                                                    data-user-id="<?php echo $usuario['id']; ?>"
                                                    data-user-correo="<?php echo htmlspecialchars($usuario['correo']); ?>">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                        <td align="center">
                                            <!-- Botón Activar/Desactivar -->
                                            <?php if ($usuario['activo']): ?>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="action" value="eliminar">
                                                    <input type="hidden" name="user_id" value="<?php echo $usuario['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm btn-action"
                                                            onclick="return confirm('¿Desactivar este usuario?')">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="action" value="activar">
                                                    <input type="hidden" name="user_id" value="<?php echo $usuario['id']; ?>">
                                                    <button type="submit" class="btn btn-success btn-sm btn-action"
                                                            onclick="return confirm('¿Activar este usuario?')">
                                                        <i class="fas fa-user-check"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
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

    <!-- Modal para Editar Usuario -->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="formEditarUsuario">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" name="user_id" id="edit_user_id">
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="Nombre" id="edit_Nombre" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" name="Ap_P" id="edit_Ap_P" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" name="Ap_M" id="edit_Ap_M" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" id="edit_correo" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Departamento</label>
                                <select class="form-select" name="departamento" id="edit_departamento" required>
                                    <option value="">Seleccionar departamento</option>
                                    <option value="ADMIN">Administración</option>
                                    <option value="ENVASADO">Envasado</option>
                                    <option value="CALIDAD">Control de Calidad</option>
                                    <option value="PADRON">Padrón de Beneficiarios</option>
                                    <option value="DISTRIBUCION">Distribución</option>
                                    <option value="ADQUISICIONES">Adquisiciones</option>
                                    <option value="ALMACEN">Almacén</option>
                                    <option value="MANTENIMIENTO">Mantenimiento</option>
                                    <option value="INFORMATICA">Informática</option>
                                    <option value="ELABORACION">Elaboración</option>
                                    <option value="GESTION DE TRABAJO">Gestión del Trabajo</option>
                                    <option value="RECURSOS FINANCIEROS">Recursos Financieros</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Clave de Firma</label>
                                <input type="text" class="form-control" name="claveF" id="edit_claveF" required>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input" name="activo" id="edit_activo" value="1">
                                    <label class="form-check-label" for="edit_activo">Usuario Activo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cargar datos en el modal de edición
        document.getElementById('modalEditarUsuario').addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var usuario = JSON.parse(button.getAttribute('data-usuario'));
            
            document.getElementById('edit_user_id').value = usuario.id;
            document.getElementById('edit_Nombre').value = usuario.Nombre;
            document.getElementById('edit_Ap_P').value = usuario.Ap_P;
            document.getElementById('edit_Ap_M').value = usuario.Ap_M;
            document.getElementById('edit_correo').value = usuario.correo;
            document.getElementById('edit_departamento').value = usuario.departamento;
            document.getElementById('edit_claveF').value = usuario.claveF;
            document.getElementById('edit_activo').checked = usuario.activo == 1;
        });
    </script>

    <!-- Modal para Cambiar Contraseña -->
<div class="modal fade" id="modalCambiarPassword" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="formCambiarPassword">
                <input type="hidden" name="action" value="cambiar_password">
                <input type="hidden" name="user_id" id="cambiar_password_user_id">
                
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="cambiar_password_correo" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" name="nueva_password" id="nueva_password" required 
                               placeholder="Ingrese la nueva contraseña" minlength="6">
                        <div class="form-text">La contraseña debe tener al menos 6 caracteres.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmar_password" 
                               placeholder="Confirme la nueva contraseña" onkeyup="validarPasswords()">
                        <div class="form-text" id="password-match-message"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn-guardar-password" disabled>
                        <i class="fas fa-save me-1"></i>Guardar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Cargar datos en el modal de cambiar contraseña
    document.getElementById('modalCambiarPassword').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-user-id');
        var userCorreo = button.getAttribute('data-user-correo');
        
        document.getElementById('cambiar_password_user_id').value = userId;
        document.getElementById('cambiar_password_correo').value = userCorreo;
        
        // Limpiar campos
        document.getElementById('nueva_password').value = '';
        document.getElementById('confirmar_password').value = '';
        document.getElementById('btn-guardar-password').disabled = true;
        document.getElementById('password-match-message').textContent = '';
        document.getElementById('password-match-message').className = 'form-text';
    });

    // Validar que las contraseñas coincidan
    function validarPasswords() {
        var password = document.getElementById('nueva_password').value;
        var confirmar = document.getElementById('confirmar_password').value;
        var mensaje = document.getElementById('password-match-message');
        var boton = document.getElementById('btn-guardar-password');
        
        if (password === '' || confirmar === '') {
            mensaje.textContent = '';
            mensaje.className = 'form-text';
            boton.disabled = true;
            return;
        }
        
        if (password === confirmar) {
            if (password.length >= 6) {
                mensaje.textContent = '✓ Las contraseñas coinciden';
                mensaje.className = 'form-text text-success';
                boton.disabled = false;
            } else {
                mensaje.textContent = '✗ La contraseña debe tener al menos 6 caracteres';
                mensaje.className = 'form-text text-danger';
                boton.disabled = true;
            }
        } else {
            mensaje.textContent = '✗ Las contraseñas no coinciden';
            mensaje.className = 'form-text text-danger';
            boton.disabled = true;
        }
    }

    // También validar cuando se escribe en el campo de nueva contraseña
    document.getElementById('nueva_password').addEventListener('input', validarPasswords);
</script>
</body>
</html>

<?php
$conexion->close();
?>