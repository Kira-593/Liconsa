<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Calibración Externa de los Equipos del Laboratorio
$NumEquiposAtendidos = $_POST["NumEquiposAtendidos"];
$NumEquiposProgramados = $_POST["NumEquiposProgramados"];
$CalibracionEquipos = $_POST["CalibracionEquipos"];
$MetaEsperadaCEE = $_POST["MetaEsperadaCEE"];
$RangoAceptCEE = $_POST["RangoAceptCEE"];
$TendenciaDeseadaCEE = $_POST["TendenciaDeseadaCEE"];

// Inspección de Áreas de Producción, Almacén y Control de Calidad
$NumObservaciones = $_POST["NumObservaciones"];
$NumPuntosEvaluados = $_POST["NumPuntosEvaluados"];
$CumplimientoPuntosEvaluados = $_POST["CumplimientoPuntosEvaluados"];
$MetaEsperadaIAP = $_POST["MetaEsperadaIAP"];
$RangoAceptIAP = $_POST["RangoAceptIAP"];
$TendenciaDeseadaIAP = $_POST["TendenciaDeseadaIAP"];

// Responsable y fuente
$Responsable = $_POST["Responsable"];
$ObservacionesRes = $_POST["ObservacionesRes"];


// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO c_indicador (
    Claveregis, FechaAct, Mes, Periodo,
    NumEquiposAtendidos, NumEquiposProgramados, CalibracionEquipos, 
    MetaEsperadaCEE, RangoAceptCEE, TendenciaDeseadaCEE,
    NumObservaciones, NumPuntosEvaluados, CumplimientoPuntosEvaluados,
    MetaEsperadaIAP, RangoAceptIAP, TendenciaDeseadaIAP,
    Responsable, ObservacionesRes
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$NumEquiposAtendidos', '$NumEquiposProgramados', '$CalibracionEquipos',
    '$MetaEsperadaCEE', '$RangoAceptCEE', '$TendenciaDeseadaCEE',
    '$NumObservaciones', '$NumPuntosEvaluados', '$CumplimientoPuntosEvaluados',
    '$MetaEsperadaIAP', '$RangoAceptIAP', '$TendenciaDeseadaIAP',
    '$Responsable', '$ObservacionesRes'
)";

// Ejecutar la consulta
mysqli_query($link, $query);
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
        <br><a href='IndiControl.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>