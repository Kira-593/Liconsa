<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    
    // Resumen de Facturación - Leche Fortificada
    $CantidadLTF = $_POST["CantidadLTF"];
    $ImporteTF = $_POST["ImporteTF"];
    $PorcentajeTF = $_POST["PorcentajeTF"];
    
    // Resumen de Facturación - Leche Frisia
    $CantidadLTFR = $_POST["CantidadLTFR"];
    $ImporteTFR = $_POST["ImporteTFR"];
    $PorcentajeTFR = $_POST["PorcentajeTFR"];
    
    // Resumen de Facturación - Leche de Polvo AS
    $CantidadLTPAS = $_POST["CantidadLTPAS"];
    $ImporteTPAS = $_POST["ImporteTPAS"];
    $PorcentajeTPAS = $_POST["PorcentajeTPAS"];
    
    // Resumen de Facturación - Leche de Polvo Comercial
    $CantidadLTPC = $_POST["CantidadLTPC"];
    $ImporteLTPC = $_POST["ImporteLTPC"];
    $PorcentajeLTPC = $_POST["PorcentajeLTPC"];
    
    // Resumen de Facturación - Leche UHT
    $CantidadLTUHT = $_POST["CantidadLTUHT"];
    $ImporteLTUHT = $_POST["ImporteLTUHT"];
    $PorcentajeLTUHT = $_POST["PorcentajeLTUHT"];
    
    $ObservacionesRes = $_POST["ObservacionesRes"];
    
    // Análisis de Saldos Vencidos
    $TotalFacturadoMes = $_POST["TotalFacturadoMes"];
    $TotalDepositosMes = $_POST["TotalDepositosMes"];
    $ObservacionesFacturasDepositos = $_POST["ObservacionesFacturasDepositos"];
    
    // Saldos del Mes
    $SaldoTS = $_POST["SaldoTS"];
    $SaldoPV = $_POST["SaldoPV"];
    $SaldoV = $_POST["SaldoV"];
    $Saldotreina = $_POST["Saldotreina"];
    $Saldosesenta = $_POST["Saldosesenta"];
    $Saldonoventa = $_POST["Saldonoventa"];
    $Saldosecenta = $_POST["Saldosecenta"];
    $ObservacionesSaldos = $_POST["ObservacionesSaldos"];
    
    // Saldo del Cliente Alimentación Para el Bienestar
    $TotalSaldo = $_POST["TotalSaldo"];
    $ObservacionesSaldomes = $_POST["ObservacionesSaldomes"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO cred_depto_credito_cobranza (
        Mes, 
        CantidadLTF, ImporteTF, PorcentajeTF,
        CantidadLTFR, ImporteTFR, PorcentajeTFR,
        CantidadLTPAS, ImporteTPAS, PorcentajeTPAS,
        CantidadLTPC, ImporteLTPC, PorcentajeLTPC,
        CantidadLTUHT, ImporteLTUHT, PorcentajeLTUHT,
        ObservacionesRes,
        TotalFacturadoMes, TotalDepositosMes, ObservacionesFacturasDepositos,
        SaldoTS, SaldoPV, SaldoV, Saldotreina, Saldosesenta, Saldonoventa, Saldosecenta,
        ObservacionesSaldos,
        TotalSaldo, ObservacionesSaldomes
    ) VALUES (
        '$Mes',
        '$CantidadLTF', '$ImporteTF', $PorcentajeTF,
        '$CantidadLTFR', '$ImporteTFR', $PorcentajeTFR,
        '$CantidadLTPAS', '$ImporteTPAS', $PorcentajeTPAS,
        '$CantidadLTPC', '$ImporteLTPC', $PorcentajeLTPC,
        '$CantidadLTUHT', '$ImporteLTUHT', $PorcentajeLTUHT,
        '$ObservacionesRes',
        '$TotalFacturadoMes', $TotalDepositosMes, '$ObservacionesFacturasDepositos',
        $SaldoTS, $SaldoPV, $SaldoV, $Saldotreina, $Saldosesenta, $Saldonoventa, $Saldosecenta,
        '$ObservacionesSaldos',
        '$TotalSaldo', '$ObservacionesSaldomes'
    )";

    // Ejecutar la consulta
    mysqli_query($link, $query);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/guardar.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
    <div class="contenedor">
        <?php
            if (mysqli_affected_rows($link) > 0) {
                echo "<div class='mensaje correcto'>Registro guardado correctamente</div>";
            } else {
                echo "<div class='mensaje error'>Error al guardar el registro. Error: " . mysqli_error($link) . "</div>";
            }
            include "Cerrar.php";
        ?>
        <br><a href='FormContabilidad.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='TipoFormulario.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>