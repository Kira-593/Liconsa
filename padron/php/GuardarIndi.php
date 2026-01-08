<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Meta de Beneficiarios
$NumBenefi = $_POST["NumBenefi"];
$MetaBeneficiarios = $_POST["MetaBeneficiarios"];
$MetaReal = $_POST["MetaReal"];
$MetaEsperadaMB = $_POST["MetaEsperadaMB"];
$RangoAceptMB = $_POST["RangoAceptMB"];
$TendenciaDeseadaMB = $_POST["TendenciaDeseadaMB"];

// Factor de Retiro Global Líquida
$LitrosVendidos = $_POST["LitrosVendidos"];
$NumBenefiActivos = $_POST["NumBenefiActivos"];
$DiasVenta = $_POST["DiasVenta"];
$FacRetLi = $_POST["FacRetLi"];
$MetaEsperadaFRL = $_POST["MetaEsperadaFRL"];
$RangoAceptFRL = $_POST["RangoAceptFRL"];
$TendenciaDeseadaFRL = $_POST["TendenciaDeseadaFRL"];

// Factor de Retiro Global Polvo
$LitrosVendidosPol = $_POST["LitrosVendidosPol"];
$NumBenefiActivosPol = $_POST["NumBenefiActivosPol"];
$DiasVentaPol = $_POST["DiasVentaPol"];
$FacRetPol = $_POST["FacRetPol"];
$MetaEsperadaFRP = $_POST["MetaEsperadaFRP"];
$RangoAceptFRP = $_POST["RangoAceptFRP"];
$TendenciaDeseadaFRP = $_POST["TendenciaDeseadaFRP"];

// Tarjetas No Entregadas
$TNE = $_POST["TNE"];
$FamiliasInscritas = $_POST["FamiliasInscritas"];
$PorcentajeTNE = $_POST["PorcentajeTNE"];
$MetaEsperadaTNE = $_POST["MetaEsperadaTNE"];
$RangoAceptTNE = $_POST["RangoAceptTNE"];
$TendenciaDeseadaTNE = $_POST["TendenciaDeseadaTNE"];

// Atención a Quejas
$QuejasRecibidas = $_POST["QuejasRecibidas"];
$QuejasAtendidas = $_POST["QuejasAtendidas"];
$PQNA = $_POST["PQNA"];
$MetaEsperadaAQ = $_POST["MetaEsperadaAQ"];
$RangoAceptAQ = $_POST["RangoAceptAQ"];
$TendenciaDeseadaAQ = $_POST["TendenciaDeseadaAQ"];

// Encuesta de Satisfacción al Cliente
$TotalEncues = $_POST["TotalEncues"];
$MaxPuntos = $_POST["MaxPuntos"];
$TPTE = $_POST["TPTE"];
$PorcentajeEncuestas = $_POST["PorcentajeEncuestas"];
$MetaEsperadaES = $_POST["MetaEsperadaES"];
$RangoAceptES = $_POST["RangoAceptES"];
$TendenciaDeseadaES = $_POST["TendenciaDeseadaES"];

// Otros campos
$Responsable = $_POST["Responsable"];
$Fuente = $_POST["Fuente"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO P_indicador (
    Claveregis, FechaAct, Mes, Periodo,
    NumBenefi, MetaBeneficiarios, MetaReal, MetaEsperadaMB, RangoAceptMB, TendenciaDeseadaMB,
    LitrosVendidos, NumBenefiActivos, DiasVenta, FacRetLi, MetaEsperadaFRL, RangoAceptFRL, TendenciaDeseadaFRL,
    LitrosVendidosPol, NumBenefiActivosPol, DiasVentaPol, FacRetPol, MetaEsperadaFRP, RangoAceptFRP, TendenciaDeseadaFRP,
    TNE, FamiliasInscritas, PorcentajeTNE, MetaEsperadaTNE, RangoAceptTNE, TendenciaDeseadaTNE,
    QuejasRecibidas, QuejasAtendidas, PQNA, MetaEsperadaAQ, RangoAceptAQ, TendenciaDeseadaAQ,
    TotalEncues, MaxPuntos, TPTE, PorcentajeEncuestas, MetaEsperadaES, RangoAceptES, TendenciaDeseadaES,
    Responsable, Fuente
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo',
    '$NumBenefi', '$MetaBeneficiarios', '$MetaReal', '$MetaEsperadaMB', '$RangoAceptMB', '$TendenciaDeseadaMB',
    '$LitrosVendidos', '$NumBenefiActivos', '$DiasVenta', '$FacRetLi', '$MetaEsperadaFRL', '$RangoAceptFRL', '$TendenciaDeseadaFRL',
    '$LitrosVendidosPol', '$NumBenefiActivosPol', '$DiasVentaPol', '$FacRetPol', '$MetaEsperadaFRP', '$RangoAceptFRP', '$TendenciaDeseadaFRP',
    '$TNE', '$FamiliasInscritas', '$PorcentajeTNE', '$MetaEsperadaTNE', '$RangoAceptTNE', '$TendenciaDeseadaTNE',
    '$QuejasRecibidas', '$QuejasAtendidas', '$PQNA', '$MetaEsperadaAQ', '$RangoAceptAQ', '$TendenciaDeseadaAQ',
    '$TotalEncues', '$MaxPuntos', '$TPTE', '$PorcentajeEncuestas', '$MetaEsperadaES', '$RangoAceptES', '$TendenciaDeseadaES',
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
        <br><a href='IndiPadron.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='MenuIndi.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
    </div>
</body>
</html>