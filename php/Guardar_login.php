<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usuario";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
$nombre = $_POST['nombre'];
$ap_P = $_POST['ap_P'];
$ap_M = $_POST['ap_M'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$departamento = $_POST['departamento'];
$claveF = $_POST['claveF'];

// --- Validaciones de Seguridad y Lógica ---

// 2. Validar que las contraseñas coincidan
if ($password !== $confirm_password) {
    echo "<script>
        alert('Las contraseñas ingresadas no coinciden. Por favor, verifica e inténtalo de nuevo.');
        window.history.back(); // Regresa a la página anterior sin recargar
    </script>";
    exit();
}

// 3. Hash de la contraseña antes de guardarla (CRÍTICO para seguridad)
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// 4. Verificar si el CORREO ya existe en la tabla 'users'
$check_query = "SELECT correo FROM users WHERE correo = ?";
$check_stmt = $conn->prepare($check_query);
// 's' indica que el parámetro es un string (correo)
$check_stmt->bind_param("s", $correo);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    // Correo ya existe
    echo "<script>
        alert('El correo electrónico ya está registrado. Por favor, utiliza otro.');
        window.history.back();
    </script>";
    $check_stmt->close();
    exit();
} else {
    // 5. Inserción del nuevo usuario
    // Columnas de la DB: Nombre, Ap_P, Ap_M, contraseña, departamento, correo, claveF
    $query = "INSERT INTO users (Nombre, Ap_P, Ap_M, contraseña, departamento, correo, claveF) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
              
    $stmt = $conn->prepare($query);
    // 'sssssss' indica 7 parámetros de tipo string
    $stmt->bind_param("sssssss", $nombre, $ap_P, $ap_M, $password_hashed, $departamento, $correo, $claveF);

    if ($stmt->execute()) {
    echo "<script>
        alert('¡Registro exitoso! Ya puedes iniciar sesión.');
        window.location.href='../inicio.php';
    </script>";
}  {
        // Muestra un mensaje de error detallado
            echo "<script>
                alert('Error al insertar usuario: {$conn->error}');
                window.location.href='../index.php'; // Redirige de vuelta al registro
            </script>";
    }
    
    $stmt->close();     
?>

<?php
	if ($stmt->execute()) {
    echo "<script>
        alert('Inserción correcta');
        window.location.href='../inicio.php';
    </script>";
} else {
    echo "<script>
        alert('Error al insertar usuario: {$conn->error}');
        window.history.back();
    </script>";
    }
}
    
$stmt->close();
$conn->close();
?>