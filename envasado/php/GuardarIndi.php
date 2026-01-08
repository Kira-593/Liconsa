<?php
include "Conexion.php";

// Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"];
$FechaAct = $_POST["FechaAct"];
$Mes = $_POST["Mes"];
$Periodo = $_POST["Periodo"];
$RepAbasto = $_POST["RepAbasto"];
$RepFrisia = $_POST["RepFrisia"];
$MetaEsperadaMB = $_POST["MetaEsperadaMB"];
$RangoAcept = $_POST["RangoAcept"];
$TendenciaDeseadaMB = $_POST["TendenciaDeseadaMB"];
$Responsable = $_POST["Responsable"];
$ObservacionesRes = $_POST["ObservacionesRes"];


// Consulta para insertar los datos en la base de datos
$query = "INSERT INTO envasado_indicador (
    Claveregis, FechaAct, Mes, Periodo, RepAbasto, RepFrisia, 
    MetaEsperadaMB, RangoAcept, TendenciaDeseadaMB, 
    Responsable, ObservacionesRes
) VALUES (
    '$Claveregis', '$FechaAct', '$Mes', '$Periodo', '$RepAbasto', '$RepFrisia',
    '$MetaEsperadaMB', '$RangoAcept', '$TendenciaDeseadaMB',
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
        <br><a href='IndiEnvas.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='envasadoP.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>