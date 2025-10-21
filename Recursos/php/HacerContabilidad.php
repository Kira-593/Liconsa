<?php
// Incluye la conexión a la base de datos
// Se asume que este archivo contiene la inicialización de $link y la función Cerrar.php
include "Conexion.php";

// Definición de $ID para ser usado en el WHERE
$ID = $_POST["id"] ?? ''; 
$Mes = $_POST["Mes"] ?? '';

// --- 1. Obtener y sanitizar todos los datos del formulario (Depto. Contabilidad) ---

// Servicios Personales
$ComprometidoMAOB = $_POST["ComprometidoMAOB"] ?? '';
$DisponibleMAOB = $_POST["DisponibleMAOB"] ?? '';
$ComprometidoEMCO = $_POST["ComprometidoEMCO"] ?? '';
$DisponibleEMCO = $_POST["DisponibleEMCO"] ?? '';
$ComprometidoEMEV = $_POST["ComprometidoEMEV"] ?? '';
$DisponibleEMEV = $_POST["DisponibleEMEV"] ?? '';
$TPCSEPE = $_POST["TPCSEPE"] ?? '';
$TPDSEPE = $_POST["TPDSEPE"] ?? '';

// Materiales y Suministros
$ComprometidoPRES = $_POST["ComprometidoPRES"] ?? '';
$DisponiblePRES = $_POST["DisponiblePRES"] ?? '';
$ComprometidoMAOP = $_POST["ComprometidoMAOP"] ?? '';
$DisponibleMAOP = $_POST["DisponibleMAOP"] ?? '';
$TPCMASU = $_POST["TPCMASU"] ?? '';
$TPDMASU = $_POST["TPDMASU"] ?? '';

// Servicios Generales
$ComprometidoPREM = $_POST["ComprometidoPREM"] ?? '';
$DisponiblePREM = $_POST["DisponiblePREM"] ?? '';
$ComprometidoMACO = $_POST["ComprometidoMACO"] ?? '';
$DisponibleMACO = $_POST["DisponibleMACO"] ?? '';
$ComprometidoIMDE = $_POST["ComprometidoIMDE"] ?? '';
$DisponibleIMDE = $_POST["DisponibleIMDE"] ?? '';
$ComprometidoSEFI = $_POST["ComprometidoSEFI"] ?? '';
$DisponibleSEFI = $_POST["DisponibleSEFI"] ?? '';
$ComprometidoSERBA = $_POST["ComprometidoSERBA"] ?? '';
$DisponibleSERBA = $_POST["DisponibleSERBA"] ?? '';
$ComprometidoTRAN = $_POST["ComprometidoTRAN"] ?? '';
$DisponibleTRAN = $_POST["DisponibleTRAN"] ?? '';
$ComprometidoGARE = $_POST["ComprometidoGARE"] ?? '';
$DisponibleGARE = $_POST["DisponibleGARE"] ?? '';
$TPCSEGE = $_POST["TPCSEGE"] ?? '';
$TPDSEGE = $_POST["TPDSEGE"] ?? '';

// Ventas y Costos
$ComprometidoVentas = $_POST["ComprometidoVentas"] ?? '';
$ObservacionesVentas = $_POST["ObservacionesVentas"] ?? '';
$CostoVLF = $_POST["CostoVLF"] ?? '';
$CostoFLF = $_POST["CostoFLF"] ?? '';
$CostoVMG = $_POST["CostoVMG"] ?? '';
$CostoFMG = $_POST["CostoFMG"] ?? '';
$CostoVLFRI = $_POST["CostoVLFRI"] ?? '';
$CostoFLFRI = $_POST["CostoFLFRI"] ?? '';

// --- 2. Consulta de actualización (41 campos + 1 WHERE) ---
$query = "UPDATE con_deptocontabilidad SET
             Mes = ?,
             
             ComprometidoMAOB = ?, DisponibleMAOB = ?,
             ComprometidoEMCO = ?, DisponibleEMCO = ?,
             ComprometidoEMEV = ?, DisponibleEMEV = ?,
             TPCSEPE = ?, TPDSEPE = ?,
             
             ComprometidoPRES = ?, DisponiblePRES = ?,
             ComprometidoMAOP = ?, DisponibleMAOP = ?,
             TPCMASU = ?, TPDMASU = ?,
             
             ComprometidoPREM = ?, DisponiblePREM = ?,
             ComprometidoMACO = ?, DisponibleMACO = ?,
             ComprometidoIMDE = ?, DisponibleIMDE = ?,
             ComprometidoSEFI = ?, DisponibleSEFI = ?,
             ComprometidoSERBA = ?, DisponibleSERBA = ?,
             ComprometidoTRAN = ?, DisponibleTRAN = ?,
             ComprometidoGARE = ?, DisponibleGARE = ?,
             TPCSEGE = ?, TPDSEGE = ?,
             
             ComprometidoVentas = ?, ObservacionesVentas = ?,
             CostoVLF = ?, CostoFLF = ?,
             CostoVMG = ?, CostoFMG = ?,
             CostoVLFRI = ?, CostoFLFRI = ?
           WHERE id = ?"; 

// 3. Preparar la declaración
$stmt = mysqli_prepare($link, $query);

// 4. Vincular los parámetros (42 parámetros totales, todos como string 's')
// Usamos "s" para todos los campos por seguridad, asumiendo que el campo Mes y los numéricos/monetarios 
// llegan como strings desde el formulario.
$tipos = str_repeat("s", 40);

// Nota: El orden de las variables debe coincidir exactamente con el orden de los '?' en el $query, 
// con $ID al final.
mysqli_stmt_bind_param($stmt, $tipos,
    $Mes,
    $ComprometidoMAOB, $DisponibleMAOB,
    $ComprometidoEMCO, $DisponibleEMCO,
    $ComprometidoEMEV, $DisponibleEMEV,
    $TPCSEPE, $TPDSEPE,
    $ComprometidoPRES, $DisponiblePRES,
    $ComprometidoMAOP, $DisponibleMAOP,
    $TPCMASU, $TPDMASU,
    $ComprometidoPREM, $DisponiblePREM,
    $ComprometidoMACO, $DisponibleMACO,
    $ComprometidoIMDE, $DisponibleIMDE,
    $ComprometidoSEFI, $DisponibleSEFI,
    $ComprometidoSERBA, $DisponibleSERBA,
    $ComprometidoTRAN, $DisponibleTRAN,
    $ComprometidoGARE, $DisponibleGARE,
    $TPCSEGE, $TPDSEGE,
    $ComprometidoVentas, $ObservacionesVentas,
    $CostoVLF, $CostoFLF,
    $CostoVMG, $CostoFMG,
    $CostoVLFRI, $CostoFLFRI,
    $ID // Último parámetro para la cláusula WHERE
);

// 5. Ejecutar la declaración y manejar el resultado
$ejecucion_exitosa = mysqli_stmt_execute($stmt);
$filas_afectadas = mysqli_stmt_affected_rows($stmt);
$error_sql = mysqli_stmt_error($stmt);

// Cerrar la declaración
mysqli_stmt_close($stmt);

// --- Resultado y Mensaje para la vista ---
$mensaje_clase = 'advertencia';
$mensaje_texto = 'Actualización finalizada. No se detectaron cambios en el registro.';

if ($ejecucion_exitosa) {
    if ($filas_afectadas > 0) {
        $mensaje_clase = 'correcto';
        $mensaje_texto = 'Actualización de Indicadores de Contabilidad realizada correctamente.';
    }
} else {
    $mensaje_clase = 'error';
    $mensaje_texto = 'Actualización incorrecta. Error: ' . $error_sql;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Modificación de Indicadores de Contabilidad</title> 
    <!-- Enlaces y estilos de la página de resultados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Se mantiene el estilo original para la página de resultado -->
    <link rel="stylesheet" href="../css/hacer.css"> 
</head>
<body>
    <div class="contenedor">
        <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
        <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
        
        <?php
            // Muestra el resultado de la operación
            echo "<div class='mensaje $mensaje_clase'>$mensaje_texto</div><br>";
            // Se asume que Cerrar.php cierra la conexión a la BD
            include "Cerrar.php";
        ?>
        <!-- El formulario de origen es ModContabilidad.php, por lo que el regreso es a ese archivo -->
        <a href="ModContabilidad.php" class="btn">Regresar a la Modificación</a>
        <br><a href='MenuModifi.php' class="home-link"><img src='../imagenes/home.png' height='100' width='90' alt="Ir al Menú Principal"></a>
    </div>
</body>
</html>
