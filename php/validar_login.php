<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuario";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$user = $_POST['login'];
$pass = $_POST['password'];

// Validar credenciales (sin hash, comparando en texto plano)
$sql = "SELECT * FROM users WHERE BINARY username = ? AND BINARY password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['username'] = $user;
    header("Location: ../menuphp/php/menuP.php");
} else {
    echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location.href='../inicio.php';
          </script>";
}

$stmt->close();
$conn->close();
?>