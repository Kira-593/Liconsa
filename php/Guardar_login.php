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

    $Nombre1 = $_POST['nombrec'];
    $usuario1 = $_POST['user'];
    $contraseña1 = $_POST['password'];

    $check_query = "SELECT username FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $usuario1);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Usuario ya existe
        echo "<script>
            alert('El nombre de usuario ya está registrado. Por favor, elige otro.');
            window.location.href='../inicio.php';
        </script>";
    } else {

    $query = "INSERT INTO users (Nombre_Completo, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $Nombre1, $usuario1, $contraseña1);
?>

<?php
	if ($stmt->execute()) {
	echo "<script>
    alert('Inserción correcta');
    window.location.href='../inicio.php';
    </script>";
	} else {
		echo "<script>
        alert('Error al insertar usuario: {$conn->error}'
        window.location.href='index.php';
    </script>";
		}
	}
    
$stmt->close();
$conn->close();
?>