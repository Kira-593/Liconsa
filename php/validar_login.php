<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'historial.php';
require_once 'configuracion.php';
    

// Configuración de bloqueo
$max_attempts = 3;
$lockout_time = 300; // 5 minutos en segundos

// Función para verificar si el usuario está bloqueado
function isUserLocked($correo) {
    global $lockout_time;
    
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }
    
    if (isset($_SESSION['login_attempts'][$correo])) {
        $attempt_data = $_SESSION['login_attempts'][$correo];

        // Verificar si el usuario está bloqueado
        if ($attempt_data['attempts'] >= $GLOBALS['max_attempts'] && 
            (time() - $attempt_data['last_attempt']) < $lockout_time) {
            return true;
        }

        // Limpiar intentos si ya pasó el tiempo de bloqueo
        if ((time() - $attempt_data['last_attempt']) >= $lockout_time) {
            unset($_SESSION['login_attempts'][$correo]);
        }
    }
    
    return false;
}

// Función para registrar intento fallido
function recordFailedAttempt($correo) {
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }
    
    if (!isset($_SESSION['login_attempts'][$correo])) {
        $_SESSION['login_attempts'][$correo] = [
            'attempts' => 1,
            'last_attempt' => time()
        ];
    } else {
        $_SESSION['login_attempts'][$correo]['attempts']++;
        $_SESSION['login_attempts'][$correo]['last_attempt'] = time();
    }
}

// Función para limpiar intentos (cuando el login es exitoso)
function clearAttempts($correo) {
    if (isset($_SESSION['login_attempts'][$correo])) {
        unset($_SESSION['login_attempts'][$correo]);
    }
}

// Función para obtener tiempo restante de bloqueo
function getRemainingLockTime($correo) {
    global $lockout_time;
    
    if (isset($_SESSION['login_attempts'][$correo])) {
        $attempt_data = $_SESSION['login_attempts'][$correo];
        $elapsed = time() - $attempt_data['last_attempt'];
        $remaining = $lockout_time - $elapsed;
        return max(0, $remaining);
    }
    return 0;
}

// Función para obtener intentos actuales
function getCurrentAttempts($correo) {
    if (isset($_SESSION['login_attempts'][$correo])) {
        return $_SESSION['login_attempts'][$correo]['attempts'];
    }
    return 0;
}

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../inicio.php');
    exit();
}

// Obtener datos del formulario
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$departamento = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';

// Validar que todos los campos requeridos estén presentes
if (empty($correo) || empty($password) || empty($departamento)) {
    echo "<script>alert('Por favor completa todos los campos.'); window.history.back();</script>";
    exit();
}

// Verificar si el usuario está bloqueado
if (isUserLocked($correo)) {
    $remaining_time = getRemainingLockTime($correo);
    $minutes = intdiv($remaining_time, 60);
    $seconds = $remaining_time % 60;

    if ($minutes > 0) {
        $msg = "Cuenta bloqueada por múltiples intentos fallidos. Por favor, espere $minutes minutos y $seconds segundos antes de intentar nuevamente.";
    } else {
        $msg = "Cuenta bloqueada por múltiples intentos fallidos. Por favor, espere $seconds segundos antes de intentar nuevamente.";
    }

    echo "<script>
        alert('" . addslashes($msg) . "');
        window.history.back();
    </script>";
    exit();
}

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'usuario');

if ($conexion->connect_error) {
    echo "<script>alert('Error de conexión a la base de datos.'); window.history.back();</script>";
    exit();
}

// Consultar el usuario
$sql = "SELECT contraseña FROM users WHERE correo = ? AND departamento = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    echo "<script>alert('Error en la consulta.'); window.history.back();</script>";
    $conexion->close();
    exit();
}

$stmt->bind_param("ss", $correo, $departamento);

if (!$stmt->execute()) {
    echo "<script>alert('Error al ejecutar la consulta.'); window.history.back();</script>";
    $stmt->close();
    $conexion->close();
    exit();
}

$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Usuario encontrado
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    
    // Verificar contraseña
    if (password_verify($password, $hashed_password)) {
        // Login exitoso - limpiar intentos
        clearAttempts($correo);
        
        $_SESSION['correo'] = $correo;
        $_SESSION['departamento'] = $departamento;

         // REGISTRAR EN EL HISTORIAL
       registrarAccionComun('login', 'Sistema', null, "IP: " . $_SERVER['REMOTE_ADDR']);
    
    echo "<script>alert('¡Bienvenido!'); window.location.href = '../menuphp/php/menuP.php';</script>";
} else {
         // Contraseña incorrecta
        // Obtener intentos antes y después para mostrar correctamente los restantes
        $attempts_before = getCurrentAttempts($correo);
        recordFailedAttempt($correo);
        $attempts_after = getCurrentAttempts($correo);
        $remaining_attempts = max(0, $max_attempts - $attempts_after);

        // Registrar intento fallido (para auditoría)
        registrarError('Autenticación', "Contraseña incorrecta. Intentos antes: $attempts_before, ahora: $attempts_after de $max_attempts");

        // Registrar en error_log para depuración local (no expone al usuario)
        error_log("Login fallido para $correo: before=$attempts_before after=$attempts_after max=$max_attempts");

        if ($remaining_attempts > 0) {
            echo "<script>
                alert('Contraseña incorrecta. Te quedan $remaining_attempts intentos.');
                window.history.back();
            </script>";
        } else {
            // Bloquear cuenta (mensaje con tiempo restante)
            $remaining_time = getRemainingLockTime($correo);
            $minutes = intdiv($remaining_time, 60);
            $seconds = $remaining_time % 60;

            if ($minutes > 0) {
                $msg = "Has excedido el número máximo de intentos. Cuenta bloqueada por $minutes minutos y $seconds segundos.";
            } else {
                $msg = "Has excedido el número máximo de intentos. Cuenta bloqueada por $seconds segundos.";
            }

            echo "<script>
                alert('" . addslashes($msg) . "');
                window.history.back();
            </script>";
        }
    }
} else {
    // Usuario no encontrado
    $attempts_before = getCurrentAttempts($correo);
    recordFailedAttempt($correo);
    $attempts_after = getCurrentAttempts($correo);
    $remaining_attempts = max(0, $max_attempts - $attempts_after);

    registrarError('Autenticación', "Usuario no encontrado. Intentos antes: $attempts_before, ahora: $attempts_after of $max_attempts");
    error_log("Login no encontrado para $correo: before=$attempts_before after=$attempts_after max=$max_attempts");

    if ($remaining_attempts > 0) {
        echo "<script>
            alert('Correo o departamento no encontrado. Te quedan $remaining_attempts intentos.');
            window.history.back();
        </script>";
    } else {
        // Bloquear cuenta
        $remaining_time = getRemainingLockTime($correo);
        $minutes = intdiv($remaining_time, 60);
        $seconds = $remaining_time % 60;

        if ($minutes > 0) {
            $msg = "Has excedido el número máximo de intentos. Cuenta bloqueada por $minutes minutos y $seconds segundos.";
        } else {
            $msg = "Has excedido el número máximo de intentos. Cuenta bloqueada por $seconds segundos.";
        }

        echo "<script>
            alert('" . addslashes($msg) . "');
            window.history.back();
        </script>";
    }
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/validar.css">
</head>
<body>
    
</body>
</html>