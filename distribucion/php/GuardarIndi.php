<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Cumplimiento con el Despacho Programado de Leche Liquida P.A.S Tlaxcala
$CumplRealProgDia = $_POST["CumplRealProgDia"];
$ProgDiarioDespacho = $_POST["ProgDiarioDespacho"];
$PCDP = $_POST["PCDP"];
$MetaEsperadaMB = $_POST["MetaEsperadaMB"];
$RangoAceptMB = $_POST["RangoAceptMB"];
$TendenciaDeseadaMB = $_POST["TendenciaDeseadaMB"];

// Cumplimiento de Ventas Programadas
$Ventatot = $_POST["Ventatot"];
$DotEntre = $_POST["DotEntre"];
$CumplimientoVentas = $_POST["CumplimientoVentas"];
$MetaEsperadaCVP = $_POST["MetaEsperadaCVP"];
$RangoAceptCVP = $_POST["RangoAceptCVP"];
$TendenciaDeseadaCVP = $_POST["TendenciaDeseadaCVP"];

// Control de Envases Rotos
$MermasEnva = $_POST["MermasEnva"];
$DotEnva = $_POST["DotEnva"];
$CantidadEnvRotos = $_POST["CantidadEnvRotos"];
$MetaEsperadaCER = $_POST["MetaEsperadaCER"];
$RangoAceptCER = $_POST["RangoAceptCER"];
$TendenciaDeseadaCER = $_POST["TendenciaDeseadaCER"];

// Devoluciones del P.A.S. Tlaxcala
$Devoluciones = $_POST["Devoluciones"];
$DotDev = $_POST["DotDev"];
$DevolucionesDPAS = $_POST["DevolucionesDPAS"];
$MetaEsperadaDPAS = $_POST["MetaEsperadaDPAS"];
$RangoAceptDPAS = $_POST["RangoAceptDPAS"];
$TendenciaDeseadaDPAS = $_POST["TendenciaDeseadaDPAS"];

// Gastos de Distribución
$GastosTD = $_POST["GastosTD"];
$LitrosDistribucion = $_POST["LitrosDistribucion"];
$GastosDistribucion = $_POST["GastosDistribucion"];
$MetaEsperadaGD = $_POST["MetaEsperadaGD"];
$RangoAceptGD = $_POST["RangoAceptGD"];
$TendenciaDeseadaGD = $_POST["TendenciaDeseadaGD"];

// Responsable y observaciones
$Responsable = $_POST["Responsable"];
$Observ = $_POST["Observ"];


// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO d_indicador (
    Claveregis, FechaAct, Mes, Periodo, 
    CumplRealProgDia, ProgDiarioDespacho, PCDP, MetaEsperadaMB, RangoAceptMB, TendenciaDeseadaMB,
    Ventatot, DotEntre, CumplimientoVentas, MetaEsperadaCVP, RangoAceptCVP, TendenciaDeseadaCVP,
    MermasEnva, DotEnva, CantidadEnvRotos, MetaEsperadaCER, RangoAceptCER, TendenciaDeseadaCER,
    Devoluciones, DotDev, DevolucionesDPAS, MetaEsperadaDPAS, RangoAceptDPAS, TendenciaDeseadaDPAS,
    GastosTD, LitrosDistribucion, GastosDistribucion, MetaEsperadaGD, RangoAceptGD, TendenciaDeseadaGD,
    Responsable, Observ
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$CumplRealProgDia', '$ProgDiarioDespacho', '$PCDP', '$MetaEsperadaMB', '$RangoAceptMB', '$TendenciaDeseadaMB',
    '$Ventatot', '$DotEntre', '$CumplimientoVentas', '$MetaEsperadaCVP', '$RangoAceptCVP', '$TendenciaDeseadaCVP',
    '$MermasEnva', '$DotEnva', '$CantidadEnvRotos', '$MetaEsperadaCER', '$RangoAceptCER', '$TendenciaDeseadaCER',
    '$Devoluciones', '$DotDev', '$DevolucionesDPAS', '$MetaEsperadaDPAS', '$RangoAceptDPAS', '$TendenciaDeseadaDPAS',
    '$GastosTD', '$LitrosDistribucion', '$GastosDistribucion', '$MetaEsperadaGD', '$RangoAceptGD', '$TendenciaDeseadaGD',
    '$Responsable', '$Observ'
)";

// Ejecutar la consulta
$result = mysqli_query($link, $query);
?>


<html>
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
                echo "<div class='mensaje correcto'>Inserción correcta</div>";
            } else {
                echo "<div class='mensaje error'>Inserción incorrecta. Error: " . mysqli_errno($link) . "</div>";
            }
            include "Cerrar.php";
        ?>
        <br><a href='IndiDistribucion.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='distribucionP.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>