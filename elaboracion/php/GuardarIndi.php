<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Cumplimiento al Programa de Distribución Mensual de Leche
$DBPAS = $_POST["DBPAS"];
$PDOACP = $_POST["PDOACP"];
$LRAPMDOL = $_POST["LRAPMDOL"];
$PC = $_POST["PC"];
$MetaEsperadaDMLPS = $_POST["MetaEsperadaDMLPS"];
$RangoAceptDMLPS = $_POST["RangoAceptDMLPS"];
$TendenciaDeseadaDMLPS = $_POST["TendenciaDeseadaDMLPS"];

// Entrega de Producto no Cubiertas
$CDLPAS = $_POST["CDLPAS"];
$MetaEsperadaEPNC = $_POST["MetaEsperadaEPNC"];
$RangoAceptEPNC = $_POST["RangoAceptEPNC"];
$TendenciaDeseadaEPNC = $_POST["TendenciaDeseadaEPNC"];

// Cumplimiento Con la Producción Solicitada
$DespaReal = $_POST["DespaReal"];
$DespaProg = $_POST["DespaProg"];
$LechePrograma = $_POST["LechePrograma"];
$PorcentajeProduccion = $_POST["PorcentajeProduccion"];
$PPL = $_POST["PPL"];
$MetaEsperadaCPSP = $_POST["MetaEsperadaCPSP"];
$RangoAceptCPSP = $_POST["RangoAceptCPSP"];
$TendenciaDeseadaCPSP = $_POST["TendenciaDeseadaCPSP"];

// Calidad de la leche de Abasto - Grasa
$GLCMGV = $_POST["GLCMGV"];
$GLPD = $_POST["GLPD"];

// Calidad de la leche de Abasto - Proteína
$PLCMGV = $_POST["PLCMGV"];
$PLPD = $_POST["PLPD"];
$MetaEsperadaCLA = $_POST["MetaEsperadaCLA"];
$RangoAceptCLA = $_POST["RangoAceptCLA"];
$TendenciaDeseadaCLA = $_POST["TendenciaDeseadaCLA"];

// Cumplimiento de las Buenas Practicas de Higiene
$PCBH = $_POST["PCBH"];
$MetaEsperadaCBC = $_POST["MetaEsperadaCBC"];
$RangoAceptCBC = $_POST["RangoAceptCBC"];
$TendenciaDeseadaCBC = $_POST["TendenciaDeseadaCBC"];

// Cumplimiento a los Lineamientos Internos
$PCCL = $_POST["PCCL"];
$MetaEsperadaCLI = $_POST["MetaEsperadaCLI"];
$RangoAceptCLI = $_POST["RangoAceptCLI"];
$TendenciaDeseadaCLI = $_POST["TendenciaDeseadaCLI"];

// Información adicional
$Responsable = $_POST["Responsable"];
$Fuente = $_POST["Fuente"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO e_indicador (
    Claveregis, Mes, Periodo,
    DBPAS, PDOACP, LRAPMDOL, PC, MetaEsperadaDMLPS, RangoAceptDMLPS, TendenciaDeseadaDMLPS,
    CDLPAS, MetaEsperadaEPNC, RangoAceptEPNC, TendenciaDeseadaEPNC,
    DespaReal, DespaProg, LechePrograma, PorcentajeProduccion, PPL, MetaEsperadaCPSP, RangoAceptCPSP, TendenciaDeseadaCPSP,
    GLCMGV, GLPD, PLCMGV, PLPD, MetaEsperadaCLA, RangoAceptCLA, TendenciaDeseadaCLA,
    PCBH, MetaEsperadaCBC, RangoAceptCBC, TendenciaDeseadaCBC,
    PCCL, MetaEsperadaCLI, RangoAceptCLI, TendenciaDeseadaCLI,
    Responsable, Fuente
) VALUES (
    '$Claveregis', '$Mes', '$Periodo',
    '$DBPAS', '$PDOACP', '$LRAPMDOL', '$PC', '$MetaEsperadaDMLPS', '$RangoAceptDMLPS', '$TendenciaDeseadaDMLPS',
    '$CDLPAS', '$MetaEsperadaEPNC', '$RangoAceptEPNC', '$TendenciaDeseadaEPNC',
    '$DespaReal', '$DespaProg', '$LechePrograma', '$PorcentajeProduccion', '$PPL', '$MetaEsperadaCPSP', '$RangoAceptCPSP', '$TendenciaDeseadaCPSP',
    '$GLCMGV', '$GLPD', '$PLCMGV', '$PLPD', '$MetaEsperadaCLA', '$RangoAceptCLA', '$TendenciaDeseadaCLA',
    '$PCBH', '$MetaEsperadaCBC', '$RangoAceptCBC', '$TendenciaDeseadaCBC',
    '$PCCL', '$MetaEsperadaCLI', '$RangoAceptCLI', '$TendenciaDeseadaCLI',
    '$Responsable', '$Fuente'
)";

// Ejecutar la consulta
$resultado = mysqli_query($link, $query);
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
        <br><a href='IndiElaboracion.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>