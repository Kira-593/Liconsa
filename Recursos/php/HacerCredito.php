<?php
// Incluye la conexión a la base de datos (se asume que define $link)
include "Conexion.php";

// --- 1. Obtener todos los datos del formulario (Depto. Crédito y Cobranza) ---
// Usamos el operador de fusión de null (??) para obtener los valores POST o una cadena vacía.
// Esto mejora la seguridad al garantizar que todas las variables estén definidas antes de usarlas.
$ID = $_POST["id"] ?? ''; 
$Mes = $_POST["Mes"] ?? '';
$CantidadLTF = $_POST["CantidadLTF"] ?? '';
$ImporteTF = $_POST["ImporteTF"] ?? '';
$PorcentajeTF = $_POST["PorcentajeTF"] ?? '';
$CantidadLTFR = $_POST["CantidadLTFR"] ?? '';
$ImporteTFR = $_POST["ImporteTFR"] ?? '';
$PorcentajeTFR = $_POST["PorcentajeTFR"] ?? '';
$CantidadLTPAS = $_POST["CantidadLTPAS"] ?? '';
$ImporteTPAS = $_POST["ImporteTPAS"] ?? '';
$PorcentajeTPAS = $_POST["PorcentajeTPAS"] ?? '';
$CantidadLTPC = $_POST["CantidadLTPC"] ?? '';
$ImporteLTPC = $_POST["ImporteLTPC"] ?? '';
$PorcentajeLTPC = $_POST["PorcentajeLTPC"] ?? '';
$CantidadLTUHT = $_POST["CantidadLTUHT"] ?? '';
$ImporteLTUHT = $_POST["ImporteLTUHT"] ?? '';
$PorcentajeLTUHT = $_POST["PorcentajeLTUHT"] ?? '';
$ObservacionesRes = $_POST["ObservacionesRes"] ?? '';
$TotalFacturadoMes = $_POST["TotalFacturadoMes"] ?? '';
$TotalDepositosMes = $_POST["TotalDepositosMes"] ?? '';
$ObservacionesFacturasDepositos = $_POST["ObservacionesFacturasDepositos"] ?? '';
$SaldoTS = $_POST["SaldoTS"] ?? '';
$SaldoPV = $_POST["SaldoPV"] ?? '';
$SaldoV = $_POST["SaldoV"] ?? '';
$Saldotreina = $_POST["Saldotreina"] ?? '';
$Saldosesenta = $_POST["Saldosesenta"] ?? '';
$Saldonoventa = $_POST["Saldonoventa"] ?? '';
$Saldosecenta = $_POST["Saldosecenta"] ?? '';
$ObservacionesSaldos = $_POST["ObservacionesSaldos"] ?? '';
$TotalSaldo = $_POST["TotalSaldo"] ?? '';
$ObservacionesSaldomes = $_POST["ObservacionesSaldomes"] ?? '';


// 2. Consulta de actualización utilizando marcadores de posición (?)
// Tabla asumida: 'cred_depto_credito_cobranza'
$query = "UPDATE cred_depto_credito_cobranza SET
            Mes = ?,
            CantidadLTF = ?,
            ImporteTF = ?,
            PorcentajeTF = ?,
            CantidadLTFR = ?,
            ImporteTFR = ?,
            PorcentajeTFR = ?,
            CantidadLTPAS = ?,
            ImporteTPAS = ?,
            PorcentajeTPAS = ?,
            CantidadLTPC = ?,
            ImporteLTPC = ?,
            PorcentajeLTPC = ?,
            CantidadLTUHT = ?,
            ImporteLTUHT = ?,
            PorcentajeLTUHT = ?,
            ObservacionesRes = ?,
            TotalFacturadoMes = ?,
            TotalDepositosMes = ?,
            ObservacionesFacturasDepositos = ?,
            SaldoTS = ?,
            SaldoPV = ?,
            SaldoV = ?,
            Saldotreina = ?,
            Saldosesenta = ?,
            Saldonoventa = ?,
            Saldosecenta = ?,
            ObservacionesSaldos = ?,
            TotalSaldo = ?,
            ObservacionesSaldomes = ?
          WHERE id = ?"; 

// 3. Preparar la declaración
$stmt = mysqli_prepare($link, $query);

// 4. Vincular los parámetros 
// Se usa 's' (string) para todos los campos para simplificar la vinculación y evitar errores de tipo,
// confiando en que MySQL convertirá las cadenas a números/fecha si el campo es numérico/fecha.
$tipos = "sssssssssssssssssssssssssssssss"; // 30 's' para 29 campos + ID

mysqli_stmt_bind_param($stmt, $tipos,
    $Mes, $CantidadLTF, $ImporteTF, $PorcentajeTF,
    $CantidadLTFR, $ImporteTFR, $PorcentajeTFR,
    $CantidadLTPAS, $ImporteTPAS, $PorcentajeTPAS,
    $CantidadLTPC, $ImporteLTPC, $PorcentajeLTPC,
    $CantidadLTUHT, $ImporteLTUHT, $PorcentajeLTUHT,
    $ObservacionesRes, $TotalFacturadoMes, $TotalDepositosMes,
    $ObservacionesFacturasDepositos,
    $SaldoTS, $SaldoPV, $SaldoV, $Saldotreina, $Saldosesenta, 
    $Saldonoventa, $Saldosecenta, $ObservacionesSaldos,
    $TotalSaldo, $ObservacionesSaldomes,
    $ID // El ID es el último para la cláusula WHERE
);

// 5. Ejecutar la declaración
$ejecucion_exitosa = mysqli_stmt_execute($stmt);
$filas_afectadas = mysqli_stmt_affected_rows($stmt);
$error_sql = mysqli_stmt_error($stmt);

// 6. Cerrar la declaración
mysqli_stmt_close($stmt);

// Se inicializa una variable para manejar el resultado antes del HTML
$mensaje_clase = 'advertencia';
$mensaje_texto = 'Actualización finalizada. No se detectaron cambios en el registro.';

if ($ejecucion_exitosa) {
    if ($filas_afectadas > 0) {
        $mensaje_clase = 'correcto';
        $mensaje_texto = 'Actualización de Indicadores de Crédito y Cobranza realizada correctamente.';
    }
} else {
    // Hubo un error en la ejecución (ej. un tipo de dato incorrecto)
    $mensaje_clase = 'error';
    $mensaje_texto = 'Actualización incorrecta. Error: ' . $error_sql;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Modificación de Indicadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado (asumido) -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
   
</head>
<body>
    <div class="contenedor">
        <?php
            // 7. Mostrar el resultado de la operación
            echo "<div class='mensaje $mensaje_clase'>$mensaje_texto</div><br>";

            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación -->
        <a href="ModCredito.php" class="btn btn-primary">Regresar a la Modificación</a>
        <br><a href='MenuModifi.php' class="home-link"><img src='../imagenes/home.png' height='100' width='90' alt="Ir al Menú Principal"></a>
    </div>
</body>
</html>
