<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener todos los datos del formulario.
// Usamos el operador de fusión de null (??) para obtener los valores o una cadena vacía/0.
$ID = $_POST["id"] ?? ''; 
$Mes = $_POST["Mes"] ?? '';

// Consumo de Energía Térmica (Diesel)
$CantidadDieselCTC = $_POST["CantidadDieselCTC"] ?? 0;
$ReduccionITD = $_POST["ReduccionITD"] ?? 0;
$PromedioRID = $_POST["PromedioRID"] ?? 0;
$LitrosDLL = $_POST["LitrosDLL"] ?? 0;
$ReduccionILD = $_POST["ReduccionILD"] ?? 0;
$PromedioRILD = $_POST["PromedioRILD"] ?? 0;

// Consumo de Energía Eléctrica
$CantidadEnergiaCTC = $_POST["CantidadEnergiaCTC"] ?? 0;
$ReduccionITR = $_POST["ReduccionITR"] ?? 0;
$PromedioRIT = $_POST["PromedioRIT"] ?? 0;
$CantidadLLT = $_POST["CantidadLLT"] ?? 0;
$ReduccionIKL = $_POST["ReduccionIKL"] ?? 0;
$PromedioRIK = $_POST["PromedioRIK"] ?? 0;


// 2. Consulta para actualizar los datos en la tabla 'm_consumo_energia_termica_electrica'
// Utilizamos placeholders (?) para la seguridad contra Inyección SQL.
$query = "UPDATE m_consumo_energia_termica_electrica SET
            Mes = ?, 
            CantidadDieselCTC = ?, 
            ReduccionITD = ?, 
            PromedioRID = ?,
            LitrosDLL = ?,
            ReduccionILD = ?,
            PromedioRILD = ?,
            CantidadEnergiaCTC = ?,
            ReduccionITR = ?,
            PromedioRIT = ?,
            CantidadLLT = ?,
            ReduccionIKL = ?,
            PromedioRIK = ?
          WHERE id = ?"; 

// 3. Preparar y ejecutar la consulta
$stmt = mysqli_prepare($link, $query);

if ($stmt) {
    // Vincular parámetros: 's' para string (Mes), 'd' para double/float (todos los números) y 's' para string (ID)
    // El orden de los tipos debe coincidir con el orden de los placeholders (?)
    mysqli_stmt_bind_param($stmt, 'sdddddddddddds',
        $Mes, 
        $CantidadDieselCTC,
        $ReduccionITD,
        $PromedioRID,
        $LitrosDLL,
        $ReduccionILD,
        $PromedioRILD,
        $CantidadEnergiaCTC,
        $ReduccionITR,
        $PromedioRIT,
        $CantidadLLT,
        $ReduccionIKL,
        $PromedioRIK,
        $ID
    );
    
    // Ejecutar la sentencia
    $ejecucion_exitosa = mysqli_stmt_execute($stmt);
    
    // Obtener el número de filas afectadas
    $filas_afectadas = mysqli_stmt_affected_rows($stmt);
    
    // Si la ejecución fue exitosa, pero no afectó filas, es posible que los datos fueran los mismos
    // Si la ejecución falló, mysqli_error($link) puede dar la razón si se verifica a tiempo.
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
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado (asumiendo que tiene los estilos de mensajes) -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            $registro_nombre = "Consumo de Energía Térmica y Eléctrica";
            
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
        
        <!-- Los enlaces de regreso se actualizan para reflejar la navegación del formulario de destino -->
        <a href="ModConsEnergia.php" class="btn btn-primary">Regresar a Modificar Consumo</a><br>
        <br>
        <a href='MenuModifi.php' class="home-link">
             <img src='../imagenes/home.png' height='100' width='90'>
        </a>
    </div>
</body>
</html>
