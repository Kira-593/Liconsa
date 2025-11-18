<?php
// Mostrar errores para debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Error</title></head><body>";
    echo "<h1>Error de Conexión</h1>";
    echo "<p>" . htmlspecialchars($conn->connect_error) . "</p>";
    echo "<a href='../inicio.php'>Volver</a>";
    echo "</body></html>";
    die();
}

// Verificar que haya datos POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../inicio.php');
    exit();
}

// Obtener datos del formulario con validación
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$ap_P = isset($_POST['ap_P']) ? trim($_POST['ap_P']) : '';
$ap_M = isset($_POST['ap_M']) ? trim($_POST['ap_M']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
$departamento = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';
$claveF = isset($_POST['claveF']) ? trim($_POST['claveF']) : '';

// Validar que todos los campos requeridos estén presentes
if (empty($nombre) || empty($ap_P) || empty($ap_M) || empty($correo) || empty($password) || empty($confirm_password) || empty($departamento) || empty($claveF)) {
    echo "<script>alert('Por favor completa todos los campos.'); window.history.back();</script>";
    $conn->close();
    exit();
}

// --- Obtener dominio permitido desde la tabla usuarios.validacion_correo.tipoCorreo ---
$allowedDomain = '@lechebienestar.gob.mx'; // valor por defecto
$domainQuery = "SELECT tipoCorreo FROM usuarios.validacion_correo LIMIT 1";
$domainRes = @$conn->query($domainQuery); // Suprimir advertencias si falla
if ($domainRes && $domainRes->num_rows > 0) {
    $drow = $domainRes->fetch_assoc();
    if (!empty($drow['tipoCorreo'])) {
        $allowedDomain = $drow['tipoCorreo'];
    }
}

// Asegurar que el dominio permitido comienza con '@'
if (substr($allowedDomain, 0, 1) !== '@') {
    $allowedDomain = '@' . $allowedDomain;
}

// Normalizar el correo y validar dominio requerido (server-side)
$correo_trim = trim($correo);
if (stripos($correo_trim, $allowedDomain) === false || !preg_match('/'.preg_quote($allowedDomain,'/').'$/i', $correo_trim)) {
    echo "<script>alert('El correo debe pertenecer al dominio: " . htmlspecialchars($allowedDomain) . "'); window.history.back();</script>";
    $conn->close();
    exit();
}

// Validar que las contraseñas coincidan
if ($password !== $confirm_password) {
    echo "<script>alert('Las contraseñas ingresadas no coinciden.'); window.history.back();</script>";
    $conn->close();
    exit();
}

// Hash de la contraseña antes de guardarla
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Verificar si el correo ya existe
$check_query = "SELECT correo FROM users WHERE correo = ?";
$check_stmt = $conn->prepare($check_query);
if (!$check_stmt) {
    echo "<script>alert('Error de base de datos.'); window.history.back();</script>";
    $conn->close();
    exit();
}

$check_stmt->bind_param("s", $correo);
if (!$check_stmt->execute()) {
    echo "<script>alert('Error al ejecutar consulta.'); window.history.back();</script>";
    $check_stmt->close();
    $conn->close();
    exit();
}

$check_stmt->store_result();
if ($check_stmt->num_rows > 0) {
    echo "<script>alert('El correo electrónico ya está registrado.'); window.history.back();</script>";
    $check_stmt->close();
    $conn->close();
    exit();
}
$check_stmt->close();

// Insertar nuevo usuario
$query = "INSERT INTO users (Nombre, Ap_P, Ap_M, contraseña, departamento, correo, claveF) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
if (!$stmt) {
    echo "<script>alert('Error al preparar inserción.'); window.history.back();</script>";
    $conn->close();
    exit();
}

$stmt->bind_param("sssssss", $nombre, $ap_P, $ap_M, $password_hashed, $departamento, $correo, $claveF);

if ($stmt->execute()) {
    echo "<script>alert('¡Registro exitoso! Ya puedes iniciar sesión.'); window.location.href='../inicio.php';</script>";
} else {
    echo "<script>alert('Error al insertar usuario: " . htmlspecialchars($stmt->error) . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
