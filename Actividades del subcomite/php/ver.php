<?php
    include "Conexion.php";

    $ID = $_GET["sc"];

    $query = "SELECT * FROM camiones WHERE ID_CA = '$ID'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    $dni_camionero = $row['CA_DNI'];
    $query_camionero = "SELECT Nombre FROM camioneros WHERE CA_DNI = '$dni_camionero'";
    $res_camionero = mysqli_query($link, $query_camionero);
    $row_camionero = mysqli_fetch_array($res_camionero);
    $nombre_camionero = $row_camionero['Nombre'];

    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información del Camion</title>
            <link rel='stylesheet' href='../css/ver.css'>
        </head>
        <body>
        <img src='../Imagenes/logo.png' class='logo'>

            <div class='contenedor'>
                <h1>Consulta de Información de los Camiones</h1>
                <hr>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                    <tr><td>ID:</td><td>{$row['ID_CA']}</td></tr>
                    <tr><td>Marca:</td><td>{$row['Marca']}</td></tr>
                    <tr><td>Modelo:</td><td>{$row['Modelo']}</td></tr>
                    <tr><td>Placas:</td><td>{$row['Placas']}</td></tr>
                    <tr><td>DNI camionero:</td><td>{$row['CA_DNI']} - {$nombre_camionero}</td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='camP.php'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>
