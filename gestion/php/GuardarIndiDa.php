<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Ambiente de trabajo - Reporte de inspección de Órden seguridad y Limpieza en Areas de Servicio
$NoSatis = $_POST["NoSatis"];
$NoPuntos = $_POST["NoPuntos"];
$DndSat = $_POST["DndSat"];
$MetaEsperadaRIO = $_POST["MetaEsperadaRIO"];
$RangoAceptRIO = $_POST["RangoAceptRIO"];
$TendenciaDeseadaRIO = $_POST["TendenciaDeseadaRIO"];

// Ambiente de Trabajo - Uniformes de Trabajo y Equipo de Protección de Personal Operativo
$NoSatisUnif = $_POST["NoSatisUnif"];
$NoPuntosUnif = $_POST["NoPuntosUnif"];
$DndSatUnif = $_POST["DndSatUnif"];
$MetaEsperadaUTE = $_POST["MetaEsperadaUTE"];
$RangoAceptUTE = $_POST["RangoAceptUTE"];
$TendenciaDeseadaUTE = $_POST["TendenciaDeseadaUTE"];

// Accidentes e Incidentes por Riesgo de Trabajo
$CantAcci = $_POST["CantAcci"];
$DiasLaborados = $_POST["DiasLaborados"];
$Frecuencia = $_POST["Frecuencia"];
$MetaEsperadaAIR = $_POST["MetaEsperadaAIR"];
$RangoAceptAIR = $_POST["RangoAceptAIR"];
$TendenciaDeseadaAIR = $_POST["TendenciaDeseadaAIR"];

// Actos y Condiciones Inseguras
$CantActCondInseg = $_POST["CantActCondInseg"];
$MetaEsperadaACI = $_POST["MetaEsperadaACI"];
$RangoAceptACI = $_POST["RangoAceptACI"];
$TendenciaDeseadaACI = $_POST["TendenciaDeseadaACI"];

// Responsable y fuente
$Responsable = $_POST["Responsable"];
$ObservacionesRes = $_POST["ObservacionesRes"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO g_indicador_da (
    Claveregis, FechaAct, Mes, Periodo,
    NoSatis, NoPuntos, DndSat, MetaEsperadaRIO, RangoAceptRIO, TendenciaDeseadaRIO,
    NoSatisUnif, NoPuntosUnif, DndSatUnif, MetaEsperadaUTE, RangoAceptUTE, TendenciaDeseadaUTE,
    CantAcci, DiasLaborados, Frecuencia, MetaEsperadaAIR, RangoAceptAIR, TendenciaDeseadaAIR,
    CantActCondInseg, MetaEsperadaACI, RangoAceptACI, TendenciaDeseadaACI,
    Responsable, ObservacionesRes
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$NoSatis', '$NoPuntos', '$DndSat', '$MetaEsperadaRIO', '$RangoAceptRIO', '$TendenciaDeseadaRIO',
    '$NoSatisUnif', '$NoPuntosUnif', '$DndSatUnif', '$MetaEsperadaUTE', '$RangoAceptUTE', '$TendenciaDeseadaUTE',
    '$CantAcci', '$DiasLaborados', '$Frecuencia', '$MetaEsperadaAIR', '$RangoAceptAIR', '$TendenciaDeseadaAIR',
    '$CantActCondInseg', '$MetaEsperadaACI', '$RangoAceptACI', '$TendenciaDeseadaACI',
    '$Responsable', '$ObservacionesRes'
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
        <br><a href='IndiGestionDa.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='MenuIndiDa.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>