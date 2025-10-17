<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener todos los datos del formulario (Consumo de Agua Para Proceso)
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Mes = $_POST["Mes"] ?? '';
$AguaPM = $_POST["AguaPM"] ?? 0;
$AguaPTA = $_POST["AguaPTA"] ?? 0;


// 2. Consulta para actualizar los datos en la tabla 'm_consumoaguaproceso' de forma segura
$query = "UPDATE m_consumoaguaproceso SET
            Mes = ?, 
            AguaPM = ?, 
            AguaPTA = ?
          WHERE id = ?"; 

// 3. Preparar y ejecutar la consulta
$stmt = mysqli_prepare($link, $query);

if ($stmt) {
    // Vincular parámetros: 's' para string (Mes), 'd' para double/float (AguaPM, AguaPTA), 's' para string (ID)
    // Usamos 'sdds' (String, Double, Double, String)
    mysqli_stmt_bind_param($stmt, 'sdds',
        $Mes, 
        $AguaPM,
        $AguaPTA,
        $ID
    );
    
    // Ejecutar la sentencia
    $ejecucion_exitosa = mysqli_stmt_execute($stmt);
    
    // Obtener el número de filas afectadas
    $filas_afectadas = mysqli_stmt_affected_rows($stmt);
    
    if (!$ejecucion_exitosa) {
        $error_sql = mysqli_error($link);
    } else {
        $error_sql = null;
    }

    // Cerrar la sentencia preparada
    mysqli_stmt_close($stmt);

} else {
    // Error al preparar la sentencia
    $error_sql = "Error al preparar la consulta: " . mysqli_error($link);
    $filas_afectadas = -1; // Indica un error de preparación
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Actualizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            $registro_nombre = "Consumo de Agua Para Proceso";
            
            // 4. Mostrar el resultado de la operación
            if ($filas_afectadas > 0) {
                echo "<div class='mensaje correcto'>Actualización del registro de $registro_nombre **correcta**.</div>";
            } elseif ($filas_afectadas === 0) {
                echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron **cambios** en el registro.</div>";
            } else { 
                // $filas_afectadas < 0 o hubo un error en la ejecución
                $mensaje_error = $error_sql ?? "Error desconocido al intentar actualizar el registro.";
                echo "<div class='mensaje error'>Actualización incorrecta. Error: " . $mensaje_error . "</div>";
            }
            
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        
        <!-- Enlaces de navegación adaptados al nuevo contexto -->
        <a href="ModAguaP.php" class="btn btn-primary">Regresar a Modificar Consumo de Agua</a><br>
        <br>
        <a href='MenuModifi.php' class="home-link"><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>
