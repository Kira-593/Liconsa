<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];

// Solicitud de Servicio
$SolicitudesAtendidas = $_POST["SolicitudesAtendidas"];
$NumSolicitudes = $_POST["NumSolicitudes"];
$PorSolicitudesAtendidas = $_POST["PorSolicitudesAtendidas"];
$EventualidadesMes = $_POST["EventualidadesMes"];
$MetaEsperadaMB = $_POST["MetaEsperadaMB"];
$RangoAceptMB = $_POST["RangoAceptMB"];
$TendenciaDeseadaMB = $_POST["TendenciaDeseadaMB"];

// Responsable y fuente
$Responsable = $_POST["Responsable"];
$Fuente = $_POST["Fuente"];

// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO I_indicador (
    Claveregis, Mes, Periodo,
    SolicitudesAtendidas, NumSolicitudes, PorSolicitudesAtendidas, EventualidadesMes,
    MetaEsperadaMB, RangoAceptMB, TendenciaDeseadaMB,
    Responsable, Fuente
) VALUES (
    '$Claveregis', '$Mes', '$Periodo',
    '$SolicitudesAtendidas', '$NumSolicitudes', '$PorSolicitudesAtendidas', '$EventualidadesMes',
    '$MetaEsperadaMB', '$RangoAceptMB', '$TendenciaDeseadaMB',
    '$Responsable', '$Fuente'
)";

// Ejecutar la consulta
$resultado = mysqli_query($link, $query);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Guardar - Indicadores de Apoyo a la Infraestructura Informática</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/guardar.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
    <div class="contenedor">
        <?php
            if ($resultado) {
                echo "<div class='mensaje correcto'>Inserción correcta</div>";
            } else {
                echo "<div class='mensaje error'>Inserción incorrecta. Error: " . mysqli_error($link) . "</div>";
            }
            include "Cerrar.php";
        ?>
        <br><a href='IndiInformatica.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='InformaticaP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
    </div>
</body>
</html>