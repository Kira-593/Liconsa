<?php
include "Conexion.php";

$ID = $_GET["sc"];

// Consulta para obtener la información de la ruta y el camionero
$query = "SELECT r.ID_RU, r.RU_IN, r.RU_FIN, r.CA_DNI, c.Nombre AS Nombre_Camionero
          FROM ruta r
          JOIN camioneros c ON r.CA_DNI = c.CA_DNI
          WHERE r.ID_RU = '$ID'";
$res = mysqli_query($link, $query);
$row = mysqli_fetch_array($res);

echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Información de la Ruta</title>
        <link rel='stylesheet' href='../css/ver.css'>
    </head>
    <body>
    <img src='../Imagenes/logo.png' class='logo'>

        <div class='contenedor'>
            <h1>Consulta de Información de las Rutas</h1>
            <hr>
            <h2>Información Encontrada</h2>
            <hr>
            <table class='info-tabla'>
                <tr><td>ID:</td><td>{$row['ID_RU']}</td></tr>
                <tr><td>Origen:</td><td>{$row['RU_IN']}</td></tr>
                <tr><td>Destino:</td><td>{$row['RU_FIN']}</td></tr>
                <tr><td>DNI Camionero:</td><td>{$row['CA_DNI']} - {$row['Nombre_Camionero']}</td></tr>
            </table>
            <hr>
            <div class='links'>
                <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                <a href='rutasP.php'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
            </div>
        </div>
    </body>
    </html>
";
include "Cerrar.php";
?>