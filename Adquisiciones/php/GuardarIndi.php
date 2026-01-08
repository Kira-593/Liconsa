<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Cumplimiento de las Compras Realizadas
$ExpAtend = $_POST["ExpAtend"];
$ExpRecib = $_POST["ExpRecib"];
$Cumplimiento = $_POST["Cumplimiento"];
$MetaEsperadaCCR = $_POST["MetaEsperadaCCR"];
$RangoAceptCCR = $_POST["RangoAceptCCR"];
$TendenciaDeseadaCCR = $_POST["TendenciaDeseadaCCR"];

// Satisfacción del Cliente
$EncuSatisfa = $_POST["EncuSatisfa"];
$EncEnvia = $_POST["EncEnvia"];
$Satisfaccion = $_POST["Satisfaccion"];
$MetaEsperadaSC = $_POST["MetaEsperadaSC"];
$RangoAceptSC = $_POST["RangoAceptSC"];
$TendenciaDeseadaSC = $_POST["TendenciaDeseadaSC"];

// Responsable y fuente
$Responsable = $_POST["Responsable"];
$ObservacionesRes = $_POST["ObservacionesRes"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO ad_indicador (
    Claveregis, FechaAct, Mes, Periodo,
    ExpAtend, ExpRecib, Cumplimiento, MetaEsperadaCCR, RangoAceptCCR, TendenciaDeseadaCCR,
    EncuSatisfa, EncEnvia, Satisfaccion, MetaEsperadaSC, RangoAceptSC, TendenciaDeseadaSC,
    Responsable, ObservacionesRes
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$ExpAtend', '$ExpRecib', '$Cumplimiento', '$MetaEsperadaCCR', '$RangoAceptCCR', '$TendenciaDeseadaCCR',
    '$EncuSatisfa', '$EncEnvia', '$Satisfaccion', '$MetaEsperadaSC', '$RangoAceptSC', '$TendenciaDeseadaSC',
    '$Responsable', '$ObservacionesRes'
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
        <br><a href='IndiAdquisiciones.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='MenuIndi.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>