<?php
/**
 * Script para crear la tabla user_history si no existe
 * Ejecuta esto una sola vez para configurar la base de datos
 */

$conexion = new mysqli('localhost', 'root', '', 'usuario');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// SQL para crear la tabla
$sql = "CREATE TABLE IF NOT EXISTS user_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_correo VARCHAR(255) NOT NULL,
    usuario_departamento VARCHAR(255) NOT NULL,
    accion VARCHAR(255) NOT NULL,
    modulo VARCHAR(255) NOT NULL,
    detalles LONGTEXT,
    ip_address VARCHAR(45),
    user_agent LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_correo (usuario_correo),
    INDEX idx_departamento (usuario_departamento),
    INDEX idx_modulo (modulo),
    INDEX idx_created_at (created_at)
)";

if ($conexion->query($sql) === TRUE) {
    echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin: 20px;'>
            <strong>✓ Éxito:</strong> Tabla 'user_history' creada o ya existe.
          </div>";
} else {
    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin: 20px;'>
            <strong>✗ Error:</strong> " . $conexion->error . "
          </div>";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tabla de Historial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Configuración de Tabla de Historial</h1>
    <p>La tabla ha sido verificada y configurada correctamente.</p>
    <p><a href="../menuphp/php/menuP.php">Volver al menú principal</a></p>
</body>
</html>
