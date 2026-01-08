<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Cumplimientos de la Capacitación
$CapaImpar = $_POST["CapaImpar"];
$CapaProg = $_POST["CapaProg"];
$PorCumplimientoCAP = $_POST["PorCumplimientoCAP"];
$MetaEsperadaCC = $_POST["MetaEsperadaCC"];
$RangoAceptCC = $_POST["RangoAceptCC"];
$TendenciaDeseadaCC = $_POST["TendenciaDeseadaCC"];

// Evaluación Técnica
$NuevosIP = $_POST["NuevosIP"];
$NumEvaluaciones = $_POST["NumEvaluaciones"];
$PorCumplimientoET = $_POST["PorCumplimientoET"];
$MetaEsperadaET = $_POST["MetaEsperadaET"];
$RangoAceptET = $_POST["RangoAceptET"];
$TendenciaDeseadaET = $_POST["TendenciaDeseadaET"];

// Responsable y fuente
$Responsable = $_POST["Responsable"];
$Fuente = $_POST["Fuente"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO g_indicador_ma (
    Claveregis, FechaAct, Mes, Periodo,
    CapaImpar, CapaProg, PorCumplimientoCAP, MetaEsperadaCC, RangoAceptCC, TendenciaDeseadaCC,
    NuevosIP, NumEvaluaciones, PorCumplimientoET, MetaEsperadaET, RangoAceptET, TendenciaDeseadaET,
    Responsable, Fuente
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$CapaImpar', '$CapaProg', '$PorCumplimientoCAP', '$MetaEsperadaCC', '$RangoAceptCC', '$TendenciaDeseadaCC',
    '$NuevosIP', '$NumEvaluaciones', '$PorCumplimientoET', '$MetaEsperadaET', '$RangoAceptET', '$TendenciaDeseadaET',
    '$Responsable', '$Fuente'
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
        <br><a href='IndiGestionMa.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='MenuIndiMa.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>