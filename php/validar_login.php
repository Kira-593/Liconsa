<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuario";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Manejo de error de conexión
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario (de acuerdo a los nuevos campos)
$departamento_form = $_POST['departamento'];
$correo_form = $_POST['correo'];
$password_form = $_POST['password']; // Contraseña en texto plano

// 1. Consultar la base de datos buscando el CORREO y el DEPARTAMENTO
// Se obtiene el hash de la contraseña guardada en la columna 'contraseña'.
$sql = "SELECT correo, contraseña, Nombre, departamento FROM users WHERE correo = ? AND departamento = ?";
//                                                     ↑ AÑADIR ESTE CAMPO ↑
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

// "ss" indica que los dos parámetros son strings (correo y departamento)
$stmt->bind_param("ss", $correo_form, $departamento_form);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Usuario encontrado: verificar la contraseña con hashing
    $user_data = $result->fetch_assoc();
    $hashed_password_db = $user_data['contraseña']; // Hash de la DB

    // 2. Verificar la contraseña: Compara la contraseña en texto plano del formulario con el hash de la DB.
    if (password_verify($password_form, $hashed_password_db)) {
        // Credenciales correctas
        session_start();
        
        // Guardar datos esenciales en la sesión
        $_SESSION['correo'] = $user_data['correo'];
        $_SESSION['Nombre'] = $user_data['Nombre']; 
        $_SESSION['departamento'] = $user_data['departamento']; // ← ¡FALTABA ESTA LÍNEA!
        
        // Redirigir al menú principal
        header("Location: ../menuphp/php/menuP.php");
        exit();
    } else {
        // Contraseña incorrecta
        echo "<script>
            alert('Contraseña incorrecta.');
            window.history.back();
        </script>";
    }
} else {
    // Usuario no encontrado o combinación correo/departamento incorrecta
    echo "<script>
        alert('Departamento o Correo incorrectos.');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>