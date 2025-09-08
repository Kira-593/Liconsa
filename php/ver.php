<?php
    include "Conexion.php";

    $DNI = $_GET["sc"];

    $query = "SELECT * FROM camioneros WHERE CA_DNI = '$DNI'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    $empresaID = $row['ID_EM'];
    $query_empresa = "SELECT Nombre FROM empresa WHERE ID_EM = '$empresaID'";
    $res_empresa = mysqli_query($link, $query_empresa);
    $row_empresa = mysqli_fetch_array($res_empresa);
    $nombre_empresa = $row_empresa['Nombre'];

    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información del Camionero</title>
            <link rel='stylesheet' href='../css/ver.css'>
        </head>
        <body>
        <img src='../Imagenes/logo.png' class='logo'>

            <div class='contenedor'>
                <h1>Consulta de Información de los Camioneros</h1>
                <hr>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                    <tr><td>DNI:</td><td>{$row[0]}</td></tr>
                    <tr><td>Nombre:</td><td>{$row[1]}</td></tr>
                    <tr><td>Apellido Paterno:</td><td>{$row[2]}</td></tr>
                    <tr><td>Apellido Materno:</td><td>{$row[3]}</td></tr>
                    <tr><td>Número de Teléfono:</td><td>{$row[4]}</td></tr>
                    <tr><td>Estado:</td><td>{$row[6]}</td></tr>
                    <tr><td>Codigo Postal:</td><td>{$row[5]}</td></tr>
                    <tr><td>Población:</td><td>{$row[7]}</td></tr>
                    <tr><td>Colonia:</td><td>{$row[8]}</td></tr>
                    <tr><td>Calle:</td><td>{$row[9]}</td></tr>
                    <tr><td>Número de Casa:</td><td>{$row[10]}</td></tr>
                    <tr><td>Salario:</td><td>{$row[11]}</td></tr>
                    <tr><td>Empresa:</td><td>{$nombre_empresa}</td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='Consulta.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='index.php'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>