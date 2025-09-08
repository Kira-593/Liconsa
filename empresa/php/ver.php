<?php
    include "Conexion.php";

    $ID = $_GET["sc"];

    $query = "SELECT * FROM empresa WHERE ID_EM = '$ID'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información de la carga</title>
            <link rel='stylesheet' href='../css/ver.css'>
        </head>
        <body>
        <img src='../Imagenes/logo.png' class='logo'>

            <div class='contenedor'>
                <h1>Información de la Empresa</h1>
                <hr>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                    <tr><td>ID:</td><td>{$row['ID_EM']}</td></tr>
                    <tr><td>Nombre:</td><td>{$row['Nombre']}</td></tr>
                    <tr><td>RFC:</td><td>{$row['RFC']}</td></tr>
                    <tr><td>Ubicación:</td><td>{$row['Ubicacion']}</td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='empresaP.php'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>