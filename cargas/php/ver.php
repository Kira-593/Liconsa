<?php
    include "Conexion.php";

    $ID = $_GET["sc"];

    $query = "SELECT * FROM carga WHERE ID_C = '$ID'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    $id_camion = $row['ID_CA'];
    $query_camion = "SELECT Marca FROM camiones WHERE ID_CA = '$id_camion'";
    $res_camion = mysqli_query($link, $query_camion);
    $row_camion = mysqli_fetch_array($res_camion);
    $marca_camion = $row_camion['Marca'];

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
                <h1>Información de la Carga</h1>
                <hr>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                    <tr><td>ID:</td><td>{$row['ID_C']}</td></tr>
                    <tr><td>Nombre de la carga:</td><td>{$row['Nombre_C']}</td></tr>
                    <tr><td>Descripción:</td><td>{$row['Descripcion']}</td></tr>
                    <tr><td>Peso:</td><td>{$row['Peso']}</td></tr>
                    <tr><td>ID Camion:</td><td>{$row['ID_CA']} - {$marca_camion}</td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='cargasP.php'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>
