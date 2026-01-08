<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Gastos de Operación
$PresEje = $_POST["PresEje"];
$GastoAutorizado = $_POST["GastoAutorizado"];
$Diferiencia = $_POST["Diferiencia"];
$MetaEsperadaGO = $_POST["MetaEsperadaGO"];
$RangoAceptGO = $_POST["RangoAceptGO"];
$TendenciaDeseadaGO = $_POST["TendenciaDeseadaGO"];

// Disponibilidad de Equipo Para la Producción, Envasado y ReHidratado
$HorasHombre = $_POST["HorasHombre"];
$HorasParo = $_POST["HorasParo"];
$HorasDisponibles = $_POST["HorasDisponibles"];
$prc = $_POST["prc"];

$HorasHombreEnv = $_POST["HorasHombreEnv"];
$HorasParoEnv = $_POST["HorasParoEnv"];
$HorasDisponiblesEnv = $_POST["HorasDisponiblesEnv"];
$prcEnv = $_POST["prcEnv"];

$HorasHombreReh = $_POST["HorasHombreReh"];
$HorasParoReh = $_POST["HorasParoReh"];
$HorasDisponiblesReh = $_POST["HorasDisponiblesReh"];
$prcReh = $_POST["prcReh"];

$MetaEsperadaDEP = $_POST["MetaEsperadaDEP"];
$RangoAceptDEP = $_POST["RangoAceptDEP"];
$TendenciaDeseadaDEP = $_POST["TendenciaDeseadaDEP"];

// Trabajos Preventivos
$TPE = $_POST["TPE"];
$TP = $_POST["TP"];
$PorcentTP = $_POST["PorcentTP"];
$MetaEsperadaTP = $_POST["MetaEsperadaTP"];
$RangoAceptTP = $_POST["RangoAceptTP"];
$TendenciaDeseadaTP = $_POST["TendenciaDeseadaTP"];

// Trabajos Correctivos
$TC = $_POST["TC"];
$PorcentTC = $_POST["PorcentTC"];
$MetaEsperadaTC = $_POST["MetaEsperadaTC"];
$RangoAceptTC = $_POST["RangoAceptTC"];
$TendenciaDeseadaTC = $_POST["TendenciaDeseadaTC"];

// Consumo Térmico
$ConsumoTermico = $_POST["ConsumoTermico"];
$LitrosLecheProducidatermica = $_POST["LitrosLecheProducidatermica"];
$ConsTT = $_POST["ConsTT"];
$MetaEsperadaCT = $_POST["MetaEsperadaCT"];
$RangoAceptCT = $_POST["RangoAceptCT"];
$TendenciaDeseadaCT = $_POST["TendenciaDeseadaCT"];

// Consumo de Agua
$ConsumoAgua = $_POST["ConsumoAgua"];
$LitrosLecheProducida = $_POST["LitrosLecheProducida"];
$ConsTA = $_POST["ConsTA"];
$MetaEsperadaCA = $_POST["MetaEsperadaCA"];
$RangoAceptCA = $_POST["RangoAceptCA"];
$TendenciaDeseadaCA = $_POST["TendenciaDeseadaCA"];

// Consumo Eléctrico
$ConsumoElectrico = $_POST["ConsumoElectrico"];
$LitrosLecheProducidaElectrico = $_POST["LitrosLecheProducidaElectrico"];
$ConsTE = $_POST["ConsTE"];
$MetaEsperadaCE = $_POST["MetaEsperadaCE"];
$RangoAceptCE = $_POST["RangoAceptCE"];
$TendenciaDeseadaCE = $_POST["TendenciaDeseadaCE"];

// Responsable y fuente
$Responsable = $_POST["Responsable"];
$Fuente = $_POST["Fuente"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO m_indicador (
    Claveregis, FechaAct, Mes, Periodo,
    PresEje, GastoAutorizado, Diferiencia, MetaEsperadaGO, RangoAceptGO, TendenciaDeseadaGO,
    HorasHombre, HorasParo, HorasDisponibles, prc, HorasHombreEnv, HorasParoEnv, HorasDisponiblesEnv, prcEnv,
    HorasHombreReh, HorasParoReh, HorasDisponiblesReh, prcReh,
    MetaEsperadaDEP, RangoAceptDEP, TendenciaDeseadaDEP,
    TPE, TP, PorcentTP, MetaEsperadaTP, RangoAceptTP, TendenciaDeseadaTP,
    TC, PorcentTC, MetaEsperadaTC, RangoAceptTC, TendenciaDeseadaTC,
    ConsumoTermico, LitrosLecheProducidatermica, ConsTT, MetaEsperadaCT, RangoAceptCT, TendenciaDeseadaCT,
    ConsumoAgua, LitrosLecheProducida, ConsTA, MetaEsperadaCA, RangoAceptCA, TendenciaDeseadaCA,
    ConsumoElectrico, LitrosLecheProducidaElectrico, ConsTE, MetaEsperadaCE, RangoAceptCE, TendenciaDeseadaCE,
    Responsable, Fuente
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$PresEje', '$GastoAutorizado', '$Diferiencia', '$MetaEsperadaGO', '$RangoAceptGO', '$TendenciaDeseadaGO',
    '$HorasHombre', '$HorasParo', '$HorasDisponibles', '$prc', '$HorasHombreEnv', '$HorasParoEnv', '$HorasDisponiblesEnv', '$prcEnv',
    '$HorasHombreReh', '$HorasParoReh', '$HorasDisponiblesReh', '$prcReh',
    '$MetaEsperadaDEP', '$RangoAceptDEP', '$TendenciaDeseadaDEP',
    '$TPE', '$TP', '$PorcentTP', '$MetaEsperadaTP', '$RangoAceptTP', '$TendenciaDeseadaTP',
    '$TC', '$PorcentTC', '$MetaEsperadaTC', '$RangoAceptTC', '$TendenciaDeseadaTC',
    '$ConsumoTermico', '$LitrosLecheProducidatermica', '$ConsTT', '$MetaEsperadaCT', '$RangoAceptCT', '$TendenciaDeseadaCT',
    '$ConsumoAgua', '$LitrosLecheProducida', '$ConsTA', '$MetaEsperadaCA', '$RangoAceptCA', '$TendenciaDeseadaCA',
    '$ConsumoElectrico', '$LitrosLecheProducidaElectrico', '$ConsTE', '$MetaEsperadaCE', '$RangoAceptCE', '$TendenciaDeseadaCE',
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
        <br><a href='IndiMantenimiento.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>